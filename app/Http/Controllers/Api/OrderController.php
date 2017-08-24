<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use Dingo\Api\Http\Request;

class OrderController extends BaseController
{
    private  $Order;

    public function __construct(Order $Order)
    {
        $this->Order = $Order;
    }


    /**
     * @api               {get} getOrderList 获取订单信息
     * @apiName           getOrderList
     * @apiGroup          Order
     * @apiVersion        1.0.0
     * @apiUse            Error404
     * @apidescribe       订单信息
     *
     * @apiParam {int} stu_id 学生id,必传参数
     * @apiParam {int} course_id 课程id,可传参数
     * @apiParam {int} order_state 支付状态0待支付1已支付2已退款3退款中4完成,可传参数
     * @apiParam {int} page_size 分页,可传参数默认每页10行
     * @apiSuccess {number} status 结果状态值，0：请求失败；1：请求成功
     * @apiSuccess {string} info 返回状态说明，status为0时，info返回错误原因，否则返回“OK”
     * @apiSuccess {array} data 返回数据
     * @apiSuccess {int}   data.id 订单id
     * @apiSuccess {int}   data.stu_id 学生id
     * @apiSuccess {int}   data.course_id 课程id
     * @apiSuccess {string}   data.price 实付金额
     * @apiSuccess {string}   data.remark 备注
     * @apiSuccess {string}   data.pay_time 付款时间
     * @apiSuccess {string}   data.created_at 下单时间
     * @apiSuccess {int}   data.order_state 支付状态0待支付1已支付2已退款3退款中4完成,可传参数默认0
     * @apiSuccess {int}   data.order_state 支付方式0现金1支付宝2微信3银联,可传参数默认0
     * @apiSuccess {string}   data.refund_time 退款时间
     * @apiSuccess {string}   data.student_name 学生名称
     * @apiSuccess {string}   data.course_name 课程名称
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
     *"id": 6,
     *"stu_id": 1,
     *"course_id": 2,
     *"price": "0.00",
     *"remark": null,
     *"pay_time": "0000-00-00 00:00:00",
     *"created_at": null,
     *"order_state": 1,
     *"pay_type": 0,
     *"refund_time": "0000-00-00 00:00:00",
     *"student_name": "张三",
     *"course_name": "PHP"
     *}
     *],
     *"from": 1,
     *"last_page": 1,
     *"next_page_url": null,
     *"path": "http://weibaner.dev/api/getOrderList",
     *"per_page": 10,
     *"prev_page_url": null,
     *"to": 1,
     *"total": 1
     *}
     *}
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOrderList(Request $request)
    {
        if ($request->has('stu_id')){
            $where= [
                'stu_id'=>$request->get('stu_id')
            ];
        }else{
            return $this->error('缺少参数');
        }

        if ($request->has('course_id')){
            $where['course_id']= $request->get('course_id');
        }

        if ($request->has('order_state')){
            $where['order_state']= $request->get('order_state');
        }

        //分页
        $page_size =  $request->get('page_size');
        if (!$page_size){
            $page_size = 10;
        }

        $re_list = $this->Order->getApiList($where,$page_size);
        return  $this->success($re_list);
    }


    /**
     * @api               {post} addOrder 提交订单
     * @apiName           addOrder
     * @apiGroup          Order
     * @apiVersion        1.0.0
     * @apiUse            Error404
     * @apidescribe       提交订单
     *
     *
     * @apiParam {int} course_id 课程id,必传参数
     * @apiParam {int} stu_id 学生id,必传参数
     * @apiParam {int} buy_num 上课人数,可传参数默认1
     * @apiParam {decimal} amount 应付金额,可传参数默认0
     * @apiParam {decimal} price 实付金额,可传参数默认0
     * @apiParam {int} pay_type 支付方式0现金1支付宝2微信3银联,可传参数默认0
     * @apiParam {int} order_state 支付状态0待支付1已支付2已退款3退款中4完成,可传参数默认0
     * @apiParam {text} remark 备注,可传参数
     * @apiSuccess {number} status 结果状态值，0：请求失败；1：请求成功
     * @apiSuccess {string} info 返回状态说明，status为0时，info返回错误原因，否则返回“OK”
     * @apiSuccess {array} data 返回数据
     * @apiSuccess {int}   data.id 广告id
     * @apiSuccess {int}   data.title 广告标题
     * @apiSuccess {int}   data.image 广告图片
     * @apiSuccess {int}   data.link_address 广告地址
     *
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     *{
     *"status": 1,
     *"info": "ok",
     *"data": [
     *{
     *"id": 1,
     *"title": "广告1",
     *"image": "specialty_images/1503369608_88542300.jpg",
     *"link_address": "www.baidu.com"
     *}
     *]
     *}
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public  function addOrder(Request $request){
        if(($request->has('stu_id')) && ($request->has('course_id')) ){
            $data= [
                'stu_id'=>$request->get('stu_id'),
                'course_id'=>$request->get('course_id')
            ];
        }else{
            return $this->error('缺少参数');
        }
        $data['buy_num'] = $request->get('buy_num');
        if (empty($data['buy_num'])){
            $data['buy_num'] = 1;
        }

        $data['amount'] = $request->get('amount');
        if (empty($data['amount'])){
            $data['amount'] = 0;
        }
        $data['price'] = $request->get('price');
        if (empty($data['price'])){
            $data['price'] = 0;
        }

        $data['pay_type'] = $request->get('pay_type');
        if (empty($data['pay_type'])){
            $data['pay_type'] = 0;
        }

        $data['order_state'] = $request->get('order_state');
        if (empty($data['order_state'])){
            $data['order_state'] = 0;
        }

        $data['remark'] = $request->get('remark');

        return $this->success($this->Order->Add($data));
    }

}
