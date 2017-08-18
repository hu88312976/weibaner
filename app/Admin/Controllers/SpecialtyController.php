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
            $grid->teacher_id('发布教师')->value(function($teacher_id){
                $re = new Teacher();
                return $re::find($teacher_id)->name;
            });
            $grid->city_code('发布城市')->value(function($city_code){
                $re = new City();
                $re =  $re->getOne(['code'=>$city_code],['name']);
                return $re['name'];
            });

            $grid->room_id('教室名称')->value(function($room_id){
                $re = new ClassRoom();
                $re =  $re->getOne(['id'=>$room_id],['name']);
                return $re['name'];
            });

            $grid->old_price('原价')->value(function ($old_price) {
                return "\$$old_price";
            })->badge('red');

            $grid->price('现价')->value(function ($price) {
                return "\$$price";
            })->badge('green');


            $grid->state('审核状态')->value(function($state){
                switch ($state){
                    case 0:
                        return "审核中";
                        break;
                    case 1:
                        return "已上架";
                        break;
                    case 2:
                        return "已过期";
                        break;
                    case 3:
                        return "已拒绝";
                        break;
                }
            });
            $grid->disableExport();
            $grid->filter(function ($filter) {
                $filter->like('name', '技能名称');
                $filter->is('state', '审核状态')->select(["0"=>"审核中","1"=>"已上架","2"=>"已过期","3"=>"已拒绝"]);
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
            $states = [
                'on'  => ['value' => 1, 'text' => '打开', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => '关闭', 'color' => 'danger'],
            ];
            $form->switch('is_heat','是否热门')->states($states);

            $course = new Course();
            $form->select('course_id', "归属课程")->options($course::all()->pluck('name','id'));

            $teacher = new Teacher();
            $form->select('teacher_id', "发布教师")->options($teacher::all()->pluck('name','id'));
            $form->select('units', "时间单位")->options(['1'=>'小时','2'=>'天','3'=>'月']);
            $form->datetime('start_time','开始时间');
            $form->datetime('end_time','结束时间');
            $form->currency('old_price','原价');
            $form->currency('price','现价');
            $form->select('course_type', "课程类型")->options(['1'=>'分享','2'=>'培训']);
            $city = new City();
            $form->select('city_code', "课程类型")->options($city::all()->pluck('name','code'));
            $form->select('room_id', "教室")->options(ClassRoom::all()->pluck('name','id'));
            $form->text('address','详细地址');

            list($usec, $sec) = explode(" ", microtime());
            $name = $sec.str_replace('0.', '_',$usec);
            $form->image('image', "主图")->move("specialty_images", $name.".jpg");

            $form->select('state', "审核状态")->options(['0'=>'审核中','1'=>'已上架','2'=>'已过期','3'=>'已拒绝']);

            $form->display('created_at', '创建时间');
            $form->display('updated_at', '最后修改时间');
        });
    }
}
