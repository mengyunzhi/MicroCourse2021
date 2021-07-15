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

    // public function save()
    // {
    //     $Request = Request::instance();
    //     $Klass = new Klass();
    //     $Klass->name = $Request->post('name');
    //     var_dump($Klass->save());
    //     return $Klass->name . '成功增加至数据表中。新增ID为:' . $Klass->id;
    // }
        public function save()
    {
        // 实例化请求信息
        $Request = Request::instance();

        // 实例化班级并赋值
        $Klass = new Klass();
        $Klass->name = $Request->post('name');

        // 添加数据
        if (!$Klass->validate(true)->save()) {
            return $this->error('数据添加错误：' . $Klass->getError());
        }

        return $this->success('操作成功', url('index'));
    }
    public function edit()
    {
        $id = Request::instance()->param('id/d');

        // 获取用户操作的班级信息
        if (false === $Klass = Klass::get($id))
        {
            return $this->error('系统未找到ID为' . $id . '的记录');
        }

        $this->assign('Klass', $Klass);
        return $this->fetch();
    }

    public function update()
    {
        $id = Request::instance()->post('id/d');

        // 获取传入的班级信息
        $Klass = Klass::get($id);
        if (is_null($Klass)) {
            return $this->error('系统未找到ID为' . $id . '的记录');
        }

        // 数据更新
        $Klass->name = Request::instance()->post('name');
        if (!$Klass->validate()->save()) { 
            return $this->error('更新错误：' . $Klass->getError());
        } else {
            return $this->success('操作成功', url('index'));
        }
    }
}