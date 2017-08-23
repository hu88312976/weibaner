<?php

namespace App\Admin\Controllers;

use App\Models\Ad;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Widgets\Tab;
use App\Admin\Extensions\Tools\GridView;
use Illuminate\Http\Request;


class AdController extends Controller
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

            $content->header('广告管理');
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

            $content->header('编辑广告');
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

            $content->header('创建广告');
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
        return Admin::grid(Ad::class, function (Grid $grid) {

            $grid->title('广告标题');

            $grid->image("图")->value(function ($image) {
                if($image=="")
                    return "";
                else if(substr($image,0,7)=="http://")
                    return "<img src='".$image."' style='width:250px;height:100px;'>";
                else if($image)
                    return "<img src='".config('admin.upload.host').$image."' style='width:250px;height:100px;'>";
            });
            $grid->link_address('广告地址');

            $grid->disableExport();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Ad::class, function (Form $form) {

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
