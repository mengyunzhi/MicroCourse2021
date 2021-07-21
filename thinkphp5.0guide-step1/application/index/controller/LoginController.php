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
        $map = array('number'  => $postData['username']);
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
                        session('tag',1);
                        session('id', $User->getData('id'));
                        return $this->success('登录成功', url('teacher/index?id='.$User->getData('id')));
                    }
            if($tag===2){
                        session('tag',2);
                        session('id', $User->getData('id'));
                        return $this->success('登录成功', url('student/index'));
                    }
            if($tag===3)
                    session('id', $User->getData('id'));
                    session('tag',3);
                    return $this->success('登录成功', url('admin_term/index'));
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
    public function logout(){
        if(Teacher::logout()){
            return $this->success('注销成功',url('login/index'));
        }
        else{
            return $this->error('注销失败',url(''));
        }
    }

    /**
     * studentId seatId 
     */

    /**
     * 学生登陆首页
     */
    public function studentWx() {

        $seatId = Request::instance()->param('seatId/d');

        if (is_null($seatId)) {
            return $this->error('座位信息传递失败,请重新扫码', '');
        }
        $seatRoom = SeatRoom::get($seatId);


        if ($seatRoom->is_seated) {
        return $this->error('此座位已被占用，如需占用可重新扫码', url(''));

        }
        // 首先判断当前学生是否session未过期,如果未过期，直接重定向到登录判定界面

        $studentId = session('id');
        $Student = Student::get($studentId);
        if (!is_null($studentId) && !is_null($Student)) {
            $seatRoom -> is_seated = 1;
            $seatRoom -> student_id = $studentId;
            $seatRoom -> save();
            return $this->success('操作成功', url('student/index?id=' . $studentId . '&name=' . $Student->name));
        } else {
            // 将$seatId传入V层
            $this->assign('seatId', $seatId);
            // 直接到V层渲染
            return $this->fetch();
        }

    }



    /**
     * 学生登陆
     */
    public function wxLogin() {
        // 接收post信息,并获取学生id

        $number = Request::instance()->post('username');

        $password = Request::instance()->post('password');
        $seatId = Request::instance()->param('seatId/d');
        // 获取学生id，判断session是否过期

        
        if (!is_null($number)) {
            $students = Student::where('number', '=', $number)->select();
            $Student = $students[0];
            if (!is_null($Student)) {
                if($Student->password === $password) {
                    $id = $Student->id;
                    session('id', $id);
                    $seatRoom = SeatRoom::get($seatId);
                    $seatRoom -> is_seated = 1;
                    $seatRoom -> student_id = $studentId;
                    $seatRoom -> save();
                     return $this->success(
                    '操作成功',
                    url('student/index?=' . $number . '&password=' . $password . '&seatId=' . $seatId));
                } else {
                    return $this->error( '密码或学号错误，请重新输入', url('index/login/studentWx?seatId=' . $seatId));
                }
            } else {
                return $this->error( '无此学生，请重新输入', url('index/login/studentWx?seatId=' . $seatId));

            }
        } else {
            return $this->error( '请输入完整的信息', url('index/login/studentWx?seatId=' . $seatId));

        }
    }
               

    /**
     * 老师微信端登陆
     */
    public function teacherIndex() {
        // 首先获取教师id，判断session是否过期

        $roomId = Request::instance()->param('roomId');
        $id = Request::instance()->param('id/d'); 
        $teacherId = session('id');

        $Teacher = Teacher::get($teacherId);
        // 如果session还没有过期的情况下，直接登陆
        if (!is_null($Teacher) && !is_null($teacherId)) {
            // 绑定教师信息和教室信息
            $Teacher->classroom_id = $classroomId;
            if (!$Teacher->save()) {
                return $this->error(
                    '教师-教室信息绑定失败,请重新扫码',
                    ''
                );
            }
            return $this->success('登陆成功', url('teacherwx/index'));
        }

        // 接收用户名和密码,避免二次登陆重新输入账号密码

        $number = Request::instance()->param('username');

        $password = '';

        $this->assign('username', $username);
        $this->assign('classroomId', $classroomId);
        $this->assign('password', $password);

        // 调用index模板
        return $this->fetch();
    }

    /**
     * 老师微信登陆判断
     */
    public function teacherLogin() {
        // session如果已经过期状况
        // 接收用户名和密码
        $password = Request::instance()->param('password');

        $number = Request::instance()->param('username');
        $roomId = Request::instance()->param('roomId');


        // 通过判断用户名密码是否为空来区分登陆和密码不正确重新登陆状况
        if (!empty($username) && !empty($password)) {
            // 直接调用M层方法，进行登录。
            if (Teacher::login($username, $password)) {
                // 如果不是则认定为教师端登陆，跳转到教师端
                // 获取教师id
                $teacherId = session('teacherId');
                $Teacher = Teacher::get($teacherId);
                if (is_null($Teacher) || is_null($teacherId)) {
                    return $this->error('教师信息不存在', url('teacherFirst?classroomId=' . $classroomId));
                } else {
                    // 绑定教师和教室信息
                    $Teacher->classroom_id = $classroomId;
                    if (!$Teacher->save()) {
                        return $this->error(
                            '教室-老师信息绑定失败,请重新扫码',
                            ''
                        );
                    }
                }
                // 登陆成功后也保存成功教室信息
                return $this->success('登陆成功', url('teacherwx/index'));
            } else {
                // 登陆不成功状况
                $id = $classroomId;
                return $this->error(
                    '用户名或密码不正确',
                    url('teacherIndex?username=' . $username . '&password=' . $password . '&classroomId=' . $id)
                );
            }
        } else {
            // 用户名密码输入不完整状况，重新输入
            return $this->error('请输入完整的信息', Request::instance()->header('referer'));
        }
    }


}
