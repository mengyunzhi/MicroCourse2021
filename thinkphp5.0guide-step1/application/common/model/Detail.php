<?php
namespace app\common\model;
use think\Model;

class Detail extends Model
{
	/**
	* 获取上课课程缓存对象
	*/
	public function klassCourse() {
		return $this->belongsto('klassCourse');
	}
}