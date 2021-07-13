<?php
namespace app\index\controller;
use think\Controller;

class AdminStudentController extends Controller
{
	public function index()
	{
		return $this->fetch();
	}
}