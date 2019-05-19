<?php


namespace App\Http\Controllers;

use App\Models\ArticleModel;
use App\Models\CategoryModel;
use Exception;
use Request;


class ArticleController
{
    /**
     * @param Request $request
     * @return array
     * @throws Exception
     */
    public function create(Request $request)
    {
        //首先完成 让 /api/article/create 访问到这个接口
        $user_id = $request::get('user_id');
        $title = $request::get('title');
        $content = $request::get('content');
        $category_id = $request::get('category_id');

        $first = CategoryModel::query()
            ->where('user_id',$user_id)
            ->where('id',$category_id)
            ->first();

        if ($first){
            //数据库存储
            $new_article = new ArticleModel();
            $new_article->user_id = $user_id;
            $new_article->title = $title;
            $new_article->content = $content;
            $new_article->category_id = $category_id;
            $new_article->save();
            return [
                'success' => true,
                'msg' => true
            ];

        } else {
            throw new Exception('the user doesn\'t have this type');
        }

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
            return [
                'success' => true,
                'msg' => true
            ];
        } else {
            throw new Exception('can\'t find the article');
        }
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
            ->paginate(2, ['id', 'category_id', 'title', 'content']);
            //->paginate(2, ['id', 'content'], 'page', $page);
        if ($list){
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
    public function softDelete(Request $request)
    {
        $user_id = $request::get('user_id');
        $article_id = $request::get('article_id');

        $del_Target = ArticleModel::query()->where('user_id', $user_id)->where('id', $article_id)->firstOrFail();

        if ($del_Target->delete()) {
            return [
                "success" => true,
                "msg" => "delete success"
            ];
        } else {
            throw new Exception('the record does not exist');
        }
    }

    /**
     * @param Request $request
     * @return array
     * @throws Exception
     */
    public function getTrashed(Request $request)
    {
        $user_id = $request::get('user_id');
        $trashed_list = ArticleModel::onlyTrashed()->where('user_id',$user_id)->get();
        if ($trashed_list){
            return [
                'success' => true,
                'msg' => $trashed_list
            ];
        } else {
            throw new Exception('can\'t find the record');
        }
    }

    /**
     * @param Request $request
     * @return array
     * @throws Exception
     */
    public function restore(Request $request)
    {
        $user_id = $request::get('user_id');
        $article_id = $request::get('article_id');
        $recover = ArticleModel::onlyTrashed()->where('user_id', $user_id)->where('id', $article_id)->firstOrFail()->restore();
        if ($recover) {
            return [
                'success' => true,
                'msg' => "recover success"
            ];
        } else {
            throw new Exception('recover failed');
        }
    }

    /**
     * @param Request $request
     * @return array
     * @throws Exception
     */
    public function forceDelete(Request $request)
    {
        $user_id = $request::get('user_id');
        $article_id = $request::get('article_id');
        $trashed = ArticleModel::onlyTrashed()->where('user_id', $user_id)->where('id', $article_id)->firstOrFail()->forceDelete();
        if ($trashed) {
            return [
                'success' => true,
                'msg' => "completely delete success"
            ];
        } else {
            throw new Exception('completely delete failed');
        }
    }

}
