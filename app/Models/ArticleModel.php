<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $title 标题
 * @property int $category_id 类别索引
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArticleModel onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleModel whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleModel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleModel whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArticleModel withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArticleModel withoutTrashed()
 * @property string $comment 评论
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleModel whereComment($value)
 */
class ArticleModel extends Model
{
    use SoftDeletes;
    //table_name 定义和数据表的映射
    protected $table = 'article';

    protected $datas = ['deleted_at'];
}