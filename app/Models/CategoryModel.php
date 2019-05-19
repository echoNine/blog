<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CategoryModel
 *
 * @property int $id
 * @property string $type_name 类别名
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $user_id 用户id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryModel whereTypeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryModel whereUserId($value)
 * @mixin \Eloquent
 * @property string $type 类别名
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryModel whereType($value)
 */
class CategoryModel extends Model
{
    protected $table = 'category';
}