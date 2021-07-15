<?php
namespace app\index\controller;
use think\Request;  
use think\Controller;
use app\common\model\Term;
use think\Db; 

class AdminTermController extends Controller
{

    public function index()
    {    
    	// 获取查询信息
        $name = Request::instance()->get('name');
        
        //分页数目
    	$pageSize= 2;
        
        // 实例化Term
    	$Term = new Term;
         
        // 按条件查询数据并调用分页
    	$Terms= $Term->where('name', 'like', '%' . $name . '%')->order('effect desc')->paginate($pageSize, false, [
            'query'=>[
                'name' => $name,
                ],
            ]); 

    	$this->assign('Terms',$Terms);

        // 将数据返回给用户
        return $this->fetch();

    }

     public function add ()
    {
      
     return $this->fetch();
    }

    public function insert()
    {      
       //将其他生效学期改为冻结
       $Terms = Db::name('term')->select();

       //循环数组
       foreach ($Terms as $key => $value) {
       	//把生效的学期改为冻结
            if($value['effect']===1){
               $term1 = Term::get($value['id']);
               $term1->effect=0;
               $term1->save();
            }
        } 
      
         $message = '';  // 提示信息

        // 接收传入数据
        $postData = Request::instance()->post();    
         // 实例化空对象
        $term = new term();
       
        $time1=strtotime($postData['start_time']);
        $time2=strtotime($postData['end_time']);

        // 为对象赋值
        $term->name = $postData['name'];
        $term->start_time = $time1;
        $term->end_time = $time2;
        $term->effect = $postData['effect'];
        // 新增对象至数据表
        $result = $term->validate(true)->save();
        
        // 反馈结果
        //判断日期是否为空
        if($term->end_time===false ||$term->start_time===false){
            $message = '新增失败:' . '日期不能为空';
        	return $this->error($message);
        }

        //判断开始日期是否小于结束日期
        if($term->end_time<$term->start_time){
            $message = '新增失败:' . '开始日期不能大于结束日期';
        	return $this->error($message);
        }

        if (false === $result)
        {   
            // 验证未通过，发生错误
            $message = '新增失败:' . $term->getError();
            return $this->error($message);
        } else {
            // 提示操作成功，并跳转至管理列表
            return $this->success( $term->name . '新增成功。', url('index'));
        } 
     
    }

     public function edit()
    {
       // 获取传入ID
        $id = Request::instance()->param('id/d');

        // 判断是否成功接收
        if (is_null($id) || 0 === $id) {
            $this->error('未获取到学期信息');
        }
        
        // 在模型中获取当前记录
        if (null === $Term = Term::get($id))
        {
            $this->error('系统未找到ID为' . $id . '的记录');
        } 
        
        // 将数据传给V层
        $this->assign('Term', $Term);

        // 获取封装好的V层内容
        $htmls = $this->fetch();

        // 将封装好的V层内容返回给用户
        return $htmls;
    }
    public function save(){
        $message = '';  // 提示信息

        // 接收传入数据
        $postData = Request::instance()->post();    
         // 实例化空对象
        $term = Term::get($postData['id']);
       
        $time1=strtotime($postData['start_time']);
        $time2=strtotime($postData['end_time']);

        // 为对象赋值
        $term->name = $postData['name'];
        $term->start_time = $time1;
        $term->end_time = $time2;
        

        //判断日期是否为空
        if($term->end_time===false ||$term->start_time===false){
            $message = '新增失败:' . '日期不能为空';
        	return $this->error($message);
        }

        //判断开始日期是否小于结束日期
        if($term->end_time<$term->start_time){
            $message = '新增失败:' . '开始日期不能大于结束日期';
        	return $this->error($message);
        }

        if(!$term->name){
        	$message = '新增失败:' . 'name不能为空';
        	return $this->error($message);
        }
        //保存信息
        $term->validate(true)->save();

        // 提示操作成功，并跳转至管理列表
        return $this->success( $term->name . '编辑成功。', url('index'));
    }
    
    //删除学期
    public function delete(){
    	// 获取传入ID
        $id = Request::instance()->param('id/d'); 

        // 判断是否成功接收
        if (0 === $id || is_null($id) ) {
             return $this->error('未获取到ID信息');
        }

        // 获取要删除的对象
        $Term = Term::get($id);

        // 要删除的对象不存在
        if (is_null($Term)) {
            return $this->error('不存在id为' . $id . '的学期，删除失败');
        }

        // 删除对象
        if (!$Term->delete()) {
            return $this->error('删除失败:' . $Teacher->getError());
        }
        return $this->success('删除成功',url('index')); 
    }
    //激活学期
    public function activate()
    {
    	// 获取传入ID
        $id = Request::instance()->param('id/d'); 

        // 判断是否成功接收
        if (0 === $id || is_null($id) ) {
             return $this->error('未获取到ID信息');
        }

        // 获取要激活的对象
        $Term = Term::get($id);

        // 要激活的对象不存在
        if (is_null($Term)) {
            return $this->error('不存在id为' . $id . '的学期，删除失败');
        }

        //将其他激活学期的生效值改为0
        //获取所有数据
         $Terms = Db::name('term')->select();

        //循环数组
         foreach ($Terms as $key => $value) {
       	//把生效的学期改为冻结
             if($value['effect']===1){
               $term1 = Term::get($value['id']);
               $term1->effect=0;
               $term1->save();
            }
        } 

        //将激活的学期生效值改为1
        $Term->effect = 1;

        //保存   
        $Term->validate(true)->save();
       
       return $this->success('激活'.$Term->name.'成功',url('index'));
    }

    //冻结学期
    public function frozen()
    {
       // 获取传入ID
        $id = Request::instance()->param('id/d'); 

        // 判断是否成功接收
        if (0 === $id || is_null($id) ) {
             return $this->error('未获取到ID信息');
        }

        // 获取要冻结的对象
        $Term = Term::get($id);

        // 要激活的对象不存在
        if (is_null($Term)) {
            return $this->error('不存在id为' . $id . '的学期，删除失败');
        }

        //将冻结的学期生效值改为0
        $Term->effect = 0;

        //保存   
        $Term->validate(true)->save();
       
       return $this->success('冻结'.$Term->name.'成功',url('index'));
    }
}