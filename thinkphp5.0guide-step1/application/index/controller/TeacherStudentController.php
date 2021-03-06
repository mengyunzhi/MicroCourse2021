<?php
namespace app\index\controller;
use think\Db;
use think\Controller;
use app\common\model\Student;
use think\Request;
use app\common\model\Klass;
use app\common\model\KlassCourse;
use app\common\model\Score;
use app\index\controller\ExcelController;
use app\common\model\Course;

class TeacherStudentController extends IndexController
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
            $this->assign([
                'students'=>$students,
                'Klass'=>new Klass   
            ]);
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
                throw new \Exception('不存在id为' . $id . '的学生，删除失败', 1);
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
                $Klass=Klass::get($Student->klass_id);
                $Klass->student_number=$Klass->student_number-1;
                if(!$Klass->validate(true)->save()){
                    return $this->error('班级信息错误');
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
                $oldKlass=Klass::get($Student->klass_id);
                $Student->name=input('post.name');
                $Student->number=input('post.number');
                $Student->klass_id=input('post.klass_id');
                $Student->email=input('post.email');
                //班级人数变化
                $newKlass=Klass::get($Student->klass_id);
                $oldKlass->student_number=$oldKlass->student_number-1;
                $newKlass->student_number=$newKlass->student_number+1;
                $oldKlass->validate(true)->save();
                $newKlass->validate(true )->save();
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
    /*
    *读取文件数据
    */
    public function getFile()
    {
        try{
            $klass_id=Request::instance()->post('klass_id');
            $userfile=request()->file('userfile');
            if(is_null($userfile)){
                return $this->error('请先选择文件');
            }
            if($userfile){
                $info=$userfile->move('/readfile/www/upload/','');
                }else{
                    // 上传失败获取错误信息
                    echo $file->getError();
                }

            $ExcelController=new ExcelController;
            $data=$ExcelController->readExcel($info->getSavename());
            $TeacherStudentController=new TeacherStudentController;
            if(true==$TeacherStudentController->saveFile($data,$klass_id)){
                return $this->success('操作成功');
            }else{
                throw new \Exception('错误', 1);}
        }catch(\think\Exception\HttpResponseException $e){
            throw $e;
        }catch(\Exception $e){
            return $e->getMessage();
        }
        
    }
    /*
    *保存文件信息
    */
    public function saveFile($fileData,$klass_id)
    {
        $lineNumber=count($fileData);
        $Student=new Student;
        $Course=new Course;
        $Score=new Score;
        $students=$Student->select();
        $courses=$Course->select();
        $scores=$Score->select();
        $studentNumber=count($students);
        $courseNumber=count($courses);
        $scoreNumber=count($scores);
        $teacher_id=session('id');
        for ($i=1; $i<$lineNumber; $i++) { 
            $n=0;
            //遍历分数信息，判断是否有相同的
            for($j=0;$j<$scoreNumber;$j++){
                $student_id=$course_id=-1;
                for($k=0;$k<$studentNumber;$k++){
                    if($students[$k]->number==$fileData[$i][1]){
                        $student_id=$students[$k]->id;
                    }
                }
                for($k=0;$k<$courseNumber;$k++){
                    if($courses[$k]->name==$fileData[$i][2] And $courses[$k]->teacher_id==$teacher_id){
                        $course_id=$courses[$k]->id;
                    }
                }
                //数据库有对应的信息
                if($student_id==$scores[$j]->student_id And $course_id==$scores[$j]->course_id){
                    $scores[$j]->usual_score=$fileData[$i][3];
                    $scores[$j]->exam_score=$fileData[$i][4];
                    $scores[$j]->save();
                    $n=1;
                }
            }
            //没有对应信息
            if($n===0){
                $Score=new Score;
                $a=0;
                $b=0;
                //判断有没有对应学生
                for($k=0;$k<$studentNumber;$k++){
                    if($students[$k]->number==$fileData[$i][1]){
                        $student_id=$students[$k]->id;
                        $a=1;
                    }

                }
                //判断有没有对应课程
                for($k=0;$k<$courseNumber;$k++){
                    if($courses[$k]->name==$fileData[$i][2]){
                        $course_id=$courses[$k]->id;
                        $b=1;
                    }
                }
                if($b===0){
                    return $this->error('不存在名字为'.$fileData[$i][2].'的课程');
                }
                if ($a===0) {
                    $Student=new Student;
                    $Student->name=$fileData[$i][0];
                    $Student->number=$fileData[$i][1];
                    $Student->klass_id=$klass_id;
                    if(!$Student->validate(true)->save()){
                        return $this->error('学生信息错误');
                    }else{
                        $Klass=Klass::get($Student->klass_id);
                        $Klass->student_number=$Klass->student_number+1;
                        $Klass->save();
                        $Score=new Score;
                        $Score->student_id=$Student->id;
                        $Score->course_id=$course_id;
                        $Score->usual_score=$fileData[$i][3];
                        $Score->exam_score=$fileData[$i][4];
                        $Score->sum_score=$fileData[$i][3]+$fileData[$i][4];
                        $Score->validate(true)->save();
                    }
                }
            }
        }
        return true;
    }
    /*
    * 保存学生
    */
    private function saveStudent(Student &$Student, $isUpdate = false) 
    {
        // 写入要更新的数据
        $Student->name = Request::instance()->post('name');
        $Student->number = Request::instance()->post('number');
        $Student->email = Request::instance()->post('email');
        $Student->klass_id=Request::instance()->post('klass_id');
        $result= $Student->validate(true)->save();
        if($result){
            $Klass=Klass::get($Student->klass_id);
            $Klass->student_number=$Klass->student_number+1;
            if(!$Klass->validate(true)->save()){
                return $this->error('班级信息错误');
            }
        }
        return $result;
    }
    /*
    *保存成绩
    */
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
    /*
    *选择导出成绩的班级和课程
    */
    public function select()
    {
        $Course= new Course;
        $Klass= new Klass;
        $courses=$Course->select();
        $klasses=$Klass->select();
        $teacher_id=session('id');
        $Courses=array();
        for ($j=0,$i=0; $i <count($courses) ; $i++) { 
            if($courses[$i]->teacher_id==$teacher_id){
                $Courses[$j]=$courses[$i];
                $j++;
            }
        }
        $this->assign([
            'courses'=>$Courses,
            'Klass'=>new Klass
        ]);
        return $this->fetch();
    }
    /*
    *导出成绩
    */
    public function exportFile()
    {   
        $postData=Request::instance()->post();
        $Score=new Score;
        $scores=$Score->select();
        $lists=array();
        for ($j=0,$i=0; $i <count($scores) ; $i++) { 
            $Student=Student::get($scores[$i]->student_id);
            if($scores[$i]->course_id==$postData['course_id'] And $Student->klass_id==$postData['klass_id']){
                $lists[$j]=$scores[$i];
                $j++;
            }
        }
        $ExcelController=new ExcelController;
        $ExcelController->exportExcel($lists);
    }
    /*
    *下载模板
    */
    public function getModel()
    {
        $scores=null;
        $ExcelController=new ExcelController;
        $ExcelController->exportExcel($scores);
    }
}
