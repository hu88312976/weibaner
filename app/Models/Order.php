<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Order extends BaseModel
{
    public function Student()
    {
        return $this->belongsTo(Student::class,'stu_id');
    }

    //
    protected $table      = "order";
    protected $primaryKey = 'id';



    public function getApiList(array $where = [], $pageSize = '')
    {
        $res = $this->leftjoin('student','student.id','order.stu_id')
                    ->leftjoin('course','course.id','order.course_id')
                    ->select('order.id','order.stu_id','order.course_id','order.price','order.remark',
                             'order.pay_time','order.created_at','order.order_state','order.pay_type',
                            'order.refund_time','order.created_at',
                        'student.name as student_name','course.name as course_name')->MultiWhere($where)->paginate($pageSize);
        $res = $res->toArray();
        return $res;
    }

    /**
     * 按条件查询单条数据
     */
    public function getOne(array $where = [], $fields = '*')
    {
        return $this->_getOne($where, $fields);
    }
    /**
     * 按条件查询全部数据,根据配置显示条数显示
     */
    public function getList(array $where = [], $fields = '*', $order = '', $pageSize = '')
    {
        $order = ['id' => 'asc'];
        if ($pageSize) {
            $res = $this->getPaginate($where, $fields, $order, $pageSize);
            if ($res) {
                $res = $res->toArray();
            }


        } else {
            $res = $this->getAll($where, $fields, $order);
            if ($res) {
                $res = $res->toArray();
            }
        }
        return $res;
    }

    public function Add($data){
        return $this->_Add($data);
    }
}
