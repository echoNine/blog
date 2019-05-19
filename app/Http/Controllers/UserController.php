<?php


namespace App\Http\Controllers;

use App\Models\UserModel;
use App\Services\MailService;
use Exception;
use Illuminate\Support\Facades\Redis;
use Request;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return array
     * @throws Exception
     */
    public function register(Request $request)
    {

        //首先完成 让 /api/user/register 访问到这个接口
        $user_name = $request::get('user_name');
        $password = $request::get('password');
        $email = $request::get('email');

        //判断用户名是否已存在name)->first();
        $first = UserModel::query()
            ->where('user_name', $user_name)
            ->first();
        if ($first) {
            throw new Exception("user name exists");
        }

        //判断密码复杂度 只能包含并且必须包含 数字字母大小写
        if (!preg_match('/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{3,10}$/', $password)) {
            throw new Exception("password must contain number and letter");
        }

        //判断邮箱格式是否正确
        if(!preg_match(('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/'), $email)) {
            throw new Exception("email format error");
        }

        //判断邮箱是否重复(
        $first = UserModel::query()
            ->where('email',$email)
            ->first();
        if ($first) {
            throw new Exception("The email is repeated");
        }

        $token = "";
        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        $len = strlen($str);
        for ($i = 0; $i < 6; $i++) {
            $token .= $str[random_int(0, $len - 1)];
        }
        $content = "Hi @".$user_name."  Help us secure your GitHub account by verifying your email address (".$email.").  This lets you access all of GitHub’s features.Verify email address Button not working? Paste the following link into your browser:".$token."  You’re receiving this email because you recently created a new GitHub account or added a new email address. If this wasn’t you, please ignore this email";
        MailService::send("注册成功", $content, $email);
        //将用户名 邮箱 加密后密码 存redis
        $store = Redis::set($token, json_encode(([$user_name, $email, password_hash($password, PASSWORD_BCRYPT)])));
        if($store){
            return [
                'success' => true,
                'msg' => true
            ];
        }
    }

    public function all()
    {
        $all = UserModel::all(['id', 'user_name', 'email','created_at', 'updated_at']);
        return [
            'success' => true,
            'msg' => $all
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function login(Request $request)
    {
        //首先完成 让 /api/user/login 访问到这个接口
        $user_name = $request::get('user_name');
        $password = $request::get('password');

        //\DB::enableQueryLog();
        $user = UserModel::query()
            ->where('user_name', $user_name)
            ->first();
        //dd(\DB::getQueryLog());
        if ($user && password_verify($password, $user->password)) {
            $key = function (){
                $key = "";
                $str = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
                $len = strlen($str);//$str长度
                for ($i = 0; $i < 32; $i++) {
                    $key .= $str[random_int(0, $len - 1)];
                }
                return $key;
            };
            Redis::set($key(), json_encode($user->only(['id', "user_name"])));
            $response = [
                'success' => true,
                'msg' => "login success"
            ];
        } else {
            $response = [
                'success' => false,
                'msg' => "login failed"
            ];
        }
        return $response;
    }

    /**
     * @param Request $request
     * @return array
     * @throws Exception
     */
    public function verify(Request $request)
    {
        $token = $request::get('token');
        $user_string = Redis::get($token);
        if ($user_string){
            //todo 验证成功 新建用户 并且移除 redis $token 信息
            $user_array = json_decode($user_string);
            $new_user = new UserModel();
            $new_user->user_name = $user_array[0];
            $new_user->password = $user_array[2];
            $new_user->email = $user_array[1];
            $new_user->actived = true;
            $new_user->save();
            Redis::del($token);
            return [
                'success' => true,
                'msg' => $new_user
            ];
        } else {
            throw new Exception("verify failed");
        }

    }
}