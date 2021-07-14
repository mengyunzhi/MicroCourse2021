<?php
namespace app\index\controller;
use think\Controller;
use app\common\model\Student;
use think\Request;
class StudentCenterController extends Controller/*学生端个人中心*/
{
    public function center()
    {
        return $this->fetch();
    }//查看个人中心界面
    public function edit() {
        $oldPassword = input('post.oldPassword');
        $password = input('post.password');
        $teacherId = session('teacherId');
        $Teacher = Teacher::get($teacherId);
        if(is_null($Teacher)){
            $Teacher = Student::get($studentId);
            if(is_null($Teacher)){
                $Teacher = Admin::get($adminId);
            }
        }
        if(is_null($Teacher)) {
            return $this->error('未获取到任何成员', $Request->header('referer'));
        }
        $newPasswordAgain = input('post.newPasswordAgain');


        //判断旧密码是否正确
        $encryptOldPassword = $Teacher->encryptPassword($oldPassword);
        if($encryptOldPassword != $Teacher->password) {
           return $this->error('旧密码错误', url('passwordModification'));
        }

        //判断新旧密码是否一致
        if($oldPassword === $password) {
           return $this->error('新旧密码一致', url('passwordModification'));
        }

        //判断新密码是否符合要求必须由字母
        if (!preg_match('/[a-zA-Z]/', $password)) {
            return $this->error('新密码必须包含字母', url('passwordModification'));
        }

        //判断两次新密码是否一致
         if($newPasswordAgain != $password) {
           return $this->error('两次输入的新密码不一致', url('passwordModification'));
        }

        // 判断新密码位数是否符合标准c
        if(strlen($password) < 6 || strlen($password)>25) {
            return $this->error('密码长度应为6到25之间', url('passwordModification'));
        }

        $Teacher->password = $Teacher->encryptPassword($password);
        if(!$Teacher->validate()->save()) {
            return $this->error('密码更新失败', url('passwordModification'));
        }
        $username = $Teacher->username;

        // 密码修改成功后消除当前session，跳转到登陆界面
        session('teacherId', null);
        return $this->success('密码修改成功,请重新登录', url('LogIn/index?username=', $username));
    }//修改密码
}