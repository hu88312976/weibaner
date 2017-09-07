<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Specialty;

class Course extends BaseModel
{
    //
    protected $table      = "course";
    protected $primaryKey = 'id';

    public function getDetail($course_id){
        $res['info'] = $this->select('course.id as course_id','course.name as course_name','classroom.name as room_name'
            ,'classroom.roomaddress','classroom.maximum','course.start_time','course.end_time',
            'teacher.name as teacher_name','teacher.specInfo','teacher.teachInfo','teacher.title','teacher.image')
            ->leftjoin('teacher','teacher.id','course.teacher_id')
            ->leftjoin('classroom','classroom.id','course.room_id')
            ->where('course.id','=',$course_id)->get();

        $specialty = new Specialty();
        $list =  $specialty->getList(['course_id'=>$course_id],['id','name','info']);

        $res['specialty_list']=$list;
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
