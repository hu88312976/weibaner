<?php

namespace App\Http\Controllers\Api;

use App\Models\Teacher;
use Dingo\Api\Http\Request;

class TeacherController extends BaseController
{
    private  $Teacher;

    public function __construct(Teacher $Teacher)
    {
        $this->Teacher = $Teacher;
    }

    public function getTeacherList(Request $request)
    {
        $re_list = $this->Teacher->getList();
        return  $this->success($re_list);
    }



}
