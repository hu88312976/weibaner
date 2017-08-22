<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Hash;
use App\Models\Student;
use App\Models\City;
use Dingo\Api\Http\Request;

class StudentController extends BaseController
{
    private  $Student;

    public function __construct(Student $Student)
    {
        $this->Student = $Student;
    }


    /**
     * @api               {get} LoginStu 学生登录
     * @apiName           LoginStu
     * @apiGroup          Student
     * @apiVersion        1.0.0
     * @apiUse            Error404
     * @apidescribe       学生登录
     *
     * @apiParam {string} account 账号,必传参数
     * @apiParam {string} pwd 密码,必传参数
     *
     * @apiSuccess {number} status 结果状态值，0：请求失败；1：请求成功
     * @apiSuccess {string} info 返回状态说明，status为0时，info返回错误原因，否则返回“OK”
     * @apiSuccess {array} data 返回新增的id -1等于失败
     * @apiSuccess {int}   data.id 学生id
     * @apiSuccess {string}   data.phone 电话
     * @apiSuccess {string}   data.email 邮箱
     * @apiSuccess {string}   data.name 姓名
     * @apiSuccess {string}   data.city_code 城市代码
     * @apiSuccess {string}   data.address 地址
     * @apiSuccess {string}   data.sex 性别
     * @apiSuccess {string}   data.birth 生日
     * @apiSuccess {string}   data.is_prof 在职状态
     * @apiSuccess {string}   data.city_name 城市名称
     *
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     *{
     *"status": 1,
     *"info": "ok",
     *"data": {
     *"id": 7,
     *"name": "3",
     *"phone": "4",
     *"email": "5",
     *"city_code": "180",
     *"address": "7",
     *"sex": "男",
     *"birth": "2017-05-06",
     *"is_prof": 在校,
     *"city_name": "武汉市"
    }
    }
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function LoginStu(Request $request)
    {
        $re_list = $this->Student->getOne(['account'=>$request->get('account'),'pwd'=>$request->get('pwd')],['id','name','city_code','sex','phone','email','address','birth','is_prof']);
        $sex = $re_list['sex'];
        $city = new  City();
        $re_list['city_name'] = $city->getOne(['code'=>$re_list['city_code']])->name;
        $re_list['sex'] = $sex == 1 ? '男':'女';
        $re_list['is_prof'] = $sex == 0 ? '在校':'在职';
        return  $this->success($re_list);
    }
    /**
     * @api               {post} addStudent 学生注册
     * @apiName           addStudent
     * @apiGroup          Student
     * @apiVersion        1.0.0
     * @apiUse            Error404
     * @apidescribe       学生注册
     *
     * @apiParam {string} account 账号,必传参数
     * @apiParam {string} pwd 密码,必传参数
     * @apiParam {string} name 姓名,可传参数
     * @apiParam {string} phone 电话,可传参数
     * @apiParam {string} email 邮箱，可传参数
     * @apiParam {string} city_code 城市代码，可传参数
     * @apiParam {string} address 地址，可传参数
     * @apiParam {int} sex 性别1男2女，可传参数
     * @apiParam {date} birth 生日，可传参数
     * @apiParam {int} is_prof 是否在职0在校1在职，可传参数
     * @apiSuccess {number} status 结果状态值，0：请求失败；1：请求成功
     * @apiSuccess {string} info 返回状态说明，status为0时，info返回错误原因，否则返回“OK”
     * @apiSuccess {array} data 返回新增的id -1等于失败
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
    public function addStudent(Request $request){
        if( ($request->has('account')) && ($request->has('pwd'))  ){
        //    $password = Hash::make($request->get('pwd'));
            //对加密的 A 密码进行验证
            // if (Hash::check('secret', $hashedPassword))
              // {
                     // The passwords match...
               // }
           $data= [
               'account'=> $request->get('account'),
               'pwd'=> $request->get('pwd'),
           ];
        }else{
            return $this->error('缺少参数');
        }
        $data['name'] = $request->get('name');
        $data['phone'] = $request->get('phone');
        $data['email'] = $request->get('email');
        $data['city_code'] = $request->get('city_code');
        $data['address'] = $request->get('address');
        $data['sex'] = $request->get('sex');
        $data['birth'] = $request->get('birth');
        $data['is_prof'] = $request->get('is_prof');
        $id = $this->Student->add($data);

        $v = is_numeric ($id) ? $id : -1;
        return $this->success($v);
    }
}
