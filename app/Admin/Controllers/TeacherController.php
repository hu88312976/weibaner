<?php

namespace App\Admin\Controllers;

use App\Models\Teacher;
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


class TeacherController extends Controller
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

            $content->header('教师管理');
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

            $content->header('编辑教师');
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

            $content->header('创建教师');
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
        return Admin::grid(Teacher::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->name('名称');
            $grid->phone('电话');
            $grid->image("图")->value(function ($image) {
                if($image=="")
                    return "";
                else if(substr($image,0,7)=="http://")
                    return "<img src='".$image."' style='width:40px;height:40px;'>";
                else if($image)
                    return "<img src='".config('admin.upload.host').$image."' style='width:40px;height:40px;'>";
            });
            $grid->email('邮箱');
            $grid->sex('性别')->value(function($sex){
                if ($sex ==1){
                    return '男';
                }else{
                    return '女';
                }
            });

            $grid->city_code('城市')->value(function($city_code){
                $city = new City();
                $data =   $city->getOne(['code'=>$city_code],['name']);
                return $data['name'];
            });


            $grid->disableExport();
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
    protected function form()
    {
        return Admin::form(Teacher::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('name',"姓名");
            $form->mobile('phone','电话');
            $form->select('sex','性别')->options(['1'=>'男','2'=>'女']);
            $form->text('email','邮箱');
            $form->date('birth','生日');

            list($usec, $sec) = explode(" ", microtime());
            $name = $sec.str_replace('0.', '_',$usec);
            $form->image('image', "主图")->move("teacher_images", $name.".jpg");

            $city= new City();
            $form->select('city_code','城市')->options($city::all()->pluck('name','code'));
            $form->text('freeTime','空闲时间');
            $form->currency('appointmentPrice','预约金额');
            $form->select('appointmentUnits','预约单位')->options(['1'=>'小时','2'=>'天','3'=>'月']);
            $form->select('auditStatus','审核状态')->options(['1'=>'待审核','2'=>'审核中','3'=>'已审核','4'=>'审核失败']);
            $form->text('title','教师头衔');
            $form->textarea('specInfo','教师技能');
            $form->textarea('teachInfo','教师个人介绍');
            $form->display('created_at', '创建时间');
            $form->display('updated_at', '最后修改时间');
        });
    }
}
