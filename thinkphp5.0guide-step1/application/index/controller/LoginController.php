<?php
namespace app\index\controller;
use think\Controller;
use think\Request; 
use app\common\model\Teacher;
use app\common\model\Student;
use app\common\model\Admin;
use app\common\model\Seat;
use app\common\model\SeatRoom;
use app\common\model\Room;
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

        if (!is_null($number)) {
            $students = Student::where('number', '=', $number)->select();
            $Student = $students[0];
            if (!is_null($Student)) {
                if($Student->password === $password) {
                    $id = $Student->id;
                    session('id', $id);
                    $seatRoom = SeatRoom::get($seatId);
                    $seatRoom = new seatRoom();
                    $seatRoom -> is_seated = 1;
                    $seatRoom -> student_id = $id;
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
        //获取传来的roomid
        $id = Request::instance()->param('roomId');

        if (is_null($id)) {
            return $this->error('教室信息传递失败,请重新扫码', '');
        }
        $Room = Room::get($id);

        if ($Room->is_occupy) {
            return $this->error('此教室已被占用，如需占用可重新扫码', url(''));
        }

        $teacherId = session('teacherId');
        $Teacher = Teacher::get($teacherId);
        // 如果session还没有过期的情况下，直接登陆
        if (!is_null($Teacher) && !is_null($teacherId)) {
            $Teacher -> room_id = $id;
            $Room -> is_occupy = 1;
            $Teacher -> save();
            $Room -> save();
        
            if (!$Teacher->save()) {
                return $this->error( '教师-教室信息绑定失败,请重新扫码', '' );
            }else{
                return $this->success('操作成功', url('teacher/index?id=' . $teacherId . '&name=' . $Teacher->name));
            }
        }else{   
            //传到V层
            $this->assign('roomId', $id);

            // V层渲染
            return $this->fetch();  
        }
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

        $Room = Room::get($roomId);
        if(!is_null($number)) {
            $teachers = Teacher::where('number', '=', $number)->select();
            $Teacher = $teachers[0];
            if (!is_null($Teacher)) {
                if ($Teacher->password === $password) {
                    $teacherId = $Teacher->id;
                    session('teacherId', $teacherId);
                    $Room->is_occupy = 1;
                    return $this->success('操作成功',url('teacher/index?=' . $number . '&password=' . $password . '&roomId=' . $roomId));
                }else {
                    return $this->error( '密码或工号错误，请重新输入', url('index/login/teacherIndex?roomId=' . $roomId));
                }
            }else {
                return $this->error( '无此教师，请重新输入', url('index/login/teacherIndex?roomId=' . $roomId));

            }
        } else {
            return $this->error( '请输入完整的信息', url('index/login/teacherIndex?roomId=' . $roomId));
        }

    }
}