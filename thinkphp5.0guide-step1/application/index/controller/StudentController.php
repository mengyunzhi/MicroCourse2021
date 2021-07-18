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
    public function getgrade($course_id,$student_id){
        $course = course::$course_id;

    }
	public function index()
	{
		
		 $name = Request::instance()->get('name');
            echo $name;
            $id = session('id');
            $pageSize = 5; // 每页显示5条数据
            $Student=Student::get($id);
            $this->assign('student',$Student);

            // 实例化Teacher
            $Teacher = new Course; 
            $klassid=$Student->getklass()->id;
            $courseid=$this->getCourse($klassid);
            $course=array();
            $number=count($courseid);
            for ($i=0; $i < $number; $i++) { 
            $course[$i]=Course::get($courseid[$i]);
        }

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
            if(!empty($name)){
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