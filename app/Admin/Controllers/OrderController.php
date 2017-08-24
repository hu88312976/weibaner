<?php

namespace App\Admin\Controllers;

use App\Models\Order;
use App\Models\Student;
use App\Models\Course;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Widgets\Tab;
use App\Admin\Extensions\Tools\GridView;
use Illuminate\Http\Request;


class OrderController extends Controller
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

            $content->header('订单管理');
            $content->description('');
            $content->body($this->grid());
        });
    }



    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Order::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->Student()->name('学生名称');

            $grid->course_id('购买课程')->value(function ($course_id){
                $course = new Course();
                return $course->find($course_id)->name;
            });


            $grid->buy_num('购买数量');


            $grid->order_state('订单状态')->value(function ($pay_state){
                $data=['0'=>'待支付','1'=>'已支付','2'=>'已退款','3'=>'退款中','4'=>'完成'];
                return $data[$pay_state];
            });
            $grid->pay_type('支付方式')->value(function ($pay_type){
                $data=['0'=>'现金','1'=>'支付宝','2'=>'微信','3'=>'银联'];
                return $data[$pay_type];
            });


            $grid->amount('应付金额')->value(function ($old_price) {
                return "\$$old_price";
            })->badge('red');

            $grid->price('实付金额')->value(function ($price) {
                return "\$$price";
            })->badge('green');

            $grid->created_at('下单时间')->sortable();
            $grid->pay_time('支付时间')->sortable();
            $grid->refund_time('退款时间')->sortable();
            $grid->remark('备注');


            $grid->disableExport();
            $grid->disableCreation();
            //关闭所有操作
            $grid->disableActions();
            $grid->filter(function ($filter) {
                $filter->disableIdFilter();
                $filter->like('student.name', '学生姓名');
                $filter->is('order_state', '订单状态')->select(['0'=>'待支付','1'=>'已支付','2'=>'已退款','3'=>'退款中','4'=>'完成']);
                $filter->is('pay_type', '支付方式')->select(['0'=>'现金','1'=>'支付宝','2'=>'微信','3'=>'银联']);
                $filter->between('created_at', '下单时间')->datetime();
            });
        });
    }

}
