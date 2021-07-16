<?php
namespace app\index\controller;
use think\Controller;
use think\Request; 
use think\Db;
use app\common\model\Teacher;
use app\common\model\Student;
use app\common\model\Admin;
class TeacherCenterController extends IndexController/*教师端个人中心*/
{
    public function center()
    {   
        
        $id = session('id');
        $Teacher = new Teacher; 
        $teachers = Teacher::get($id);
        // 向V层传数据
        $this->assign('teachers', $teachers);
        // 取回打包后的数据
        $htmls = $this->fetch();
        
        return $htmls;
    }//查看个人中心界面
    public function update(){
        // 获取传入ID
        $id = Request::instance()->param('id/d');

        // 在Teacher表模型中获取当前记录
        $Teacher = Teacher::get($id);
        // 将数据传给V层
        $this->assign('Teacher', $Teacher);

        // 获取封装好的V层内容
        $htmls = $this->fetch();

        // 将封装好的V层内容返回给用户
        return $htmls;
    }
    public function edit()  {
        $teacherid = input('post.id');
        $oldPassword = input('post.oldPassword');
        $password = input('post.password');
        $Teacher = Teacher::get($teacherid);
        if(is_null($Teacher)) {
            return $this->error('未获取到任何用户');
        }
        $newPasswordAgain = input('post.newPasswordAgain');


        //判断旧密码是否正确
        
        if($oldPassword != $Teacher->password) {
           return $this->error('旧密码错误', url('update'));
        }

        //判断新旧密码是否一致
        if($oldPassword === $password) {
           return $this->error('新旧密码一致', url('update'));
        }

        //判断新密码是否符合要求必须由字母
        if (!preg_match('/[a-zA-Z]/', $password)) {
            return $this->error('新密码必须包含字母', url('update'));
        }

        //判断两次新密码是否一致
         if($newPasswordAgain != $password) {
           return $this->error('两次输入的新密码不一致', url('update'));
        }

        // 判断新密码位数是否符合标准c
        if(strlen($password) < 6 || strlen($password)>25) {
            return $this->error('密码长度应为6到25之间', url('update'));
        }
        // var_dump(Teacher)
        $Teacher->password=$password;
        if(!$Teacher->save()) {
            return $this->error('密码更新失败', url('update'));
        }
         return $this->success('修改成功，请重新登录', url('login/'));
    }//修改密码
    public function updateemail(){
       // 获取传入ID
        $id = Request::instance()->param('id/d');

        // 在Teacher表模型中获取当前记录
        $Teacher = Teacher::get($id);
        // 将数据传给V层
        $this->assign('Teacher', $Teacher);

        // 获取封装好的V层内容
        $htmls = $this->fetch();

        // 将封装好的V层内容返回给用户
        return $htmls;
    }
    public function editemail(){
        $teacherid = input('post.id');
        $email=input('post.email');
        $Teacher = Teacher::get($teacherid);
        $Teacher->email=$email;
        if(!$Teacher->save()){
            return $this->error('邮箱更新失败', url('updateemail'));
        }
        return $this->success('修改成功', url('teacher_center/center'));
    }
}