<?php
namespace app\index\controller;
use think\Controller;

class AdminCenterController extends Controller
{
	public function center()
	{
		return $this->fetch();
	}
}