<?php

namespace App\Admin\Controllers;

use App\Models\Comment;
use App\Models\Course;
use App\Models\Student;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Widgets\Tab;
use App\Admin\Extensions\Tools\GridView;
use Illuminate\Http\Request;


class CommentController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('评论管理');
            $content->description('');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('编辑评论');
            $content->description('');

            $content->body($this->form()->edit($id));
        });
    }


    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Comment::class, function (Grid $grid) {

            $grid->course_id('课程名称')->value(function ($course_id){
                $course = new Course();
                $re = $course->getOne(['id'=>$course_id],['name']);

                if (empty($re['name'])){
                    return "";
                }
                return $re['name'] ;
            });
            $grid->level('评论等级');
            $grid->message('评论内容');
            $grid->stu_id('发布学生')->value(function ($stu_id){
                $stu = new Student();
                $re = $stu->getOne(['id'=>$stu_id],['name']);

                if (empty($re['name'])){
                    return "";
                }
                return $re['name'] ;
            });




            $grid->disableExport();
            $grid->disableCreation();
            //关闭所有操作
            $grid->disableActions();
            $grid->filter(function ($filter) {
                $filter->like('message', '评论内容');
                // $filter->disableIdFilter();
            });

        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Comment::class, function (Form $form) {

            $form->text('title','广告标题');
            $form->text('link_address','连接地址');

            list($usec, $sec) = explode(" ", microtime());
            $name = $sec.str_replace('0.', '_',$usec);
            $form->image('image', "主图")->move("specialty_images", $name.".jpg");


            $form->display('created_at', '创建时间');
            $form->display('updated_at', '最后修改时间');
        });
    }
}
