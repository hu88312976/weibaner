<?php

namespace App\Models;

use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Model;
use DB;

class Specialty extends BaseModel
{
    //
    protected $table      = "specialty";
    protected $primaryKey = 'id';

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
    public function getApiList(array $where = [], $order = '', $pageSize = '')
    {
        $res = $this->select('specialty.id','specialty.name as specialty_name',
            'teacher.name as teacher_name','specialty.buy_number',
            'specialty.look_number','specialty.old_price','specialty.price','specialty.image')->leftjoin('teacher','teacher.id','specialty.teacher_id')->multiWhere($where)->order($order)->paginate($pageSize);
        return $res;
    }

    public function getApiDetail($specialty_id = ''){
        $res = $this->select('specialty.id','specialty.name as specialty_name',
            'teacher.name as teacher_name','specialty.buy_number',
            'specialty.look_number','specialty.old_price','specialty.price','specialty.image')
            ->leftjoin('teacher','teacher.id','specialty.teacher_id')->where('specialty_id','=',$specialty_id)
            ->get();
        return $res;
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
}
