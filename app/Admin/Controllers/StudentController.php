<?php

namespace App\Admin\Controllers;

use App\Models\Student;
use App\Models\City;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Widgets\Tab;
use App\Admin\Extensions\Tools\GridView;
use Illuminate\Http\Request;


class StudentController extends Controller
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

            $content->header('学生管理');
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

            $content->header('学生信息');
            $content->description('');

            $content->body($this->form($id)->edit($id));
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

            $content->header('创建课程');
            $content->description('');

            $content->body($this->form(0));
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Student::class, function (Grid $grid) {

            $grid->id('ID');
            $grid->name('姓名');



            $grid->disableExport();
            $grid->disableCreation();
            $grid->filter(function ($filter) {
                $filter->disableIdFilter();
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form($id = 0)
    {
        $s = new Student();
        $re = $s->getOne(["id"=>$id],['city_code','sex','is_prof']);
        $city = new City();
        $city_name = $city->getOne(['code'=>$re['city_code']],['name']);
        if($re['sex'] == 1){
            $sex = '男';
        }else {
            $sex = '女';
        }
        if($re['is_prof'] == 0){
            $is_prof = '在校';
        }else {
            $is_prof = '在职';
        }

        $data = [$city_name['name'],$sex,$is_prof];
        return Admin::form(Student::class, function (Form $form) use($data) {

            $form->display('account',"账号");
            $form->display('name',"姓名");
            $form->display('email',"email");
            $form->display('address',"地址");
            $form->display('birth',"生日");
            $form->displayvalue($data[0],"城市");
            $form->displayvalue($data[1],"性别");
            $form->displayvalue($data[2],"工作状态");

            $form->display('created_at', '创建时间');
            $form->display('updated_at', '最后修改时间');
        });
    }
}
