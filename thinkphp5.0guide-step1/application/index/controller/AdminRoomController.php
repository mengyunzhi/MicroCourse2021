<?php
namespace app\index\controller;
use think\Controller;
use app\common\model\Mould;
use think\Db;
use app\common\model\Room;
use think\Request;  
class AdminRoomController extends Controller
{
	public function index()
	{
		// 获取查询信息
        $name = Request::instance()->get('name');
        
        //分页数目
    	$pageSize= 2;
        
        // 实例化Term
    	$Room = new Room;
         
        // 按条件查询数据并调用分页
    	$Rooms= $Room->where('name', 'like', '%' . $name . '%')->order('is_occupy desc')->paginate($pageSize, false, [
            'query'=>[
                'name' => $name,
                ],
            ]); 

    	$this->assign('Rooms',$Rooms);

        // 将数据返回给用户
        return $this->fetch();
	}

	public function add()
	{
		return $this->fetch();
	}

	public function edit()
	{
		return $this->fetch();
	}
}