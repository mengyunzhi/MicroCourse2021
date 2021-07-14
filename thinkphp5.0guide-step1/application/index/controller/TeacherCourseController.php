<?php
namespace app\index\controller;
use think\Controller;

//教师端成绩管理
class TeacherCourseController extends Controller
{
	public function index()
	{
		return $this->fetch();
	}
	public function add()
	{
		return $this->fetch();
	} 
	public function edit()
	{
		return $this->fetch();
	}
	public function score()
	{
		return $this->fetch();
	}
	public function delete()
	{
		return 'delete';
	}
}