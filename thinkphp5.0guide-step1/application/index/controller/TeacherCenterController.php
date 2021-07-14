<?php
namespace app\index\controller;
use think\Controller;

class TeacherCenterController extends Controller/*教师端个人中心*/
{
    public function center()
    {
        return $this->fetch();
    }//查看个人中心界面
}