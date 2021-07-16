<?php
namespace app\common\validate;
use think\Validate;

class Seat extends Validate
{
    protected $rule = [
    	'x' => 'require',
    	'y' => 'require',
    	'mid' => 'require',
    ];
}