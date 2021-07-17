<?php
namespace app\common\model;
use think\Model;

class Student extends Model
{
	public function getKlass()
    {
        $klassId = $this->getData('klass_id');
        $Klass = Klass::get($klassId);
        return $Klass;
    }

	/**
    * ThinkPHP使用一个叫做__get()的魔法函数来完成这个函数的自动调用
    * 在本章第五节中，我们将专门对__get()进行讲解
    * @author 梦云智 http://www.mengyunzhi.com
    */
     public function Klass()
    {	
    	//$Klass=Klass::get(5);
    	//return $Klass;
        return $this->belongsTo('Klass');

    }
}