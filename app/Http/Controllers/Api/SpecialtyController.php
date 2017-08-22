<?php

namespace App\Http\Controllers\Api;

use App\Models\Specialty;
use Dingo\Api\Http\Request;

class SpecialtyController extends BaseController
{
    private  $Specialty;

    public function __construct(Specialty $Specialty)
    {
        $this->Specialty = $Specialty;
    }


    /**
     * @api               {get} getSpecialtyList 获取技能列表
     * @apiName           getSpecialtyList
     * @apiGroup          Special
     * @apiVersion        1.0.0
     * @apiUse            Error404
     * @apidescribe       技能列表
     *
     * @apiParam {int} course_id 课程id，必传参数
     * @apiParam {int} page_size 分页，可传参数(默认每页10条)
     * @apiParam {int} page 翻页，可传参数
     * @apiSuccess {number} status 结果状态值，0：请求失败；1：请求成功
     * @apiSuccess {string} info 返回状态说明，status为0时，info返回错误原因，否则返回“OK”
     * @apiSuccess {array} data 返回数据
     * @apiSuccess {int}   data.current_page 当前页
     * @apiSuccess {int}   data.last_page 最大页数
     * @apiSuccess {int}   data.total 总条数
     * @apiSuccess {int}   data.id 技能id
     * @apiSuccess {string}   data.name 技能名称
     * @apiSuccess {string}   data.info 技能信息
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
     *"name": "PHP入门知识",
     *"info": "王先生"
     *}
     *],
     *"from": 1,
     *"last_page": 3,
     *"next_page_url": "http://weibaner.dev/api/getSpecialtyList?page=2",
     *"path": "http://weibaner.dev/api/getSpecialtyList",
     *"per_page": 1,
     *"prev_page_url": null,
     *"to": 1,
     *"total": 3
     *}
     *}
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSpecialtyList(Request $request)
    {
        if ($request->has('course_id')){
            $where['course_id'] = $request->get('course_id');
        }else{
            return  $this->error('缺少参数');
        }

        //分页
        $page_size =  $request->get('page_size');
        if (!$page_size){
            $page_size = 1;
        }

        $re_list = $this->Specialty->getList($where,['id','name','info'],'',$page_size);
        return  $this->success($re_list);
    }

}
