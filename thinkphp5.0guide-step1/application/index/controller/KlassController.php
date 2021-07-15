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

    //增加数据
    public function add()
    {
    	// 获取所有的教师信息
        $klasses = Klass::all();
        $this->assign('klasses', $klasses);
        return $this->fetch();
    }

    public function save()
    {
        $Request = Request::instance();
        $Klass = new Klass();
        $Klass->name = $Request->post('name');
        var_dump($Klass->save());
        return $Klass->name . '成功增加至数据表中。新增ID为:' . $Klass->id;
    }

}