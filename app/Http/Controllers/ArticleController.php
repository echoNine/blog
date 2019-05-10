<?php


namespace App\Http\Controllers;

use App\Models\ArticleModel;
use Exception;
use Request;


class ArticleController
{
    /**
     * @param Request $request
     * @return array
     */
    public function create(Request $request)
    {
        //首先完成 让 /api/article/create 访问到这个接口
        $user_id = $request::get('user_id');
        $content = $request::get('content');

        //数据库存储

        $new_article = new ArticleModel();
        $new_article->user_id = $user_id;
        $new_article->content = $content;
        $new_article->save();
        $response = [
            'success' => true,
            'msg' => true
        ];
        return $response;
    }

    public function all()
    {
        $all = ArticleModel::all();
        return [
            'success' => true,
            'msg' => $all
        ];
    }

    /**
     * @param Request $request
     * @return array
     * @throws Exception
     */
    public function edit(Request $request)
    {
        $id = $request::get('id');
        $user_id = $request::get('user_id');
        $content = $request::get('content');
        $first = ArticleModel::query()
            ->where('user_id', $user_id)
            ->where('id', $id)
            ->first();
        if ($first) {
            $first->content = $content;
            $first->save();
            $response = [
                'success' => true,
                'msg' => true
            ];
        } else {
            throw new Exception('can\'t find the article');
        }
        return $response;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function display(Request $request)
    {
        //['id', 'content'] = array('id', 'content')
        $user_id = $request::get('user_id');
        //$page = $request::get('page');
        $list = ArticleModel::query()
            ->where('user_id', $user_id)
            ->paginate(2, ['id', 'content']);
            //->paginate(2, ['id', 'content'], 'page', $page);
        $response = [
            "success" => true,
            "msg" => [
                "total" => $list->total(),
                "items" => $list->items()
            ]
        ];
        return $response;
    }

//    public function delete(Request $request)
//    {
//        $user_id = $request::get('user_id');
//        $article_id = $request::get('article_id');
//
//    }
}
