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
     * @apiParam {int} course_id 课程id，可传参数(课程id或教师id 2选1)
     * @apiParam {int} teacher_id 教师id，可传参数(课程id或教师id 2选1)
     * @apiParam {int} page_size 分页，可传参数(默认每页10条)
     * @apiParam {int} page 翻页，可传参数
     * @apiSuccess {number} status 结果状态值，0：请求失败；1：请求成功
     * @apiSuccess {string} info 返回状态说明，status为0时，info返回错误原因，否则返回“OK”
     * @apiSuccess {array} data 返回数据
     * @apiSuccess {int}   data.current_page 当前页
     * @apiSuccess {int}   data.last_page 最大页数
     * @apiSuccess {int}   data.total 总条数
     * @apiSuccess {int}   data.id 技能id
     * @apiSuccess {string}   data.specialty_name 技能名称
     * @apiSuccess {string}   data.teacher_name 教师名称
     * @apiSuccess {int}   data.buy_number 购买数量
     * @apiSuccess {int}   data.look_number 观看(点击)数量
     * @apiSuccess {decimal}   data.old_price 原价
     * @apiSuccess {decimal}   data.price 现价
     * @apiSuccess {string}   data.image 图片相对路径
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
     *"specialty_name": "PHP入门知识",
     *"teacher_name": "王先生",
     *"buy_number": 0,
     *"look_number": 0,
     *"old_price": "0.00",
     *"price": "150.00",
     *"image": "specialty_images/1502097686_84946300.jpg"
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
        $where = [
            'state'=>1,
        ];
        if ($request->has('course_id')){
            $where['course_id'] = $request->get('course_id');
        }else if ($request->has('teacher_id')){
            $where['teacher_id'] = $request->get('teacher_id');
        }else{
            return  $this->error('缺少参数');
        }

        //分页
        $page_size =  $request->get('page_size');
        if (!$page_size){
            $page_size = 1;
        }
        //排序
        $order =  $request->get('order');
        if (!$order){
            $order = 'buy_number';
        }
        $re_list = $this->Specialty->getApiList($where,[$order=>'desc'],$page_size);
        return  $this->success($re_list);
    }

    public function getSpecialtyDetail(Request $request)
    {

        if ($request->has('specialty_id')){
            $where['specialty_id'] = $request->get('specialty_id');
        }else{
            return  $this->error('缺少参数');
        }
        $re_list = $this->Specialty->
        return  $this->success($re_list);
    }
}
