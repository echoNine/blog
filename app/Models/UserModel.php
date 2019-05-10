<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserModel query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $user_name 用户名
 * @property string $password 密码
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserModel wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserModel whereUserName($value)
 * @property string $email 邮箱
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserModel whereEmail($value)
 */
class UserModel extends Model
{
    //table_name 定义和数据表的映射
    protected $table = 'user';//default users
}