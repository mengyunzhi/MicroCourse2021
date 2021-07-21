<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use app\common\model\Student;
use app\common\model\Score;
use app\common\model\Course;

class ScoreController extends IndexController
{
	public function index()
    {
        try {
            // 获取查询信息
            $id = Request::instance()->param('id/d');
            $pageSize = 5; // 每页显示5条数据
            // 实例化Score
            $Score = new Score; 
            // 定制查询信息
             // 定制查询信息
            if (!empty($id)) {
                $Score->where('student_id', '=',  $id );
            }

            // 按条件查询数据并调用分页
            $scores = $Score->paginate($pageSize, false, [
                'query'=>[
                    'student_id' => $id,
                    ],
                ]);
            //筛选老师的课程
            $teacher_id=session('id');
            $Scores=array();
            for ($i=0,$j=0; $i <count($scores); $i++) { 
                if(Course::get($scores[$i]->course_id)->teacher_id==$teacher_id){
                    $Scores[$j]=$scores[$i];
                    $j++;
                }
            }
            // 向V层传数据
            $this->assign([
				'Student'=>new Student,
				'Course'=>new Course,
				'scores'=>$Scores
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
    	try{
            $id=Request::instance()->param('id/d');
            if(is_null($id)){
                throw new\Exception('未获取到ID信息',1);
            }
            if(null===$Score=Score::get($id)){
                $this->error('系统未找到ID为' . $id . '的记录');
            }
            $this->assign([
				'Student'=>new Student,
				'Score'=>$Score
			]);
            return $this->fetch();
        }catch(\think\Exception\HttpResponseException $e){
        throw $e;
        }catch(\Exception $e){
        return $e->getMessage();
        }
    }
    //更新数据
    public function update()
    {   
        try{
            $id=Request::instance()->post('id/d');
            //获取当前对象
            $Score=Score::get($id);
            if(!is_null($Score)){
                $Score->usual_score=input('post.usual_score');
                $Score->exam_score=input('post.exam_score');
                $Score->sum_score=input('post.usual_score')+input('post.exam_score');
                    if(false===$Score->validate(true)->save()){
                        return $this->error('更新失败' . $Score->getError());
                    }
            }else{
                throw new \Exception("所更新的记录不存在", 1);
                
            }
        }catch(\think\Exception\HttpResponseException $e){
            throw $e;
        }catch(\Exception $e){
            return $e->getMessage();
        }
        return $this->success('操作成功',url('index?id='.$Score->student_id));
    }
    
}