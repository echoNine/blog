<?php


namespace App\Http\Controllers;


use App\Models\UserModel;
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

        //判断邮箱是否重复
        $first = UserModel::query()
            ->where('email',$email)
            ->first();
        if ($first) {
            throw new Exception("The email is repeated");
        }

        //数据库存储

        $new_user = new UserModel();
        $new_user->user_name = $user_name;
        //$new_user->password = $password;
        //密码加密并存储到数据库
        $new_user->password = password_hash($password, PASSWORD_BCRYPT);
        $new_user->email = $email;
        $new_user->save();
        $response = [
            'success' => true,
            'msg' => true
        ];
        return $response;
    }

    public function all()
    {
        $all = UserModel::all(['id', 'user_name', 'email','created_at', 'updated_at']);
        return [
            'success' => true,
            'msg' => $all
        ];
    }

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
                $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
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
}