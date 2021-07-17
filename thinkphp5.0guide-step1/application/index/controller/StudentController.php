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
class StudentController extends IndexController
{
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

            // 定制查询信息
            if (!empty($name)) {
                $Teacher->where('name', 'like', '%' . $name . '%');
            }

            // 按条件查询数据并调用分页
            $teachers = $Teacher->paginate($pageSize);

            // 向V层传数据
            $this->assign('teachers', $teachers);

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