<?php

namespace App\Admin\Controllers;

use App\Models\City;
use App\Models\IndustryType;
use App\Models\Industry;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Widgets\Tab;
use App\Admin\Extensions\Tools\GridView;
use Illuminate\Http\Request;


class IndustryTypeController extends Controller
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

            $content->header('行业类别管理');
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

            $content->header('编辑行业类别');
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

            $content->header('创建行业类别');
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
        return Admin::grid(IndustryType::class, function (Grid $grid) {

            $grid->name('行业类别名称');
            $grid->industry_id("归属行业")->value(function ($industry_id){
                $industry = new Industry();
                return $industry->find($industry_id)->name;
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
        return Admin::form(IndustryType::class, function (Form $form) {

            $form->text('name',"名称");
            $industry = new Industry();
            $form->select('industry_id', "归属行业")->options($industry::all()->pluck('name','id'));
            $form->display('created_at', '创建时间');
            $form->display('updated_at', '最后修改时间');
        });
    }
}
