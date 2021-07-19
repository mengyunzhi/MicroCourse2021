<?php
namespace app\common\model;
use think\Model;

class Teacher extends Model

{
	static public function logOut()
    {
        // 销毁session中数据
        session('id', null);
        return true;
    }
     static public function isLogin()
    {
        $teacherId = session('id');
        $tag=session('tag'); 
        // isset()和is_null()是一对反义词
        if (isset($teacherId)&&$tag==1) {
            return true;
        } else {
            return false;
        }
    }
	//一对多关联
	public	function courses()
	{
		return $this->hasMany('Course')->field('id,name');
	}
	


       


}