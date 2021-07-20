<?php
namespace app\common\model;
use think\Model;

class Score extends Model
{   
	    /**
     * 通过course_id获取对应的课程对象
     */
    public function Course() {
        return $this->belongsTo('course');
    }

}