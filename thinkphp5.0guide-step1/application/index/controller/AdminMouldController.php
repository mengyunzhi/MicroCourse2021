<?php
namespace app\index\controller;
use think\Controller;
use think\Request;  
use app\common\model\Mould;
use app\common\model\Seat;
use app\common\model\Aisle;
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
	public function check()
	{

        // 获取传入ID
        $id = Request::instance()->param('id/d');

        // 判断是否成功接收
        if (is_null($id) || 0 === $id) {
            $this->error('未获取到模板信息');
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
	public function edit()
	{
		// 获取传入ID
        $id = Request::instance()->param('id/d');

        // 判断是否成功接收
        if (is_null($id) || 0 === $id) {
            $this->error('未获取到模板信息');
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

    //修改座位成过道 
    public function changeSeat()
    {
       // 获取传入ID
        $id = Request::instance()->param('id/d');

        // 判断是否成功接收
        if (is_null($id) || 0 === $id) {
            $this->error('未获取到模板信息');
        }
        
        // 在模型中获取当前记录
        if (null === $seat = Seat::get($id))
        {
            $this->error('系统未找到ID为' . $id . '的记录');
        } 
        

        //保存过道信息
        $aisle = new Aisle();
        $aisle->x= $seat->x;
        $aisle->y= $seat->y;
        $aisle->mid= $seat->mid;
        
        // 删除数据表中座位的信息
        if (is_null($seat)) {
            return $this->error('不存在该座位，删除失败');
        }

        // 删除对象
        if (!$seat->delete()) {
            return $this->error('删除失败:' . $seat->getError());
        }
        
        //添加过道信息道数据库中
        $result = $aisle->validate(true)->save();
  
        if (false === $result)
        {   
            // 验证未通过，发生错误
            $message = '修改失败:' . $aisle->getError();
            return $this->error($message);
        } 
        
        //获取模板id
        $mid=$aisle->mid;
          
        $url = url('edit?id=' . $mid);
        
        // 返回页面
        header("Location: $url");
        exit(); 
    }
    //修改过道成座位
    public function changeAisle()
    {
       // 获取传入ID
        $id = Request::instance()->param('id/d');

        // 判断是否成功接收
        if (is_null($id) || 0 === $id) {
            $this->error('未获取到模板信息');
        }
        
        

        // 在模型中获取当前记录
        if (null ===  $aisle = Aisle::get($id))
        {
            $this->error('系统未找到ID为' . $id . '的记录');
        } 

        //保存过道信息
        $seat = new seat();
        $seat->x= $aisle->x;
        $seat->y= $aisle->y;
        $seat->mid= $aisle->mid;
        
        // 删除数据表中过道的信息
        if (is_null($aisle)) {
            return $this->error('不存在该座位，删除失败');
        }

        // 删除对象
        if (!$aisle->delete()) {
            return $this->error('删除失败:' . $aisle->getError());
        }
        
        //添加座位信息道数据库中
        $result = $seat->validate(true)->save();
  
        if (false === $result)
        {   
            // 验证未通过，发生错误
            $message = '修改失败:' . $seat->getError();
            return $this->error($message);
        } 
        
        //获取模板id
        $mid=$seat->mid;
          
        $url = url('edit?id=' . $mid);
        
        // 返回页面
        header("Location: $url");
        exit(); 
    }

    public function save()
    {
        $postData = Request::instance()->post();

        $id = $postData['id'];

        $Mould = Mould::get($id);

        $Mould->num=$postData['num'];
        $Mould->name=$postData['name'];
 
        // 保存数据
        $Mould->validate(true)->save();
            

        return $this->success('操作成功', url('check?id=' . $id));
    }

	public function add()
	{
		return $this->fetch();
	}
	public function set()
	{
		return $this->fetch();
	}

	public function delete()
	{
		// 获取传入ID
        $id = Request::instance()->param('id/d'); 

        // 判断是否成功接收
        if (0 === $id || is_null($id) ) {
             return $this->error('未获取到ID信息');
        }

        // 获取要删除的对象
        $Mould = Mould::get($id);

        // 要删除的对象不存在
        if (is_null($Mould)) {
            return $this->error('不存在id为' . $id . '的学期，删除失败');
        }

        // 删除对象
        if (!$Mould->delete()) {
            return $this->error('删除失败:' . $Mould->getError());
        }
        return $this->success('删除成功',url('index')); 
	}
}