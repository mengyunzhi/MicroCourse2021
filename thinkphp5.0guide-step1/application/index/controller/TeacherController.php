<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use app\common\model\Klass;
use app\common\model\Seat;
use app\common\model\SeatRoom;
use app\common\model\Room;
use app\common\model\Course;
use app\common\model\Teacher;
use app\common\model\Student;
use app\common\model\KlassCourse;
use app\common\model\Mould;
use think\Db;

class TeacherController extends IndexController
{	
	public function index()
	{	
		$teacher_id=session('id');
		//实例化对象
		$rooms=new Room;
		$Course=new Course;
		$Klass=new Klass;
        $this->assign([
			'Course'=>$Course,
			'Klass'=>$Klass,
			'rooms'=>$rooms,
			'teacher_id'=>$teacher_id
		]);
		//返回
		return $this->fetch();

	}
	public function onclass()
	{   
       
        //接收数据
		$postData=Request::instance()->post();
        if(count($postData)<6){
            return $this->error('请正确选择信息');
        }
		//实例化对象
		$Teacher=Teacher::get((int)$postData['teacher_id']);
		$Course=Course::get($postData['course_id']);
		$time=$postData['time'];
		$Room=Room::get($postData['room_id']);
        $start = (int)$postData['start'];
        if($start===0){
	    $Room->sign_time = time();
	    $Room->save();
	    }
        $start++;

		//应到人数
		//获取班级信息并计算人数
		$studentNumber=0;
		$Klasses=$Course->Klasses()->select();
		$count=count($Klasses);
		for ($i=0; $i <$count ; $i++) { 
			$Klass=new Klass;
			$Klass=$Klasses[$i];
			if (true===$Course->getIsChecked($Klass)) {
				$studentNumber=$studentNumber+$Klass->student_number;
			}

		}
        //把教室改为占用
        $Room->is_occupy = 1;
        $Room->save();


		 //获取所有模板信息
        $Moulds = Db::name('mould')->select();

        //获取座位信息
        $Seats = Db::name('seat_room')->select();


        //计算实到人数
        $cnt=0;
        foreach ($Seats  as  $seat) {
        	if($seat['is_seated']===1)
        	{
        		$cnt++;
        	}
        }

        //获取过道信息
        $Aisles = Db::name('aisle')->select();

        //获取模板信息
        $Mould =Mould::get($Room->mid);
       
        // 将数据传给V层
       

        $this->assign('Moulds', $Moulds);

        $this->assign('Mould', $Mould);

        $this->assign('Room', $Room);

        $this->assign('Seats',$Seats);
        
        $this->assign('Aisles',$Aisles);
		//随机点名
		$studentName=$this->getStudent($postData['course_id']);
		//向v层传数据
		$this->assign([
			'postData'=>$postData,
			'Course'=>$Course,
			'studentNumber'=>$studentNumber,
			'time'=>$postData['time'],
			'room_id'=>$Room->id,
			'cnt'=>$cnt,
			'start'=>$start,
			'studentName'=>$studentName,
			'teacherName'=>$Teacher->name,
			'teacher_id'=>$Teacher->id
		]);
		return $this->fetch();
	}

	//下课
    public function OffClass ()
    {    //接收数据
		$postData=Request::instance()->post();
         //把教室改为未占用
         $room=Room::get($postData['room_id']);
         $room->is_occupy = 0;
         $room->sign_time=2542005150; 
         $room->save();
         
         //把所有座位的is_seated和student_id改为0
         $SeatRooms = Db::name('seat_room')->select();

         foreach ($SeatRooms as $SeatRoom) {
         	if($SeatRoom['room_id']===$room->id)
         	{
         		$seat_room = SeatRoom::get($SeatRoom['id']);
         		$seat_room->is_seated=0;
         		$seat_room->student_id=0;
         		$seat_room->save();
         	}
         }


         $this->success('下课，老师您辛苦了', url('index'));
    }

	//获取学生
	public function getStudent($course_id)
    {
        //获取班级
        $Course=Course::get($course_id);
        $klasses=$Course->Klasses()->select();
        $KlassCourse=new KlassCourse;
        $klassCourses=$KlassCourse->select();
        $number=count($klassCourses);
        $klassIds=array();
        for ($j=0 ,$i=0; $i < $number; $i++) { 
            if($klassCourses[$i]->course_id==$course_id){
                $klassIds[$j]=$klassCourses[$i]->klass_id;
                $j++;
            }
        }
        //获取学生
        $Student=new Student;
        $students=$Student->select();
        $studentIds=array();
        $klassNumber=count($klassIds);
        //随机生成班级
        $klassId=(int)$this->dc_rand1(0,$klassNumber,2)[0];
        if($klassId==$klassNumber){
        	$klassId--;
        }
        //获取学生
        for ($j=0,$i=0; $i <count($students); $i++) { 
            if($students[$i]->klass_id==$klassIds[$klassId]){
                $studentIds[$j]=$students[$i]->id;
                $j++;
            }

        }
        //随机选择学生
        $studentNumber=count($studentIds);
        if ($studentNumber===0) {
        	$studentName='';
        }else{
        	$studentId=(int)$this->dc_rand1(0,$studentNumber,5)[3];
        	if($studentId==$studentNumber){
        		$studentId--;
        	}
        	$Student=Student::get($studentIds[$studentId]);
        	$studentName=$Student->name;
        }
        return $studentName;
             
    }
    /*
    *签到
    */
    public  function signIn()
    {
        $postData=Request::instance()->post();
        $time=$postData['time'];
        $time=time()+(int)$time*60;

        //获取所有模板信息
        $Moulds = Db::name('mould')->select();

        $Room=Room::get($postData['room_id']);

        $Room->end_time = $time;

        $Room->save();

        $Mould =Mould::get($Room->mid);

        //获取座位信息
        $Seats = Db::name('seat_room')->select();
        
        

        //获取过道信息
        $Aisles = Db::name('aisle')->select();
        return $this->fetch('onClass',[
            'Course'=>Course::get($postData['course_id']),
            'teacherName'=>Teacher::get($postData['teacher_id'])->name,
            'time'=>$time,
            'studentName'=>$postData['studentName'],
            'Room'=>Room::get($postData['room_id']) ,
            'studentNumber'=>$postData['studentNumber'],
            'Moulds'=>$Moulds,
            'Seats'=>$Seats,
            'Mould'=>$Mould,
            'cnt'=>$postData['cnt'],
            'Aisles'=>$Aisles,
            'start'=>$postData['start'],
            'teacher_id'=>$postData['teacher_id'],
            'room_id'=>$postData['room_id']
        ]);
    }
	//获得随机数
	public function dc_rand1($min, $max, $num)
	{
        $count = 0;
        $return = array();
        while ($count < $num) {
            $return[] = mt_rand($min*100, $max*100)/100;
            $count = count($return);
        }
//        //打乱数组，重新赋予数组新的下标
//        shuffle($return);
        return $return;//返回的是一维数组
    }
	public function test()
    {  
        return $this->fetch();
    }
    public function put()
    {
        $keyword="<script>document.writeln(keyword);</script>";//php获取js的变量！！
        var_dump($keyword);
    }
}