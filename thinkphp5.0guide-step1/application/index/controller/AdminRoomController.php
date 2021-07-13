<?php
namespace app\index\controller;
use think\Controller;

class AdminRoomController extends Controller
{
	public function index()
	{
		return $this->fetch();
	}
}