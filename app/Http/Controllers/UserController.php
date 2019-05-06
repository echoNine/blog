<?php


namespace App\Http\Controllers;


use App\Models\UserModel;

class UserController extends Controller
{
    public function register(\Request $request)
    {

        //首先完成 让 /api/user/register 访问到这个接口
        $user_name = $request::get('user_name');
        $password = $request::get('password');
        $email = $request::get('email');

        //判断用户名是否已存在name)->first();
        $first = UserModel::query()->where('user_name', $user_name)->first();
        if ($first) {
            throw new \Exception("user name exists");
        }

        //判断密码复杂度 只能包含并且必须包含 数字字母大小写

        if (!preg_match('/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{3,10}$/', $password)) {
            throw new \Exception("password must contain number and letter");
        }

        //数据库存储

        $new_user = new UserModel();
        $new_user->user_name = $user_name;
        $new_user->password = $password;
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
}