<?php
namespace app\common\model;
use think\model;
/**
 * 
 */
class KlassCourse extends Model
{
	/**
	* 获取教室对象
	*/
	public function room() {
		return $this->belongsto('room');
	}

	/**
	* 获取教室对象
	*/
	public function course() {
		return $this->belongsto('course');
	}
	/**
     * 获取要显示的创建时间
     * @param  int $value 时间戳
     * @return string  转换后的字符串
     * @author panjie <panjie@yunzhiclub.com>
     */
    public function getCreateTimeAttr($value)
    {
        return date('Y-m-d', $value);
    }
	
}