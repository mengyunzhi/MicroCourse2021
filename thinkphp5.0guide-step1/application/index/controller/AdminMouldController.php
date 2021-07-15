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

        // 获取传入ID
        $id = Request::instance()->param('id/d');

        // 判断是否成功接收
        if (is_null($id) || 0 === $id) {
            $this->error('未获取到学期信息');
        }
        
        // 在模型中获取当前记录
        if (null === $Mould = Mould::get($id))
        {
            $this->error('系统未找到ID为' . $id . '的记录');
        } 
        
        //获取座位信息
        $Seats = Db::name('seat')->select();

        //获取过道信息
        $Aisles = Db::name('aisle')->select();
       
        // 将数据传给V层
        $this->assign('Mould', $Mould);

        $this->assign('Seats',$Seats);
        
        $this->assign('Aisles',$Aisles);

        // 获取封装好的V层内容
        $htmls = $this->fetch();

        // 将封装好的V层内容返回给用户
        return $htmls;

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