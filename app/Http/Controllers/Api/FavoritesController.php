<?php

namespace App\Http\Controllers\Api;

use App\Models\Favorites;
use App\Models\Course;
use Dingo\Api\Http\Request;

class FavoritesController extends BaseController
{
    private  $Favorites;

    public function __construct(Favorites $Favorites)
    {
        $this->Favorites = $Favorites;
    }

    /**
     * @api               {get} getFavoritesList 获取学生收藏列表
     * @apiName           getFavoritesList
     * @apiGroup          Favorites
     * @apiVersion        1.0.0
     * @apiUse            Error404
     * @apidescribe       收藏列表
     * @apiParam {int} stu_id 学生id,必传参数
     * @apiSuccess {number} status 结果状态值，0：请求失败；1：请求成功
     * @apiSuccess {string} info 返回状态说明，status为0时，info返回错误原因，否则返回“OK”
     * @apiSuccess {array} data 返回数据
     * @apiSuccess {int}   data.id 收藏列表id
     * @apiSuccess {int}   data.stu_id 学生id
     * @apiSuccess {int}   data.course_id 课程id
     * @apiSuccess {string}   data.course_name 课程名称
     * @apiSuccess {string}   data.image 课程图片
     *
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     *{
     *"status": 1,
     *"info": "ok",
     *"data": {
     *"current_page": 1,
     *"data": [
     *{
     *"id": 1,
     *"stu_id": 1,
     *"course_id": 1,
     *"course_name": "Java",
     *"image": "specialty_images/1503368798_06412900.jpg"
     *}
     *],
     *"from": 1,
     *"last_page": 1,
     *"next_page_url": null,
     *"path": "http://weibaner.dev/api/getFavoritesList",
     *"per_page": 15,
     *"prev_page_url": null,
     *"to": 1,
     *"total": 1
     *}
     *}
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFavoritesList(Request $request)
    {
        if($request->has('stu_id')){
            $re_list = $this->Favorites->getApiList(['stu_id'=>$request->get('stu_id')]);
        }else{
            return  $this->error('缺少参数');
        }
        return  $this->success($re_list);
    }

    /**
     * @api               {post} FavoritesCourse 收藏
     * @apiName           FavoritesCourse
     * @apiGroup          Favorites
     * @apiVersion        1.0.0
     * @apiUse            Error404
     * @apidescribe       收藏
     *
     * @apiParam {int} course_id 课程id,必传参数
     * @apiParam {int} stu_id 学生id,必传参数
     * @apiSuccess {number} status 结果状态值，0：请求失败；1：请求成功
     * @apiSuccess {string} info 返回状态说明，status为0时，info返回错误原因，否则返回“OK”
     * @apiSuccess {array} data 返回新增的id -1等于失败 存在=删除反之新增
     *
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     *{
     *"status": 1,
     *"info": "ok",
     *"data": 8
     *}
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function FavoritesCourse(Request $request)
    {
        if($request->has('stu_id') && $request->has('course_id')){
            $data = [
                'stu_id'=>$request->get('stu_id'),
                'course_id'=>$request->get('course_id')
            ];
            $re_list = $this->Favorites->getList($data);
            if (count($re_list) == 0 ){
                return  $this->success($this->Favorites->Add($data));
            }else{
                return  $this->success($this->Favorites->Del($data));
            }
        }else{
            return  $this->error('缺少参数');
        }
    }

}
