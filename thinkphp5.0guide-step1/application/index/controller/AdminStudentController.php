<?php
namespace app\index\controller;
use think\Controller;
use app\common\model\Student;
use think\Request;

class AdminStudentController extends Controller
{
	public function index()
	{	
		//获得查询信息
		$name=Request::instance()->get('name');
		//分页数
		$pageSize=15;
		//实例化Student
		$Student=new Student;
		// 按条件查询数据并调用分页
		$students = $Student->where('name', 'like', '%' . $name . '%')->paginate($pageSize, false, [
            'query'=>[
                'name' => $name,
                ],
            ]); 
		//向v层传数据
		$this->assign('students',$students);
		//返回
		return $this->fetch();
	}
	//重置密码
	public function resentPassword()
	{
		try{
			//接收id
			$id=Request::instance()->param('id/d');
			if(is_null($id)||0===$id){
				throw new \Exception('未获取到ID信息', 1);
			}
			//获取对应的Student
			if (null===$Student=Student::get($id)) {
				return $this->error('系统未找到ID为' . $id . '的记录');
			}
			//重置密码
			$Student->password=$Student->number;
			//保存
			$Student->save();
			return $this->success('操作成功 密码重置为'.$Student->number, url('index'));
		}catch(\think\Exception\HttpResponseException $e){
			throw $e;
		}catch(\Exception $e){
			return $e->getMessage();
		}
		
		
	}
}