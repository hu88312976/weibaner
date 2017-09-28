<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use App\Models\CommentGood;
use Dingo\Api\Http\Request;
use DB;

class CommentController extends BaseController
{
    private  $Comment;
    private  $Cg;

    public function __construct(Comment $Comment)
    {
        $this->Comment = $Comment;
        $this->Cg = new CommentGood();
    }


    /**
     * @api               {get} getCommentList 获取评论列表
     * @apiName           getCommentList
     * @apiGroup          Comment
     * @apiVersion        1.0.0
     * @apiUse            Error404
     * @apidescribe       评论列表
     *
     * @apiParam {int} course_id 课程id，必传参数
     * @apiSuccess {number} status 结果状态值，0：请求失败；1：请求成功
     * @apiSuccess {string} info 返回状态说明，status为0时，info返回错误原因，否则返回“OK”
     * @apiSuccess {array} data 返回数据
     * @apiSuccess {int}   data.id 评论id
     * @apiSuccess {int}   data.course_id 课程id
     * @apiSuccess {int}   data.level 评论等级
     * @apiSuccess {string}   data.message 评论内容
     * @apiSuccess {int}   data.stu_id 学生id
     * @apiSuccess {string}   data.student_name 学生名称
     * @apiSuccess {int}   data.parent_id 上一级id
     * @apiSuccess {string}   data.created_at 创建时间
     * @apiSuccess {int}   data.good_num 点赞数
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
     *"course_id": 1,
     *"level": 1,
     *"message": "这个课程很不错",
     *"stu_id": 1,
     *"parent_id": 0,
     *"created_at": "2017-08-22 15:43:53",
     *"student_name": "张三",
     *"good_num": 2
     *},
     *{
     *"id": 2,
     *"course_id": 1,
     *"level": null,
     *"message": "老师讲的真好",
     *"stu_id": 2,
     *"parent_id": 0,
     *"created_at": "2017-08-22 15:44:08",
     *"student_name": "李四",
     *"good_num": 1
     *},
     *{
     *"id": 3,
     *"course_id": 1,
     *"level": null,
     *"message": "我没听懂",
     *"stu_id": 3,
     *"parent_id": 0,
     *"created_at": "2017-08-22 15:44:25",
     *"student_name": "王五",
     *"good_num": 1
     *},
     *{
     *"id": 4,
     *"course_id": 1,
     *"level": null,
     *"message": "下次还要来",
     *"stu_id": 4,
     *"parent_id": 0,
     *"created_at": "2017-08-22 15:44:29",
     *"student_name": "赵六",
     *"good_num": 3
     *}
     *],
     *"from": 1,
     *"last_page": 1,
     *"next_page_url": null,
     *"path": "http://weibaner.dev/api/getCommentList",
     *"per_page": 10,
     *"prev_page_url": null,
     *"to": 4,
     *"total": 4
     *}
     *}
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCommentList(Request $request)
    {
        if ($request->has('course_id')){
            $where['course_id']=$request->get('course_id');
        }else{
            return $this->error('缺少参数');
        }

        //分页
        $page_size =  $request->get('page_size');
        if (!$page_size){
            $page_size = 10;
        }


        $re_list = $this->Comment->getApiList($where,$page_size);
        return  $this->success($re_list);
    }

    /**
     * @api               {post} addComment 添加评论
     * @apiName           addComment
     * @apiGroup          Comment
     * @apiVersion        1.0.0
     * @apiUse            Error404
     * @apidescribe       添加评论
     *
     * @apiParam {int} course_id 课程id,必传参数
     * @apiParam {int} stu_id 学生id,必传参数
     * @apiParam {int} level 评论等级,可传参数
     * @apiParam {string} message 姓名,可传参数
     * @apiParam {int} parent_id 上一级id，可传参数
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

    public function addComment(Request $request){
        if ($request->has('course_id') && ($request->has('stu_id'))){
            $data['course_id']=$request->get('course_id');
            $data['stu_id']=$request->get('stu_id');
        }else{
            return $this->error('缺少参数');
        }
        $res = $this->Comment->getOne(['stu_id'=>$request->get('stu_id'),'course_id'=>$request->get('course_id')]);
        if(count($res) > 0){
            return $this->error('重复评论');
        }
        DB::table('course')->where('id','=',$request->get('course_id'))->increment('comment_number');
        $data['message']=$request->get('message');
        $data['level']=$request->get('level');
        $data['parent_id']=$request->get('parent_id');

        return $this->success($this->Comment->add($data));
    }


    /**
     * @api               {post} CommentUp 评论点赞和反点
     * @apiName           CommentUp
     * @apiGroup          Comment
     * @apiVersion        1.0.0
     * @apiUse            Error404
     * @apidescribe       添加评论
     *
     * @apiParam {int} comment_id 课程id,必传参数
     * @apiParam {int} stu_id 学生id,必传参数
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
    public function CommentUp(Request $request){
        if ($request->has('comment_id') && ($request->has('stu_id'))){
            $data['comment_id']=$request->get('comment_id');
            $data['stu_id']=$request->get('stu_id');
        }else{
            return $this->error('缺少参数');
        }

        $where = ['stu_id'=>$request->get('stu_id'),'comment_id'=>$request->get('comment_id')];
        $res = $this->Cg->getOne($where);
        if(count($res) > 0){
            return $this->success($this->Cg->Del($where));
        }else{
            return $this->success($this->Cg->add($data));
        }

    }


}
