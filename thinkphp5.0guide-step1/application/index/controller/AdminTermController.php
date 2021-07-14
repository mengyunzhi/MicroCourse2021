<?php
namespace app\index\controller;
use think\Request;  
use think\Controller;
use app\common\model\Term;

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
    	$Terms= $Term->where('name', 'like', '%' . $name . '%')->paginate($pageSize, false, [
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
       $message = '';  // 提示信息

            // 接收传入数据
            $postData = Request::instance()->post();    
               
                        // 实例化空对象
            $term = new term();
           
           $time1=strtotime($postData['create_time']);
           $time2=strtotime($postData['end_time']);

            // 为对象赋值
            $term->name = $postData['name'];
            $term->create_time = $time1;
            $term->end_time = $time2;
            $term->effect = $postData['effect'];
            // 新增对象至数据表
            $result = $term->save();
            
            // 反馈结果
            if (false === $result)
            {
                // 验证未通过，发生错误
                $message = '新增失败:' . $term->getError();
            } else {
                // 提示操作成功，并跳转至管理列表
                return $this->success('学期' . $term->name . '新增成功。', url('index'));
            } 
     
    }

     public function edit()
    {
    return $this->fetch();
    }


    //激活学期
    public function activate()
    {


    }

    //冻结学期
    public function frozen()
    {


    }
}