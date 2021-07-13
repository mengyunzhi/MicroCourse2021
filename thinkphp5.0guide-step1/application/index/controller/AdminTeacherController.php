<?php
namespace app\index\controller;
use think\Controller;

class AdminTeacherController extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    public function edit()
    {
    	$htmls = $this->fetch();
    	return $htmls;
    }

    public function add()
    {
    	$htmls = $this->fetch();
    	return $htmls;
    }
}