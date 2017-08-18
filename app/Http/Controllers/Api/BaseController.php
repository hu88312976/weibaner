<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/22
 * Time: 15:08
 */

namespace App\Http\Controllers\Api;

use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;

/**
 * @apiDefine         Success
 * @apiSuccessExample Success-Response:
 * HTTP/1.1 200 OK
 * {
 *  "status_code": 200,
 *  "message": "ok"
 * }
 */
/**
 * @apiDefine Header
 * @apiHeader {String} Accept application/vnd.myapp.v1+json //这个写在请求头里面请与参数区分开
 * @apiHeaderExample {json} 请求头(header):
 *     {
 *       "Accept": "application/vnd.myapp.v1+json"
 *     }
 */
/**
 * @apiDefine HeaderToken
 * @apiHeader {String} Accept application/vnd.myapp.v1+json //这个写在请求头里面请与参数区分开
 * @apiHeader {String} Authorization Bearer token //用户登录时返回的token字符串，注意Bearer是必须的，与token用一个空格分开
 * @apiHeaderExample {json} 请求头(header):
 *     {
 *       "Accept": "application/vnd.myapp.v1+json"
 *       "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNDgxMjUxMDk1LCJleHAiOjE0ODEyODcwOTUsIm5iZiI6MTQ4MTI1MTA5NSwianRpIjoiUHJLWjllZXhrQWFWY1NMViIsInN1YiI6MTQ4MTE3ODc1MywidGVhY2hlcl9pZCI6MTQ4MTE3ODc1MywidGltZXN0YW1wIjoxNDgxMjUxMDk1LCJtb2JpbGUiOiIxNTYwMTk0ODU2MiJ9.6w-k7t9JHU2qfJ5d8VSyu3jikMS-Y_gUrJYUg7oJELs"
 *     }
 */
/**
 * @apiDefine       Error404
 * @apiError        404 Not Found 接口不存在
 * @apiErrorExample 404 Not Found:
 * HTTP/1.1 404 Not Found
 * {
 *  "message": "404 Not Found",
 *  "status_code": 404
 * }
 */
/**
 * @apiDefine       Error405
 * @apiError        405 Method Not Allowed 请求方法错误，比如应该是post，写成了get
 * @apiErrorExample 405 Method Not Allowed:
 * HTTP/1.1 405 Method Not Allowed
 * {
 *  "message": "405 Method Not Allowed",
 *  "status_code": 405
 * }
 */

/**
 * @apiDefine       Error422
 * @apiError        422 Unprocessable Entity 参数错误，一般是参数缺少或者格式不对。
 * @apiErrorExample 422 Unprocessable Entity:
 * HTTP/1.1 422 Unprocessable Entity
 *{
 *  "message": "422 Unprocessable Entity",
 *  "errors": "错误信息",
 *  "status_code": 422
 *}
 */

/**
 * @apiDefine       ErrorCode
 * @apiErrorExample Error-Response:
 * HTTP/1.1 200 OK
 * {
 *  "errcode": 21,
 *  "errmsg": "参数错误"
 * }
 */
class BaseController extends Controller
{
    use Helpers;

    public function success($data)//定义回复类型、回复码、回复数据
    {
        return \Response::json([
            "status" => 1,
            "info" => "ok",
            "data" => $data
        ], 200);
    }

    public function error($info)//定义回复类型、回复码、回复数据
    {
        return \Response::json([
            "status" => 0,
            "info" => $info
        ], 200);
    }

    protected function token($token)
    {
        $member = $this->user();

        return [
            "token" => $token,
            "ttl" => config("jwt.ttl"),
            "refresh_ttl" => config("jwt.refresh_ttl"),
            "member" => $member,
        ];
    }

    protected function user()
    {
        if (\Auth::guard("members")->check()) {
            return \Auth::guard("members")->user();
        } else {
            return false;
        }
    }
}
