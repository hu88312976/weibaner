<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Hash;
use App\Models\Student;
use Dingo\Api\Http\Request;

class StudentController extends BaseController
{
    private  $Student;

    public function __construct(Student $Student)
    {
        $this->Student = $Student;
    }


    public function getStudentInfo(Request $request)
    {
        $re_list = $this->Student->getList();
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
            $id = $this->Student->add($request->all());
        }else{
            return $this->error('缺少参数');
        }


        $v = is_numeric ($id) ? $id : -1;
        return $this->success($id);
    }
}
