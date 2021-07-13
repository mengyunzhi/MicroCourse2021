<?php
namespace app\index\controller;
use think\Request;  
use think\Controller;

class AdminTermController extends Controller
{
    public function index()
    {
    return $this->fetch();

    }
}