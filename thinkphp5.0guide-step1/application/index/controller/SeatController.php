<?php
namespace app\index\controller;
use app\common\model\Seat;
use app\common\model\SeatRoom;
use think\Controller;
use think\Request;
use think\validate;
use app\common\model\Mould;
use app\common\model\Room;
use app\common\model\Score;
use app\common\model\Detail;
use app\common\model\KlassCourse;
use app\common\model\Student;


/**
 * 座位管理，负责座位的信息更新和信息重置等
 */
class SeatController extends controller {

    /**
     * 设置有无人坐
     */
    public function is_seated() {
        // 获取座位id，并将座位进行实例化
        $Request = Request::instance();
        $seatId = Request::instance()->param('id\d');
        $Seat = SeatRoom::get($seatId);

        // 判断座位是否被坐，并更改状态
        if($Seat->isseated === 1) {
            $Seat->isseated = 0;
        } else { 
            $Seat->isseated = 1;
        }

        // 增加判断是否保存成功
        if (!$Seat->save()) {
            return $this->error('是否被坐状态更改失败', $Request = Request::instance());
        }
    }

    /**
     * 上课签到、将上课座位属性student_id变为其id
     */
    public function sign() {
        // 首先根据微信端的Cookie值判断是否该该学生信息，并获取该学生的id信息 
        $studentId = Request::instance()->param('studentId/d');
        dump($studentId);
        // 获取学生id和教室座位id,并实例化教室座位对象
        $seatId = Request::instance()->param('seatId');
        if (is_null($Seat = SeatRoom::get($seatId)) || is_null($seatId)) {
            return $this->error('座位获取失败，请重新签到扫码', Request::instance()->header('referer'));
        }
        $room = Room::get($Seat->room_id);

        // 判断当前座位是否有学生，并判断第二个扫码的人跟第一个人是否是一个人
        if ($Seat->student_id !== $studentId && $Seat->student_id !==0 && !is_null($Seat->student_id)) {
            return $this->error(
                '当前已被' . $Seat->student->name . '绑定，请选择其他座位重新扫码',
                url('Student/aftersign?studentId' . $studentId . '&courseId=' . $room->course_id)
            );
        }

        // 为新建和更新上课详情做准备(获取上课课程对象)
        $isUpdate = false;
        $detail = Detail::get(['room_id' => $Seat->room_id, 'create_time' => $room->begin_time]);

        // 增加判断是否为已经扫码，更改座位情况
        $SeatFirst = SeatRoom::get(['student_id' => $studentId, 'room_id' => $Seat->room_id]);
        if (!is_null($SeatFirst)) {
            $SeatFirst->student_id = null;
            $SeatFirst->is_seated = 0;
            if (!$SeatFirst->save()) {
                return $this->error('座位信息更新失败', request()->header('referer'));
            }
            // 获取对应的上课详情对象
            $que = array(
                'student_id' => $studentId,
                'klass_course_id' => $klassCourse->id
            );
            // 如果是二次签到更换座位，那么重新建立classDetail对象
            $Detail = Detail::get($que);
            $isUpdate = true;
        }

        // 通过座位id获取教室id，进而判断本教室是否处于上课状态
        if ($room->course_id === 0 || is_null($room->course_id) || $room->out_time < time()) {
            return $this->error('当前教室并未开始上课', url('Student/afterSign?studentId=' . $studentId));
        } else {
            // 判断学生是否在当前课程中
            $Scores = Score::where('course_id', '=', $room->course_id)->select();
            if (sizeof($Scores) !== 0) {
                // 获取此学生和此课程对应的成绩
                $que = array(
                    'student_id' => $studentId,
                    'course_id' => $room->course_id
                );
                dump($que);
                $Score = Score::get($que);
                if (is_null($Score)) {
                    return $this->error('您不在当前上课名单中,请检查上课地点是否正确', url('Student/afterSign?studentId=' . $studentId));
                }

                // 增加判断是否在签到截止时间内
                if ($room->sign_deadline_time >= time() && $isUpdate === false) {
                    // 该成绩签到次数加并重新计算签到成绩和总成绩
                    $Score->resigternum++;
                    $Score->getAllgrade();
                    dump($Score);
                }
            }
        }

        // 创建一条上课数据,首先获取该课程对应的上课缓存信息
        if (!$this->saveDetail($klassCourse, $studentId, $seatId, $Detail, $isUpdate)) {
            return $this->error('签到信息保存失败', url('sign?studentId=' . $studentId . '&seatId=' . $seatId));
        }

        $Seat = Seat::get($seatId);
        // 将教室座位student_id进行赋值
        $Seat->student_id = $studentId;
        $Seat->is_seated = 1;
        // dump($Seat->student_id);die();
        // 将修改后的座位对象保存
        if (!$Seat->save()) {
            return $this->error(
                '座位信息更新失败，请重新扫码',
                url('Student/aftersign?studentId=' . $studentId)
            );
        }
        $courseId = $room->course_id;
        return $this->success(
            '扫码签到成功，开始上课',
            url('Student/afterSign?studentId=' . $studentId . '&seatId=' . $seatId . '&courseId=' . $courseId)
        );
    }

    /**
     * 上课座位学生信息缓存
     * @param KlassCourse 上课课程缓存信息
     * @param studentId 该座位学生id
     * @param seatId 学生所做的座位
     * @param ClassDetail 上课缓存待修改对象
     */
    public function saveDetail($KlassCourse, $studentId, $seatId, &$Detail, $isUpdate = false)
    {
        // 如果不是更新，那么增加上课详情赋值
        if (!$isUpdate) {
            $Detail->class_course_id = $KlassCourse->id;
            $Detail->student_id = $studentId;
            $Detail->aod_num = 0;
        }

        // 上课座位学生信息对象座位和更新时间字段进行修改
        $Detail->seat_id = $seatId;
        $Detail->update_time = time();

        // 将新建的对象进行保存
        return $Detail->save();
    }

    // /**
    //  * 第二个人扫码同一个座位，显示已绑定
    //  * @param studentId 第二个扫码的人的id
    //  * @param Seat 扫码对应的座位对象
    //  */
    // public function checkIsSeated($studentId, $Seat) {
    //     // 实例化座位对象
    //     if ($Seat->student_id !== $studentId && time() < $Seat->Classroom->sign_deadline_time) {
    //         $Student = Student::get($Seat->student_id);
    //     }    
    // }

}