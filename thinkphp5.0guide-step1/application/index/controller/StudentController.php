<?php
namespace app\index\controller;
use think\Controller;
use think\Request; 
use think\Db;
use app\common\model\Teacher;
use app\common\model\Student;
use app\common\model\Admin;
use app\common\model\Klass;
use app\common\model\Course;
use app\common\model\KlassCourse;
use app\common\model\Score;
class StudentController extends IndexController
{
    public function getCourse($klass_id)
    {
        //获取班级
        $Klass=Klass::get($klass_id);
        $courses=$Klass->courses()->select();
        $KlassCourse=new KlassCourse;
        $klassCourses=$KlassCourse->select();
        $number=count($klassCourses);
        $courseIds=array();
        
        for ($j=0 ,$i=0; $i < $number; $i++) { 
            if($klassCourses[$i]->klass_id==$klass_id){
                $courseIds[$j]=$klassCourses[$i]->course_id;
                $j++;
            }
        }
        $i=0;
        
        //获取学生
       return $courseIds;
    }
    public function getscore($course_id,$student_id){
        $scoreids=array();
        $course=Course::get($course_id);
        $student=Student::get($student_id);
        $score=new score;
        $scores=$score->select();
        $number=count($scores);;
        for($j=0,$i=0;$i<$number;$i++){
            if($course_id==$scores[$i]->course_id&&$student_id==$scores[$i]->student_id);{
                $scoreid=$scores[$i]->id;
            }
        }
        $score=Score::get($scoreid);
        return $score;
    }
	public function index()
	{
		
		 $name = Request::instance()->get('name');
            
            $id = session('id');
            $pageSize = 5; // 每页显示5条数据
            $Student=Student::get($id);
            $this->assign('student',$Student);

            // 实例化Teacher
            $Teacher = new Course; 
            $klassid=$Student->getklass()->id;
            $courseid=$this->getCourse($klassid);
            $course=array();
            $scoreids=array();
            $score=array();
            $number=count($courseid);
            for ($i=0; $i < $number; $i++) { 
            $course[$i]=Course::get($courseid[$i]);
            }
            for($i=0;$i<$number;$i++){
                $scoreids[$i]=$this->getscore($courseid[$i],$id);
                
            }
            
            $this->assign('score',$score);
            $this->assign('course',$course);
            $this->assign('courseid',$courseid);
            // 定制查询信息
            if (!empty($name)) {
                $Teacher->where('name', 'like', '%' . $name . '%');
            }
            
            // 按条件查询数据并调用分页
            $teachers = $Teacher->paginate($pageSize, false, [
                'query'=>[
                    'name' => $name,
                    ],
                ]);

            // 向V层传数据
            $number=count($teachers);
            $numberk=count($course);
            for($i=0,$j=0;$i<$number;$i++){
                for($k=0;$k<$numberk;$k++){
                if($course[$k]->name==$teachers[$i]->name){
                    $j=1;
                }
                }
            }
            if(!empty($name)&&$j==1){
            $this->assign('course', $teachers);
        }
            // 取回打包后的数据
            $htmls = $this->fetch();

            // 将数据返回给用户
            return $htmls;
	}
	public function onclass()
	{
		return $this->fetch();
	}
	
	public function check()
	{	
		$id = session('id');
        $Teacher = new Student; 
        $teachers = Student::get($id);

        // 向V层传数据
        $this->assign('teachers', $teachers);
		return $this->fetch();
	}

}