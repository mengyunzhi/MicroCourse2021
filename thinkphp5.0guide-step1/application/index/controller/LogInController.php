<?php
namespace app\index\controller;
use think\Controller;
use think\Request; 
use app\common\model\Teacher;
use app\common\model\Student;
use app\common\model\Admin;
class LoginController extends Controller
{
    public function index()
    {
        
        return $this->fetch();
    }

    // 处理用户提交的登录数据
    public function login()
    {
        // 接收post信息
        $postData = Request::instance()->post();

        // 验证用户名是否存在
        $map = array('username'  => $postData['username']);
        $User = Teacher::get($map);
        $tag=1;
        if(is_null($User)){
            $User = Student::get($map);
            $tag=2;
            if(is_null($User)){
                $User = Admin::get($map);
                $tag=3;
            }
        }
        // $User要么是一个对象，要么是null。
        if (!is_null($User) && $User->getData('password') === $postData['password']) {
            // 用户名密码正确，将userId存session，并跳转至用户界面
            session('userId', $User->getData('id'));
            if($tag===1){
                        return $this->success('登录成功', url('teacher/index'));
                    }
            if($tag===2){
                        return $this->success('登录成功', url('student/index'));
                    }
            if($tag===3)
                    return $this->success('登录成功', url('admin/index'));
        } else {
            // 用户名不存在，跳转到登录界面。
            return $this->error('用户名或密码错误', url('index'));
        }
    }
//$tag===1教师，$tag===学生,$tag===3管理员
// 验证用户名是否存在
// 验证密码是否正确
// 用户名密码正确 ，将teacherId 存session
// 用户名密码错误，跳转到登录界面 
}