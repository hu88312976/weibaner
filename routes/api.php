<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app(Dingo\Api\Routing\Router::class);

$api->version('v1', ["prefix" => "api/","namespace" => "App\\Http\\Controllers\\Api", "middleware" => ["api.log", "api.response.log", "cors"]],
    function (Dingo\Api\Routing\Router $api) {
        $api->get("getTeacherList", "TeacherController@getTeacherList");//获取老师列表
        $api->get("getTeacherList", "TeacherController@getTeacherList");//获取老师列表
        $api->get("getCourseList", "CourseController@getCourseList");//获取分类列表
        $api->get("getIndustryList", "IndustryController@getIndustryList");//获取技能列表
        $api->get("getStudentList", "StudentController@getStudentList");//获取学生列表

        $api->post("addStudent","StudentController@addStudent");//注册学生
    });
