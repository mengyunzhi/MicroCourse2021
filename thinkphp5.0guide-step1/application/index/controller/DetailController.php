<?php
namespace app\index\controller;
use app\common\model\Course;
use think\Request; 
use app\common\model\Student;

/**
 * 上课课程信息缓存类
 */
class DetailController extends Index2Controller {
	/**
	* 获取学生对象
	*/
	public function student() {
		return $this->belongsto('student');
	}

	/**
	* 获取上课课程缓存对象
	*/
	public function klassCourse() {
		return $this->belongsto('klassCourse');
	}

	/**
	* 获取教室信息
	*/
	public function seatRoom() {
		return $this->belongsto('seatRoom');
	}

	/**
	* 获取课程信息，对应该条缓存的课程信息
	*/
	public function course() {
		return $this->belongsto('course');
	}
}