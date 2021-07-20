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
use app\common\model\Detail;
use app\common\model\CourseStudent;
class StudentController extends Index2Controller
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
            $scoreids=array();
            
            $scores=array();
                        for($i=0,$j=0;$i<$number;$i++){
                for($k=0;$k<$numberk;$k++){
                if($course[$k]->id==$teachers[$i]->id&&$course[$k]->name==$teachers[$i]->name){
                    $j++;
                }
                }
            }

            for(;$j<$number;$j++){
            unset($teachers[$j]);
        }
            if(!empty($name)&&$j!=0){
            $this->assign('course', $teachers);
        }
        if($j==0){
            $teachers=null;
            $this->assign('course',$teachers);
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
        $name = Request::instance()->get('name');
        $id = Request::instance()->get('id');
        $Teacher = new Course; 
        $teachers = Course::get($id);
        
        // 向V层传数据
        $this->assign('teachers', $teachers);
		return $this->fetch();
	}

    /**
     * 负责学生端登陆后的显示
     */
    public function afterSign() {
        // 获取学生id，并将学生对象实例化
        $studentId = session('id');
        $courseId = request()->param('courseId');
        if (!is_null($courseId)) {
            $Course = Course::get($courseId);
        } else {
            $Course = '';
        }

        $Student = Student::get($studentId);
        if (is_null($Student) || is_null($studentId)) {
            return $this->error('学生信息不存在,请重新登陆', Request::instance()->header('referer'));
        }

        // 获取成绩信息
        $Scores = Score::where('student_id', '=', $studentId)->select();
        // 定义课程数组,并将中间表对应的课程存入该数组
        $courses = array();
        foreach ($Scores as $Score) {
            // 获取对应的课程
            if (!is_null($Score->course)) {
                $courses[] = $Score->course;
            }
        }

        // 将签到过的课程也放入
        $Details = Detail::where('student_id', '=', $studentId)->select();
        foreach ($Details as $Detail) {
            $flag = 0;
            foreach ($courses as $Course) {
                if ($Course->id === $Detail->klassCourse->course_id) {
                    $flag = 1;
                }
            }
            // 如果flag还为0,说明之前的数组中没有该课程
            if ($flag === 0 && !is_null($Detail->klassCourse->course)) {
                $courses[] = $Detail->klassCourse->course;
            }
        }

        // 通过中间表和学生id，获取该学生所上的课程
        $que = array(
            'student_id' => $studentId,
        );
        $Details = Detail::order('update_time desc')->where($que)->paginate();


        // 将数据传入V层进行渲染
        $this->assign('Details', $Details);
        $this->assign('Student', $Student);
        $this->assign('Course', $Course);
        $this->assign('courses', $courses);
        return $this->fetch();
    }
}