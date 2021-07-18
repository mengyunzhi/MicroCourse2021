<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use app\common\model\Course;
use app\common\model\Klass;
use app\common\model\Room;
use app\common\model\Teacher;
use app\common\model\Student;
use app\common\model\KlassCourse;

class TeacherController extends IndexController
{	
	public function index()
	{	
		$teacher_id=Request::instance()->param('id');
		//实例化对象
		$Course=new Course;
		$Klass=new Klass;
		//向v层传值
		$this->assign([
			'Course'=>$Course,
			'Klass'=>$Klass,
			'teacher_id'=>$teacher_id
		]);
		//返回
		return $this->fetch();

	}
	public function onclass()
	{
		//接收数据
		$postDate=Request::instance()->post();
		//实例化对象
		$Teacher=Teacher::get($postDate['teacher_id']);
		$Course=Course::get($postDate['course_id']);
		$Room=new Room;
		$rooms=$Room->select();
		//应到人数
		//获取班级信息并计算人数
		$studentNumber=0;
		$Klasses=$Course->Klasses()->select();
		$count=count($Klasses);
		for ($i=0; $i <$count ; $i++) { 
			$Klass=new Klass;
			$Klass=$Klasses[$i];
			if (true===$Course->getIsChecked($Klass)) {
				$studentNumber=$studentNumber+$Klass->student_number;
			}

		}
		//随机点名
		$studentName=$this->getStudent($postDate['course_id']);
		//向v层传数据
		$this->assign([
			'postDate'=>$postDate,
			'Course'=>$Course,
			'studentNumber'=>$studentNumber,
			'rooms'=>$rooms,
			'time'=>$postDate['time'],
			'studentName'=>$studentName,
			'teacherName'=>$Teacher->name,
			'teacher_id'=>$postDate['teacher_id']
		]);
		return $this->fetch();
	}
	//获取学生
	public function getStudent($course_id)
    {
        //获取班级
        $Course=Course::get($course_id);
        $klasses=$Course->Klasses()->select();
        $KlassCourse=new KlassCourse;
        $klassCourses=$KlassCourse->select();
        $number=count($klassCourses);
        $klassIds=array();
        for ($j=0 ,$i=0; $i < $number; $i++) { 
            if($klassCourses[$i]->course_id==$course_id){
                $klassIds[$j]=$klassCourses[$i]->klass_id;
                $j++;
            }
        }
        //获取学生
        $Student=new Student;
        $students=$Student->select();
        $studentIds=array();
        $klassNumber=count($klassIds);
        //随机生成班级
        $klassId=(int)$this->dc_rand1(0,$klassNumber,2)[0];
        //获取学生
        for ($j=0,$i=0; $i <count($students); $i++) { 
            if($students[$i]->klass_id==$klassIds[$klassId]){
                $studentIds[$j]=$students[$i]->id;
                $j++;
            }

        }
        //随机选择学生
        $studentNumber=count($studentIds);
        if ($studentNumber===0) {
        	$studentName='';
        }else{
        	$studentId=(int)$this->dc_rand1(0,$studentNumber,5)[3];
        	$Student=Student::get($studentIds[$studentId]);
        	$studentName=$Student->name;
        }
        return $studentName;
             
    }
	//获得随机数
	public function dc_rand1($min, $max, $num)
	{
        $count = 0;
        $return = array();
        while ($count < $num) {
            $return[] = mt_rand($min*100, $max*100)/100;
            $count = count($return);
        }
//        //打乱数组，重新赋予数组新的下标
//        shuffle($return);
        return $return;//返回的是一维数组
    }
	
}