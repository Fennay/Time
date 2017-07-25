<?php
/**
 * Created by PhpStorm.
 * User: Fennay
 * Date: 2016/9/2
 * Time: 14:34
 */

namespace Fny;


class Time
{
    /**
     * @var 当前时间
     */
    protected $nowTime = 0;

    /**
     * @var int 时间差
     */
    protected $diffTime = 0;

    /**
     * @var int 输入的时间
     */
    protected $time = 0;


    /**
     * Time constructor.构造函数
     */
    public function __construct()
    {
        $this->nowTime = time();
    }



    /**
     * 获取当前时间
     *
     * @param string $type
     * @return bool|当前时间|int|string
     */
    public function getNowTime($type = '')
    {
        if (!empty($type)) {
            return date($type, $this->nowTime);
        }

        return $this->nowTime;
    }

    /**
     * 格式化时间
     *
     * @param        $time
     * @param string $type
     * @return bool|string
     */
    public function normal($time)
    {
        //判断数据是否为空
        $this->checkTime($time);

        $this->time = $time;
        $dTime = $this->getDiffTime();
        $dYear = $this->getDiffYear();
        $dDay = $this->getDiffDay();

        if ($dTime < 10) {
            return '刚刚';
        }

        if ($dTime < 60) {
            return intval(floor($dTime / 10) * 10) . "秒前";
        }

        if ($dTime < 3600) {
            return intval($dTime / 60) . "分钟前";
        }

        if ($dYear == 0 && $dDay == 0) {
            return date('今天H:i', $time);
        }

        if ($dYear == 0) {
            return date("今年m月d日 H:i", $time);
        }

        return $this->getFullTime($time);
    }


    /**
     * @param $time  模糊数据
     * @return string
     */
    public function mohu($time)
    {
        //判断数据是否为空
        $this->checkTime($time);

        $this->time = $time;
        $dTime = $this->getDiffTime();
        $dDay = $this->getDiffDay();

        if ($dTime < 60) {
            return $dTime . "秒前";
        }
        if ($dTime < 3600) {
            return intval($dTime / 60) . "分钟前";
        }
        if ($dTime >= 3600 && $dDay == 0) {
            return intval($dTime / 3600) . "小时前";
        }
        if ($dDay > 0 && $dDay <= 7) {
            return intval($dDay) . "天前";
        }
        if ($dDay > 7 && $dDay <= 30) {
            return intval($dDay / 7) . '周前';
        }
        if ($dDay > 30) {
            return intval($dDay / 30) . '个月前';
        }
    }

    /**
     * @return 当前时间|int 获取时间差
     */
    protected function getDiffTime()
    {
        return $this->nowTime - $this->time;
    }

    /**
     * @return int 获取年数时间差
     */
    protected function getDiffYear()
    {
        return intval(date("Y", $this->nowTime)) - intval(date("Y", $this->time));
    }

    /**
     * @return int 获取天数时间差
     */
    protected function getDiffDay()
    {
        return intval(date("z", $this->nowTime)) - intval(date("z", $this->time));
    }


    /**
     * 检测数据是否为空
     * @param $time
     * @return mixed
     */
    protected function checkTime($time)
    {
        if(empty($time)){
            return $time;
        }
    }

    /**
     * 获取完整的时间
     *
     * @param $time
     * @return bool|string
     */
    protected function getFullTime($time)
    {
        return date('Y-m-d H:m:s', $time);
    }
    
    /**
     * 计算当前时间距离明天的秒数
     * @return false|int
     * Author: Fengguangyong
     */
    public function toTomorrowSec(){
        $nowTime = time();
        $tomTime = strtotime(date('Y-m-d',strtotime("+1 day")));
        return $tomTime - $nowTime;
    }


}
