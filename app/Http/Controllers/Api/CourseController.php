<?php

namespace App\Http\Controllers\Api;

use App\Models\Course;
use Dingo\Api\Http\Request;

class CourseController extends BaseController
{
    private  $Course;

    public function __construct(Course $Course)
    {
        $this->Course = $Course;
    }

    /**
     * @api               {get} getCourseList 获取课程列表
     * @apiName           getCourseList
     * @apiGroup          Course
     * @apiVersion        1.0.0
     * @apiUse            Error404
     * @apidescribe       课程列表
     *
     * @apiSuccess {number} status 结果状态值，0：请求失败；1：请求成功
     * @apiSuccess {string} info 返回状态说明，status为0时，info返回错误原因，否则返回“OK”
     * @apiSuccess {array} data 返回数据
     * @apiSuccess {integer}   data.id 课程ID
     * @apiSuccess {string}   data.name 课程名称
     * @apiSuccess {string}   data.number 排序
     *
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     *{
     *"status": 1,
     *"info": "ok",
     *"data": [
     *{
     *"id": 1,
     *"name": "Java",
     *"number": 9
     *},
     *{
     *"id": 2,
     *"name": "PHP",
     *"number": 1
     *},
     *{
     *"id": 3,
     *"name": "ASP.NET",
     *"number": 2
     *},
     *{
     *"id": 4,
     *"name": "C/C++",
     *"number": 3
     *},
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCourseList(Request $request)
    {
        $re_list = $this->Course->getList([],['id','name','number']);
        return  $this->success($re_list);
    }

}
