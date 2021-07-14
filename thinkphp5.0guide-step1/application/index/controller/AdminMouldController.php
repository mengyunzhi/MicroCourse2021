<?php
namespace app\index\controller;
use think\Controller;

class AdminMouldController extends Controller
{
	public function index()
	{
		return $this->fetch();
	}
}