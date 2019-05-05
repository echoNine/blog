<?php


namespace App\Http\Controllers;

use App\Models\ArticleModel;

class ArticleController
{
    public function create(\Request $request)
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

    public function all(){
        $all = ArticleModel::all();
        return [
            'success' => true,
            'msg' => $all
        ];
    }
}