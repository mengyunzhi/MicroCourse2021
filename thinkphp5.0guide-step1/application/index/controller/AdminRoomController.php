<?php
namespace app\index\controller;
use think\Controller;
use app\common\model\Mould;
use think\Db;
use app\common\model\Room;
use app\common\model\Aisle;
use app\common\model\Seat;
use think\Request;  
class AdminRoomController extends Index3Controller
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
    public function choose()
    {   $id = Request::instance()->param('id/d');
        $postData = Request::instance()->param();

        if(!$postData['room_name']){
            $this->error('教室名字不能为空');
        }

        $room_name = $postData['room_name'];
        $room_id = $postData['room_id'];
        
        //获取所有模板信息
        $Moulds = Db::name('mould')->select();

        //获取模板信息
        $Mould = Mould::get($id);

        //获取座位信息
        $Seats = Db::name('seat')->select();

        //获取过道信息
        $Aisles = Db::name('aisle')->select();
       
        $this->assign('Moulds', $Moulds);

        $this->assign('Mould', $Mould);

        $this->assign('op', $postData['op']);

        $this->assign('room_name', $room_name);
        
        $this->assign('room_id', $room_id);

        $this->assign('Seats',$Seats);
        
        $this->assign('Aisles',$Aisles);

        // 获取封装好的V层内容
        $htmls = $this->fetch();

        // 将封装好的V层内容返回给用户
        return $htmls;
    }
	public function add()
	{
		
        $postData = Request::instance()->param();
        
        if(!$postData){
        $Mould = new Mould ; 

        $Mould->id = 0;
        $Mould->num = "";
        $Mould->name =  " ";
        $room_name="";
        }
        else
        {
            $mid = $postData['mid'];
            $Mould = Mould::get($mid);
            $room_name = $postData['room_name'];
        }

        
        $room_id= 0;
        $mid = 0;

       

        $this->assign('room_name', $room_name);

        $this->assign('Mould', $Mould);
        
        $this->assign('room_id', $room_id);

        $this->assign('op',1); 

        // 获取封装好的V层内容
        $htmls = $this->fetch();

        // 将封装好的V层内容返回给用户
        return $htmls;
	}

	public function edit()
	{   
        
		// 获取传入ID
        $id = Request::instance()->param('id/d');
        $postData = Request::instance()->param();

        $room_name = $postData['room_name'];
        $mid = $postData['mid'];

        // 判断是否成功接收
        if (is_null($id) || 0 === $id) {
            $this->error('未获取到教室信息');
        }
        
        // 在模型中获取当前记录
        if (null === $room = Room::get($id))
        {
            $this->error('系统未找到ID为' . $id . '的记录');
        } 
         
         // 在模型中获取当前记录
        if (null === $Mould = Mould::get($mid))
        {
            $this->error('系统未找到ID为' . $id . '的记录');
        }    
         
        
        $this->assign('room_name',$room_name); 
        // 将数据传给V层
        $this->assign('room', $room);

        $this->assign('Mould', $Mould);

        $this->assign('op',0);

        // 获取封装好的V层内容
        $htmls = $this->fetch();

        // 将封装好的V层内容返回给用户
        return $htmls;
	}

    public function save()
    {
        $postData = Request::instance()->post();

        $id = $postData['room_id'];

        $room = Room::get($id);

        $room->num=$postData['num'];

        $room->name=$postData['room_name'];

        $room->mid=$postData['mid'];
 
        // 保存数据
        $result= $room->validate(true)->save();
            
        if (false === $result)
        {   
            // 验证未通过，发生错误
            $message = '更新失败:' . $room->getError();
            return $this->error($message);
        } else {
            // 提示操作成功，并跳转至管理列表
            return $this->success('教室'. $room->name . '更新成功。', url('index'));
        } 
     }

    public function insert ()
    {
       $message = '';  // 提示信息

        // 接收传入数据
        $postData = Request::instance()->post();    
         // 实例化空对象
        $room = new room();

        // 为对象赋值
        $room->name = $postData['room_name'];
        $room->num = $postData['num'];
        $room->mid = $postData['mid'];
        // 新增对象至数据表
        $result = $room->validate(true)->save();
        
        // 反馈结果
        if (false === $result)
        {   
            // 验证未通过，发生错误
            $message = '新增失败:' . $room->getError();
            return $this->error($message);
        } else {
            // 提示操作成功，并跳转至管理列表
            return $this->success( $room->name . '新增成功。', url('index'));
        } 

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
        $room = room::get($id);

        // 要删除的对象不存在
        if (is_null($room)) {
            return $this->error('不存在id为' . $id . '的学期，删除失败');
        }

        // 删除对象
        if (!$room->delete()) {
            return $this->error('删除失败:' . $room->getError());
        }
        return $this->success('删除成功',url('index')); 
    }

        public function QRCode()
    {
        $id = input('param.id/d');
        $AdminRoom = AdminRoom::get($id);
        $seats = Seat::where('classroom_id', '=', $id)->order('id desc')->select();
        if (empty($seats)) {
            return $this->error('当前教室无座位', url('index'));
        }
        $SeatMap = SeatMap::get($Classroom->seat_map_id);
        $this->assign('seats', $seats);
        $this->assign('SeatMap', $SeatMap);
        $this->assign('Classroom', $Classroom);
        $url = 'http://' . $_SERVER['HTTP_HOST'] . '/index/login/studentWx?seatId=';
        $urlTeacher = 'http://' . $_SERVER['HTTP_HOST'] . '/index/login/teacherIndex?classroomId=' . $Classroom->id;
        $this->assign('url', $url);
        $this->assign('urlTeacher', $urlTeacher);
        return $this->fetch();
    }
}