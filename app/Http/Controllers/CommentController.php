<?php


namespace App\Http\Controllers;


use App\Models\ArticleModel;
use App\Models\CommentModel;
use App\Models\UserModel;
use Exception;
use Request;

class CommentController
{
    /**
     * @param Request $request
     * @return array
     * @throws Exception
     */
    public function make(Request $request)
    {
        $article_id = $request::get('article_id');
        $comment_content = $request::get('comment_content');
        $commentator = $request::get('commentator');

        $article = ArticleModel::query()->where('id', $article_id)->first();
        $user = UserModel::query()->where('id',$commentator)->first();
        if ($article&&$user) {
            $new_comment = new CommentModel();
            $new_comment->article_id = $article_id;
            $new_comment->comment_content = $comment_content;
            $new_comment->commentator = $commentator;
            if ($new_comment->save()) {
                return [
                    'success' => true,
                    'msg' => $new_comment
                ];
            }
        } else {
            throw new Exception("the article or the user don't exist");
        }
    }

    /**
     * @param Request $request
     * @return array
     */
    public function display(Request $request)
    {
        $article_id = $request::get('article_id');

        $list = CommentModel::query()
            ->where('article_id',$article_id)
            ->paginate(3,['id', 'comment_content', 'commentator', 'created_at']);
        if ($list) {
            return [
                "success" => true,
                "msg" => [
                    "total" => $list->total(),
                    "items" => $list->items()
                ]
            ];
        }
    }

    /**
     * @param Request $request
     * @return array
     * @throws Exception
     */

    public function delete(Request $request)
    {
        $comment_id = $request::get('comment_id');
        $commentator = $request::get('commentator');
        $first = CommentModel::query()->where('id',$comment_id)->where('commentator',$commentator)->firstOrFail()->delete();
        if ($first) {
            return [
                'success' => true,
                'msg' => "delete success"
            ];
        } else {
            throw new Exception('delete failed');
        }
    }

}