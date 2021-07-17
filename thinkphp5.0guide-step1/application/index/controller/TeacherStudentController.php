<?php
namespace app\index\controller;
use think\Controller;
use app\common\model\Student;
use think\Request;
use app\common\model\Klass;
use app\common\model\KlassCourse;
use app\common\model\Score;

class TeacherStudentController extends controller
{
	public function index()
    {
        try {
            // 获取查询信息
            $name = Request::instance()->post('name');

            $pageSize = 5; // 每页显示5条数据

            // 实例化Teacher
            $Student = new Student; 

            // 定制查询信息
            if (!empty($name)) {
                $Student->where('name', 'like', '%' . $name . '%');
            }

            // 按条件查询数据并调用分页
            $students = $Student->paginate($pageSize, false, [
                'query'=>[
                    'name' => $name,
                    ],
                ]);

            // 向V层传数据
            $this->assign('students', $students);
            // 取回打包后的数据
            $htmls = $this->fetch();

            // 将数据返回给用户
            return $htmls;

        // 获取到ThinkPHP的内置异常时，直接向上抛出，交给ThinkPHP处理
        } catch (\think\Exception\HttpResponseException $e) {
            throw $e;

        // 获取到正常的异常时，输出异常
        } catch (\Exception $e) {
            return $e->getMessage();
        } 
    }
	public function edit()
	{
		$id=Request::instance()->param('id/d');
    	$Student =Student::get($id);
    	$Klass=new Klass;
    	$klasses=$Klass->select();
    	if(is_null($Student)){
    		return $this->error('不存在ID为'.$id.'的记录');
    	}
    	$this->assign([
    		'Student'=>$Student,
    		'klasses'=>$klasses
    	]);
    	return $this->fetch();
	}
	public function delete()
    {
        try {
            // 获取get数据
            $Request = Request::instance();
            $id = Request::instance()->param('id/d');
            
            // 判断是否成功接收
            if (0 === $id) {
                throw new \Exception("未获取到ID信息", 1);
            }

            // 获取要删除的对象
            $Student = Student::get($id);

            // 要删除的对象存在
            if (is_null($Student)) {
                throw new \Exception('不存在id为' . $id . '的教师，删除失败', 1);
            }

            // 删除对象
            if (!$Student->delete()) {
                $message = '删除失败:' . $Student->getError();
            }else{
                //删除
                $student_id=$id;
                $Score=new Score;
                $scores=$Score->select();
                $number=count($scores);
                for ($i=0 ; $i < $number; $i++) { 
                    if($scores[$i]->student_id==$student_id){
                        $scores[$i]->delete();
                }
            }
            }

            // 进行跳转
            return $this->success('删除成功', $Request->header('referer')); 
        }catch(\think\Exception\HttpResponseException $e){
            throw $e;
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return $this->error($message);
    }
	public function add()
    {
        try {
            $Klass=new Klass;
            $klasses=$Klass->select();
            $this->assign('klasses',$klasses);
            return $this->fetch();
        
        } catch (\Exception $e) {
            return '系统错误' . $e->getMessage();
        }
    }
	public function update()
    {   
        $message='';
        try{
            $id=Request::instance()->post('id/d');
            //获取当前对象
            $Student=Student::get($id);
            if(!is_null($Student)){
                $Student->name=input('post.name');
                $Student->number=input('post.number');
                $Student->klass_id=input('post.klass_id');
                $Student->email=input('post.email');
                    if(false===$Student->validate(true)->save()){
                        return $this->error('更新失败' . $Student->getError());
                    }
            }else{
                throw new \Exception("所更新的记录不存在", 1);
                
            }
        }catch(\think\Exception\HttpResponseException $e){
            throw $e;
        }catch(\Exception $e){
            return $e->getMessage();
        }
        return $this->success('操作成功',url('index'));
    }
    public function save()
    {
        // 实例化
        $Student = new Student;
        // 新增数据
        if (!$this->saveStudent($Student)) {
            return $this->error('操作失败' . $Student->getError());
        }else{
        	$klass_id=Request::instance()->post('klass_id');
	        $KlassCourse=new KlassCourse;
	        $klassCourses=$KlassCourse->select();
	        $number=count($klassCourses);
	        $klassIds=array();
	        for ($i=0 ; $i < $number; $i++) { 
	            if($klassCourses[$i]->klass_id==$klass_id){
	            	$Score= new Score;
	            	$id=$Student->id;
	            	$Score->course_id=$klassCourses[$i]->course_id;
	            	$Score->student_id=$id;
	            	$Score->usual_score=0;
	            	$Score->exam_score=0;
	            	$Score->sum_score=0;
	            	$this->saveScore($Score);
	            }
	        }
        }
        // 成功跳转至index触发器
        return $this->success('操作成功', url('index'));

    }
    private function saveStudent(Student &$Student, $isUpdate = false) 
    {
        // 写入要更新的数据
        $Student->name = Request::instance()->post('name');
        $Student->number = Request::instance()->post('number');
        $Student->email = Request::instance()->post('email');
        $Student->klass_id=Request::instance()->post('klass_id');
        return $Student->validate(true)->save();
    }
    	public function saveScore(Score $Score)
    {
    	$newScore=new Score;
        $newScore->student_id = $Score->student_id;
        $newScore->course_id = $Score->course_id;
        $newScore->usual_score = $Score->usual_score;
        $newScore->exam_score=$Score->exam_score;
        $newScore->sum_score=$newScore->usual_score+$newScore->exam_score;
        $newScore->save();
    }
}
