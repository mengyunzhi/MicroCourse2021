<?php
namespace app\index\controller;
use think\Controller;

class LogInController extends Controller
{
	public function index()
	{
		return $this->fetch();
	}
}