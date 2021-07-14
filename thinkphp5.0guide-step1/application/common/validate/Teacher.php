<?php
namespace app\common\validate;
use think\Validate;

class Teacher extends Validate
{
    protected $rule = [
    	'name'  => 'require|length:2,25',
    	'sex' => 'in:0,1',
    	'number' => 'require|unique:teacher|length:2,11',
        'email' => 'email'
    ];
}