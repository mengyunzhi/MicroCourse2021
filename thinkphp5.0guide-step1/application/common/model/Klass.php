<?php
namespace app\common\model;
use think\Model;
/**
 * 班级
 */
class Klass extends Model
{
    public function courses()
    {
        return $this->belongsToMany('Course',  config('database.prefix') . 'klass_course');
    }
}