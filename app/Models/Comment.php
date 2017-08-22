<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CommentGood;
use DB;

class Comment extends BaseModel
{
    //
    protected $table      = "comment";
    protected $primaryKey = 'id';

    public function getApiList(array $where = [],$pagesize=''){
        $res = $this->leftjoin('student','student.id','comment.stu_id')
            ->select('comment.*','student.name as student_name')
            ->where($where)
            ->paginate($pagesize);

        $cg = new CommentGood();
        for ($i= 0;$i< count($res); $i++){
            $id= $res[$i]['id'];
            $good_num = $cg->select(DB::raw('count(id) as good_num'))->where('comment_id','=',$id)->get();
            $res[$i]['good_num']= $good_num[0]['good_num'];
        }
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
}
