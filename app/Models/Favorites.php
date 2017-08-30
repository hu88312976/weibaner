<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorites extends BaseModel
{
    //
    protected $table      = "favorites";
    protected $primaryKey = 'id';

    public function getApiList(array $where = [],  $pageSize = '')
    {
        $res = $this->leftjoin('course','course.id','favorites.course_id')
            ->select('favorites.*','course.id as course_id','course.name as course_name','course.image')->MultiWhere($where)->paginate($pageSize);
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
        return $this->_add($data);
    }

    public function Del($where){
        return $this->_del($where);
    }
}
