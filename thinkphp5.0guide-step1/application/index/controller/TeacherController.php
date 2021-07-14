<?php
namespace app\index\controller;
use think\Controller;
class TeacherController extends Controller
{
	public function index()
	{
		return $this->fetch();
	}
	public function onclass()
	{
		return $this->fetch();
	}
	
	public function edit()
	{
		return $this->fetch();
	}
}