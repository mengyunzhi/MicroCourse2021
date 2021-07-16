<?php
namespace app\common\validate;
use think\Validate;

class Student extends Validate
{
    protected $rule = [
    	'name'  => 'require|length:2,25',
    	'sex' => 'in:0,1',
        'email' => 'email',
        'klass_id' => 'require|length:1,25',
        'number' => 'require|length:6,7'
    ];
}