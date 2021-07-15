<?php
namespace app\index\controller;
use app\common\model\Klass;        
use think\Controller;
use think\Request;

// 教师端班级管理
class KlassController extends Controller
{
    public function index()
	{	
		//获得查询信息
		$name=Request::instance()->get('name');
		//分页数
		$pageSize=2;
		//实例化klass
		$Klass=new Klass;
		// 按条件查询数据并调用分页
		$klasses = $Klass->where('name', 'like', '%' . $name . '%')->paginate($pageSize, false, [
            'query'=>[
                'name' => $name,
                ],
            ]); 
		//向v层传数据
		$this->assign('klasses',$klasses);
		//返回
		return $this->fetch();

	}

}