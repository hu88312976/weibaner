<?php

namespace App\Admin\Controllers;

use App\Models\industry;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Widgets\Tab;
use App\Admin\Extensions\Tools\GridView;
use Illuminate\Http\Request;


class IndustryController extends Controller
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

            $content->header('行业管理');
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

            $content->header('编辑行业');
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

            $content->header('创建行业');
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
        return Admin::grid(Industry::class, function (Grid $grid) {
            $grid->id('ID');
            $grid->name('行业名称');
            $grid->order_by('排序')->editable()->sortable();

        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Industry::class, function (Form $form) {


            $form->text('name',"名称");
            $form->number('order_by', "行业排序")->value(9);
            $form->display('created_at', '创建时间');
            $form->display('updated_at', '最后修改时间');
        });
    }
}
