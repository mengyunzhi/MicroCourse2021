<?php
namespace app\index\controller;
use think\Controller;

class AdminCenterController extends Controller/*管理员端个人中心*/
{
    public function center()
    {
        return $this->fetch();
    }//查看个人中心界面
    public function changecode(){
        
    }
}