<?php


namespace App\Http\Controllers;


use App\Models\CategoryModel;
use Exception;
use Request;

class CategoryController
{

    /**
     * @param Request $request
     * @return array
     * @throws Exception
     */
    public function create(Request $request)
    {
        $user_id = $request::get('user_id');
        $type = $request::get('type');
        $first = CategoryModel::query()
            ->where('user_id', $user_id)
            ->where('type',$type)
            ->first();

        if ($first) {
            throw new Exception("the user has the same type");
        }

        $new_category = new CategoryModel();
        $new_category->user_id = $user_id;
        $new_category->type = $type;
        if($new_category->save())
        {
            $response = [
                'success' => true,
                'msg' => true
            ];
            return $response;
        }
    }

    /**
     * @param Request $request
     * @return array
     * @throws Exception
     */
    public function update(Request $request)
    {
        $id = $request::get('id');
        $user_id = $request::get('user_id');
        $type = $request::get('type');
        $first = CategoryModel::query()->where('id',$id)->where('user_id',$user_id)->first();
        if ($first){
            $first->type = $type;
            $first->save();
            return [
                "success" => true,
                "msg" => true
            ];
        }else {
            throw new Exception("can't find the record");
        }
    }

}