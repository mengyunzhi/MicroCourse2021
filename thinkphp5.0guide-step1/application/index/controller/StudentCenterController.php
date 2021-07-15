<?php
namespace app\index\controller;
use think\Controller;

class StudentCenterController extends Controller/*学生端个人中心*/
{
    public function center()
    {
        return $this->fetch();
    }//查看个人中心界面
}