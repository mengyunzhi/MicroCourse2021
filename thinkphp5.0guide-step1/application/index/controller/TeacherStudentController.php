<?php
namespace app\index\controller;
use think\Controller;
use app\common\model\Student;
use think\Request;

class TeacherStudentController extends controller
{
	public function index()
	{
		$Student =new Student;
		$students=$Student->select();
		$this->assign('students',$students);
		return $this->fetch();
	}
}
