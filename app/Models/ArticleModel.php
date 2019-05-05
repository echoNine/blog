<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ArticleModel
 *
 * @property int $id
 * @property int $user_id
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleModel whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleModel whereUserId($value)
 * @mixin \Eloquent
 */
class ArticleModel extends Model
{
    //table_name 定义和数据表的映射
    protected $table = 'article';
}