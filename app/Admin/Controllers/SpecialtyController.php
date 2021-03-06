<?php

namespace App\Admin\Controllers;

use App\Models\Specialty;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\City;
use App\Models\ClassRoom;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Widgets\Tab;
use App\Admin\Extensions\Tools\GridView;
use Illuminate\Http\Request;


class SpecialtyController extends Controller
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

            $content->header('技能管理');
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

            $content->header('编辑技能');
            $content->description('');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('创建技能');
            $content->description('');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Specialty::class, function (Grid $grid) {

            $grid->name('技能名称');
            $grid->info('技能信息');
            $grid->course_id('归属课程')->value(function($course_id){
                $re = new Course();
                return $re::find($course_id)->name;
            });


            $grid->disableExport();
            $grid->filter(function ($filter) {
                $filter->like('name', '技能名称');
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
        return Admin::form(Specialty::class, function (Form $form) {

            $form->text('name','技能名称');
            $form->text('info','技能信息');

            $course = new Course();
            $form->select('course_id', "归属课程")->options($course::all()->pluck('name','id'));



            $form->display('created_at', '创建时间');
            $form->display('updated_at', '最后修改时间');
        });
    }
}
