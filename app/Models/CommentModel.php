<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CommentModel
 *
 * @property int $id
 * @property string $comment_content
 * @property int $article_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CommentModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CommentModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CommentModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CommentModel whereArticleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CommentModel whereCommentContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CommentModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CommentModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CommentModel whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $commentator 评论人
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CommentModel whereCommentator($value)
 */
class CommentModel extends Model
{
    protected $table = 'comment';
}
