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
     * 学生登陆首页
     */
    public function studentWx() {
        // 获取从wxLogin传出的seatId
        $seatId = Request::instance()->param('seatId');
        if (is_null($seatId)) {
            return $this->error('座位信息传递失败,请重新扫码', '');
        }
        // 首先判断当前学生是否session未过期,如果未过期，直接重定向到登录判定界面
        $studentId = session('studentId');
        if (!is_null($studentId) && !is_null($Student = Student::get($studentId))) {
            $url = url('index/login/wxLogin?seatId=' . $seatId);
            header("Location: $url");
            exit();
        }

        // 接收上次登陆失败返回的信息
        $username = Request::instance()->param('username');
        $password = '';

        // 将$seatId传入V层
        $this->assign('password', $password);
        $this->assign('username', $username);
        $this->assign('seatId', $seatId);
        // 直接到V层渲染
        return $this->fetch();
    }

    /**
     * 多条相同学号学生登录
     */
    public function studentAgain()
    {
        // 获取从wxLogin传出的seatId
        $seatId = Request::instance()->param('seatId');
        if (is_null($seatId)) {
            return $this->error(
                '座位信息传递失败,请重新扫码',
                Request::instance()->header('referer')
            );
        }
        // 首先判断当前学生是否session未过期,如果未过期，直接重定向到登录判定界面
        $studentId = session('studentId');
        if (!is_null($studentId) && !is_null($Student = Student::get($studentId))) {
            $url = url('index/login/wxLogin?seatId=' . $seatId);
            header("Location: $url");
            exit();
        }

        // 获取当前所在的控制器
        $action = 'studentAgain';

        // 接收上次登陆失败返回的信息
        $username = Request::instance()->param('username');
        $name = Request::instance()->param('name');
        $password = '';

        // 将$seatId传入V层
        $this->assign('password', $password);
        $this->assign('username', $username);
        $this->assign('name', $name);
        $this->assign('action', $action);
        $this->assign('seatId', $seatId);
        // 直接到V层渲染
        return $this->fetch();
    }
    
    /**
     * 学生登陆
     */
    public function wxLogin() {
        // 接收post信息,并获取学生id
        $username = Request::instance()->post('username');
        $password = Request::instance()->post('password');
        $seatId = Request::instance()->param('seatId/d');
        $name = Request::instance()->param('name');
        $action = Request::instance()->param('action');

        // 获取学生id，判断session是否过期
        $studentId = session('studentId');
        $Student = Student::get($studentId);
        /*dump($studentId);
        dump($Student);
        die();
        */
        // 首先判断是不是没登录或登录信息过期且存在多个相同学号情况
        if (is_null($Student) || is_null($studentId)) {
            // 首先根据学号判断是否有多个为当前学号的
            $students = Student::where('username', '=', $username)->select();
            if (sizeof($students) > 1 && is_null($action)) {
                return $this->success(
                    '检测到其他学号相同注册信息，请填写完整信息',
                    url('studentagain?username=' . $username . '&seatId=' . $seatId)
                );
            }
            if (sizeof($students) > 1) {
                // 如果是从studentAgain跳过来的直接登录
                if ($action === 'studentAgain') {
                    // 此种情况需要通过name和用户名和密码共同判断学生信息
                    if (Student::login($username, $password, $name)) {
                        // 登录成功，直接跳转到签到页面
                        $studentId = session('studentId');
                        return $this->success(
                            '登陆成功',
                            url('Seat/sign?studentId=' . $studentId . '&seatId=' . $seatId)
                        );
                    }
                } else {
                    return $this->error(
                        '登录信息不正确',
                        url('studentagain?username=' . $username . '&seatId=' . $seatId . '&name=' . $name)
                    );
                }
            }
        }

        // 第2种session已经过期，输入用户名密码登陆
        if (is_null($Student) || is_null($studentId)) {
            if (empty($username) || empty($password)) {
                return $this->error(
                    '请先输入完整的登陆信息',
                    url('studentwx?username=' . $username . '&password=' . $password . '&seatId=' . $seatId)
                );
            } else {
                if (Student::login($username, $password)) {
                    // 登陆成功
                    $Student = Student::get($studentId = session('studentId'));
                    // 首先判断座位id是否接收成功,如果没成功即为修改密码情况
                    if (empty($seatId) || $seatId === 0) {
                        return $this->error(
                            '座位信息不存在，请重新扫码',
                            url('studentwx?username=' . $username . '&password=' . $password)
                        );
                    }
                    return $this->success(
                        '登陆成功',
                        url('Seat/sign?studentId=' . $Student->id . '&seatId=' . $seatId)
                    );
                } else {
                    if ($action !== 'studentAgain') {
                        return $this->error(
                            '用户名或密码不正确',
                            url('studentwx?username=' . $username . '&password=' . $password . '&seatId=' . $seatId)
                        );
                    } else {
                        return $this->error(
                            '用户名或密码不正确',
                            url('studentAgain?username=' . $username . '&name=' . $name . '&seatId=' . $seatId)
                        );
                    }
                }
            }

            // 第二种session未过期，直接登陆
        } else {
         // 首先判断座位id是否接收成功,如果没成功即为修改密码情况
            if (empty($seatId) || $seatId === 0) {
                return $this->error(
                    '座位信息不存在，请重新扫码',
                    url('studentwx?username=' . $username . '&password=' . $password)
                );
            }
            return $this->success(
                '登陆成功',
                url('Seat/sign?studentId=' . $Student->id . '&seatId=' . $seatId)
            );
        }
    }

    
    /**
     * 老师微信端登陆
     */
    public function teacherIndex() {
        // 首先获取教师id，判断session是否过期
        $teacherId = session('teacherId');

        $classroomId = Request::instance()->param('classroomId');
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
        $username = Request::instance()->param('username');
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
        $username = Request::instance()->param('username');
        $classroomId = Request::instance()->param('classroomId');

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

    /**
     * 微信端教师登出
     */
    public function wxLogOut() {
        if (Teacher::logOut()) {
            return $this->success('注销成功', url('teacherIndex'));
        } else {
            return $this->error('注销失败', Request::instance()->header('referer'));
        }
    }
}
