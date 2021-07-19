<?php
namespace app\common\model;
use think\Model;

class Admin extends Model
{   
	
   
   static public function isLogin()
    {
        $teacherId = session('id');
        $tag=session('tag'); 
        // isset()和is_null()是一对反义词
        if (isset($teacherId)&&$tag==3) {
            return true;
        } else {
            return false;
        }
    }

}