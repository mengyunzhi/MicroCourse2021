<?php
namespace app\index\controller;
use think\Controller;
use think\Request;  
use app\common\model\Mould;
use app\common\model\Seat;
use app\common\model\Aisle;
use think\Db; 
use app\common\model\Room;

class AdminMouldController extends Index3Controller
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
        
        //获取所有模板信息
        $Moulds = Db::name('mould')->select();

        //获取座位信息
        $Seats = Db::name('seat')->select();

        //获取过道信息
        $Aisles = Db::name('aisle')->select();
       
        // 将数据传给V层
        $this->assign('Mould', $Mould);

        $this->assign('Moulds', $Moulds);


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
    
    //设置座位信息
	public function set()
	{
		$postData = Request::instance()->post();
         
        $Mould = new Mould;

        $Mould->name=$postData['name'];
        $Mould->row=$postData['row'];
        $Mould->line=$postData['line'];
        $Mould->num =(int) $Mould->row *(int) $Mould->line;

        //获取到最后一条记录
          $Moulds = Db::name('mould')->select();
          $last = 0;
          foreach ($Moulds as $value) {
              $last = $value['id'];
            }
          $Mould2 = Mould::get($last); 
          if($Mould2){
            $Mould2->is_last = 0;
            $Mould2->validate()->save();
         } 
          //如果数据库没有数据 is_first改为1l
          if(!$Moulds){
            $Mould->is_first = 1;
          }        
         $Mould->is_last = 1;
        

        // 新增对象至数据表
        $result = $Mould->validate(true)->save();
         
        if (false === $result)
        {   
            // 验证未通过，发生错误
            $message = '新增失败:' . $Mould->getError();
            return $this->error($message);
        } else { 

            //增加row*line的座位列表
            for($x=1;$x<=$Mould->row;$x++){
                for($y=1;$y<=$Mould->line;$y++){
                    $seat = new Seat;
                    $seat->mid=$Mould->id;
                    $seat->x = $x;
                    $seat->y = $y;
                    $result = $seat->validate(true)->save();
                    if (false === $result)
                    {   
                        // 验证未通过，发生错误
                        $message = '新增失败:' . $seat->getError();
                        return $this->error($message);
                    }      
                }
            }
        }  

        //将模板的is_last改为1 
        

        return $this->success('创建成功', url('check?id=' . $Mould->id));
	}
    
	public function delete()
	{
		// 获取传入ID
        $id = Request::instance()->param('id/d'); 

        // 判断是否成功接收
        if (0 === $id || is_null($id) ) {
             return $this->error('未获取到ID信息');
        }
 
        $match = 0;

        // 获取要删除的对象
        $Mould = Mould::get($id);

        $mid = $Mould->id;

        //如果是第一条数据
        if($Mould->is_first===1){
             $match = 1;
        }
        
        //如果是最后一条数据
        if($Mould->is_last===1){
            $match = 2;
        }

        // 要删除的对象不存在
        if (is_null($Mould)) {
            return $this->error('不存在id为' . $id . '的模板，删除失败');
        }

        // 删除对象
        if (!$Mould->delete()) {
            return $this->error('删除失败:' . $Mould->getError());
        }

        //将对应的教室删除
        $Rooms = Db::name('room')->select();  
         foreach ($Rooms as $value) {
              if($value['mid']===$mid){
                $room = Room::get($value['id']);
                // 要删除的对象不存在
                if (is_null($room)) {
                    return $this->error('不存在id为' . $id . '的教室，删除失败');
                }
                // 删除对象
                if (!$room->delete()) {
                    return $this->error('删除失败:' . $room->getError());
                }
              }
          }
         //将对应的seat删除
         $Seats= Db::name('seat')->select();  
         foreach ($Seats as $value) {
              if($value['mid']===$mid){
                $seat = Seat::get($value['id']);
                // 要删除的对象不存在
                if (is_null($seat)) {
                    return $this->error('不存在id为' . $id . '的座位，删除失败');
                }
                // 删除对象
                if (!$seat->delete()) {
                    return $this->error('删除失败:' . $seat->getError());
                }
              }
          }
        //将对应的aisle删除
         $Aisles= Db::name('aisle')->select();  
         foreach ($Aisles as $value) {
              if($value['mid']===$mid){
                $Aisle = Aisle::get($value['id']);
                // 要删除的对象不存在
                if (is_null($Aisle)) {
                    return $this->error('不存在id为' . $id . '的过道，删除失败');
                }
                // 删除对象
                if (!$Aisle->delete()) {
                    return $this->error('删除失败:' . $Aisle->getError());
                }
              }
          }
            

        //如果是第一条数据
        if($match===1){
             
        //将下一条对象的is_first改为1
        $Mould1 = Mould::get();
         if($Mould1){
            $Mould1->is_first = 1;
            $Mould1->validate()->save();
         }
        }
        //如果是最后一条数据
        if($match === 2){
          //将id最大的对象的is_last改为1
          //获取所有模板信息
          $Moulds = Db::name('mould')->select();
          $last = 0;
          foreach ($Moulds as $value) {
              $last = $value['id'];
            }
          $Mould2 = Mould::get($last); 
          if($Mould2){
            $Mould2->is_last = 1;
            $Mould2->validate()->save();
         } 
        }

        return $this->success('删除成功',url('index')); 
	}
}