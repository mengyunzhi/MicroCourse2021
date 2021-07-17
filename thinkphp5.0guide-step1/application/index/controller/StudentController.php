<?php
namespace app\index\controller;
use think\Controller;
use think\Request; 
use think\Db;
use app\common\model\Teacher;
use app\common\model\Student;
use app\common\model\Admin;
class StudentController extends IndexController
{
	public function index()
	{
		
		return $this->fetch();
	}
	public function onclass()
	{
		return $this->fetch();
	}
	
	public function myclass()
	{
		return $this->fetch();
	}

}