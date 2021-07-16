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
}