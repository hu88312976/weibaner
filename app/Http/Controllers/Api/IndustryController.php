<?php

namespace App\Http\Controllers\Api;

use App\Models\Industry;
use Dingo\Api\Http\Request;

class IndustryController extends BaseController
{
    private  $Industry;

    public function __construct(Industry $Industry)
    {
        $this->Industry = $Industry;
    }


    /**
     * @api               {get} getIndustryList 获取行业列表
     * @apiName           getIndustryList
     * @apiGroup          Industry
     * @apiVersion        1.0.0
     * @apiUse            Error404
     * @apidescribe       行业列表
     *
     * @apiSuccess {number} status 结果状态值，0：请求失败；1：请求成功
     * @apiSuccess {string} info 返回状态说明，status为0时，info返回错误原因，否则返回“OK”
     * @apiSuccess {array} data 返回数据
     * @apiSuccess {int}   data.id 行业id
     * @apiSuccess {int}   data.name 行业名称
     *
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     *{
     *"status": 1,
     *"info": "ok",
     *"data": [
     *{
     *"id": 1,
     *"name": "软件开发"
     *}
     *]
     *}
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getIndustryList(Request $request)
    {
        $re_list = $this->Industry->getList([],['id','name']);
        return  $this->success($re_list);
    }

}
