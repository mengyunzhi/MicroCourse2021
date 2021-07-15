<?php
namespace app\index\controller;
use think\Controller;
use think\Request;  
use app\common\model\Mould;
use think\Db; 

class AdminMouldController extends Controller
{
	public function index()
	{
		// 获取查询信息
        $name = Request::instance()->get('name');
        
        //分页数目
    	$pageSize= 2;
        
        // 实例化Term
    	$Mould = new Mould;
         
        // 按条件查询数据并调用分页
    	$Moulds= $Mould->where('name', 'like', '%' . $name . '%')->paginate($pageSize, false, [
            'query'=>[
                'name' => $name,
                ],
            ]); 

    	$this->assign('Moulds',$Moulds);

        // 将数据返回给用户
        return $this->fetch();
	}
	public function edit()
	{
		return $this->fetch();
	}
	public function check()
	{
		return $this->fetch();
	}
	public function add()
	{
		return $this->fetch();
	}
	public function set()
	{
		return $this->fetch();
	}
}