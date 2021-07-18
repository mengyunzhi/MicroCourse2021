<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Db;
use app\common\model\Course;
use app\common\model\Teacher;
use app\common\model\KlassCourse;
use app\common\model\Score;

//教师端课程管理
class TeacherCourseController extends IndexController
{
	 public function index()
    {
        try {
            // 获取查询信息
            $name = Request::instance()->get('name');

            $pageSize = 5; // 每页显示5条数据

            // 实例化Teacher
            $Course = new Course; 

            // 定制查询信息
            if (!empty($name)) {
                $Course->where('name', 'like', '%' . $name . '%');
            }

            // 按条件查询数据并调用分页
            $courses = $Course->paginate($pageSize, false, [
                'query'=>[
                    'name' => $name,
                    ],
                ]);
            // 向V层传数据
            $this->assign([
                'courses'=> $courses,
                'Teacher'=>new Teacher
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
    //添加数据
	public function add()
	{
		$this->assign([
            'Course'=> new Course,
            'Teacher'=>new Teacher
        ]);
        return $this->fetch();
	} 
	public function edit()
	{
		$id=Request::instance()->param('id/d');
    	$Course =Course::get($id);
    	if(is_null($Course)){
    		return $this->error('不存在ID为'.$id.'的记录');
    	}
    	$this->assign('Course',$Course);
    	return $this->fetch();
	}
	public function delete()
	{
		try {
            // 获取get数据
            $Request = Request::instance();
            $id = Request::instance()->param('id/d');
            $map = ['course_id'=>$id];
            // 判断是否成功接收
            if (0 === $id) {
                throw new \Exception("未获取到ID信息", 1);
            }

            // 获取要删除的对象
            $Course = Course::get($id);
            // 要删除的对象存在
            if (is_null($Course)) {
                throw new \Exception('不存在id为' . $id . '的课程，删除失败', 1);
            }
            // 删除对象
            if (false === $Course->KlassCourses()->where($map)->delete()) {
            return $this->error('删除班级课程关联信息发生错误' . $Course->KlassCourses()->getError());
       		}	
            if (!$Course->delete()) {
                $message = '删除失败:' . $Course->getError();
            }else{
                $Score=new Score;
                $course_id=$id;
                $scores=$Score->select();
                $number=count($scores);
                for ($i=0; $i <$number ; $i++) { 
                    if($scores[$i]->course_id===$course_id){
                        $scores[$i]->delete();
                    }
                }
            }
            // 进行跳转
            return $this->success('删除成功', $Request->header('referer')); 
        } catch(\think\Exception\HttpResponseException $e){
            throw $e;
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return $this->error($message);
	}
	public function update()
    {
        // 获取当前课程
        $id = Request::instance()->post('id/d');
        if (is_null($Course = Course::get($id))) {
            return $this->error('不存在ID为' . $id . '的记录');
        }

        // 更新课程名
        $Course->name = Request::instance()->post('name');
        if (is_null($Course->validate(true)->save())) {
            return $this->error('课程信息更新发生错误：' . $Course->getError());
        }

        // 删除原有信息
        $map = ['course_id'=>$id];

        // 执行删除操作。由于可能存在 成功删除0条记录，故使用false来进行判断，而不能使用
        // if (!KlassCourse::where($map)->delete()) {
        // 我们认为，删除0条记录，也是成功
        if (false === $Course->KlassCourses()->where($map)->delete()) {
            return $this->error('删除班级课程关联信息发生错误' . $Course->KlassCourses()->getError());
        }

        // 增加新增数据，执行添加操作。
        $klassIds = Request::instance()->post('klass_id/a');
        if (!is_null($klassIds)) {
            if (!$Course->Klasses()->saveAll($klassIds)) {
                return $this->error('课程-班级信息保存错误：' . $Course->Klasses()->getError());
            }
        }

        return $this->success('更新成功', url('index'));
    }
	public function save()
    {
        // 存课程信息
        $Course = new Course();
        $Course->name = Request::instance()->post('name');

        // 新增数据并验证。验证类我们好像还没有写呢。自己参考其它的验证类，写一下吧。
        if (!$Course->validate(true)->save()) {
            return $this->error('课程保存错误：' . $Course->getError());
        }

        // -------------------------- 新增班级课程信息 -------------------------- 
        // 接收klass_id这个数组
        $klassIds = Request::instance()->post('klass_id/a');       // /a表示获取的类型为数组

        // 利用klass_id这个数组，拼接为包括klass_id和course_id的二维数组。
        if (!is_null($klassIds)) {
            if (!$Course->Klasses()->saveAll($klassIds)) {
                return $this->error('课程-班级信息保存错误：' . $Course->Klasses()->getError());
            }
        }
        // -------------------------- 新增班级课程信息(end) -------------------------- 
        
        unset($Course); // unset出现的位置和new语句的缩进量相同，在返回前，最后被执行。
        return $this->success('操作成功', url('index'));
    }
    //查看班级
    public function klass()
    {
    	//接收id
    	$id = Request::instance()->param('id/d');
        $Course=Course::get($id);
        $this->assign('Course',$Course);
        return $this->fetch();
    }
}