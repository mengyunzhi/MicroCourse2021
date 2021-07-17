<?php
namespace app\common\validate;
use think\Validate;

class Room extends Validate
{
    protected $rule = [
    	'name' => 'require|length:2,25',
    	'num' => 'require',
    	'mid' => 'require',
    ];
}