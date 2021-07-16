<?php
namespace app\common\model;
use think\Model;

class Teacher extends Model
{	//一对多关联
	public	function courses()
	{
		return $this->hasMany('Course')->field('id,name');
	}
	


       

}