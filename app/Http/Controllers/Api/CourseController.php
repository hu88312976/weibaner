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
     *
     * @apiParam {int} industry_id 行业id,可传参数
     * @apiParam {int} is_heat 是否热门0否1是,可传参数
     * @apiParam {int} teacher_id 教师id,可传参数
     * @apiParam {int} course_type 课程类型1/2   分享/培训,可传参数
     * @apiParam {string} city_code 城市代码,可传参数
     * @apiParam {string} order_by 排序字段,可传参数
     * @apiParam {int} order_by_type 0升1降,可传参数
     * @apiParam {int} page_size 每页数量默认10,可传参数
     * @apiParam {int} page 第几页,可传参数
     * @apiSuccess {number} status 结果状态值，0：请求失败；1：请求成功
     * @apiSuccess {string} info 返回状态说明，status为0时，info返回错误原因，否则返回“OK”
     * @apiSuccess {array} data 返回数据
     * @apiSuccess {int}   data.id 课程ID
     * @apiSuccess {string}   data.name 课程名称
     * @apiSuccess {int}   data.course_type 课程类型1/2   分享/培训
     * @apiSuccess {string}   data.buy_number 购买数量
     * @apiSuccess {string}   data.click_number 点击数量
     * @apiSuccess {string}   data.old_price 原始价格
     * @apiSuccess {string}   data.price 现价
     * @apiSuccess {int}   data.is_heat 是否热门0否1是
     * @apiSuccess {string}   data.image 图片
     * @apiSuccess {int}   current_page 当前页
     * @apiSuccess {int}   total 总条数
     * @apiSuccess {int}   last_page 总页数
     *
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     *{
     *"status": 1,
     *"info": "ok",
     *"data": [
     * current_page": 1,
     *{
     *"id": 1,
     *"name": "Java",
     *"course_type": 1,
     *"buy_number": 0,
     *"click_number": 0,
     *"old_price": "100.00",
     *"price": "99.00",
     *"is_heat": 1,
     *"image": "specialty_images/1503368798_06412900.jpg"
     *}
     *]
     *}
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCourseList(Request $request)
    {
        $where['state'] = '1';

        if ($request->has('industry_id')){
            $where['industry_id']=$request->get('industry_id');
        }

        if ($request->has('is_heat')){
            $where['is_heat']=$request->get('is_heat');
        }

        if ($request->has('teacher_id')){
            $where['teacher_id']=$request->get('teacher_id');
        }

        if ($request->has('course_type')){
            $where['course_type']=$request->get('course_type');
        }

        if ($request->has('city_code')){
            $where['city_code']=$request->get('city_code');
        }
        if ($request->has('order_by')){
            $order =$request->get('order_by');
            $order_by_type = $request->get('order_by_type');
            if (empty($order_by_type)){
                $order_by_type= 'asc';
            }else{
                $order_by_type = $order_by_type== 0 ?'asc':'desc';
            }
            $order_by=[$order=>$order_by_type];
        }else{
            $order_by = ['id' => 'id'];
        }

        //分页
        $page_size =  $request->get('page_size');
        if (!$page_size){
            $page_size = 10;
        }

        $re_list = $this->Course->getList($where,['id','name','course_type','buy_number','click_number','old_price','price','is_heat','image'],$order_by,$page_size);
        return  $this->success($re_list);
    }

    public function getCourseDetail(Request $request){
        if($request->has('course_id')){
            $course_id = $request->get('course_id');
        }else{
            return $this->error('缺少参数');
        }
        $re_list = $this->Course->getDetail($course_id);
        return  $this->success($re_list);
    }

}
