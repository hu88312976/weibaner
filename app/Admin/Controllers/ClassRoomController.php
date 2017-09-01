<?php

namespace App\Admin\Controllers;

use App\Models\ClassRoom;
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


class ClassRoomController extends Controller
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

            $content->header('教室管理');
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

            $content->header('编辑教室');
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

            $content->header('创建教室');
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
        return Admin::grid(ClassRoom::class, function (Grid $grid) {

            $grid->city_code('城市')->value(function($city_code){
                $city = new City();
                return $city->getOne(['code'=>$city_code])->name;
            });
            $grid->name('教室名称');
            $grid->roomaddress('教室地址');
          //  $grid->maximum('最大人数');

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
        return Admin::form(ClassRoom::class, function (Form $form) {
            $form->select('city_code', '城市')->options(City::all()->pluck('name','code'));
            $form->text('name',"教室名称");
            $form->text('roomaddress','教室地址');
            $form->number('maximum','最大人数');
            $form->display('created_at', '创建时间');
            $form->display('updated_at', '最后修改时间');
        });
    }
}
