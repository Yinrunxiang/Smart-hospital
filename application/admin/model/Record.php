<?php
// +----------------------------------------------------------------------
// | Description: 用户
// +----------------------------------------------------------------------
// | Author: GBMS-SMART
// +----------------------------------------------------------------------

namespace app\admin\model;

use think\Db;
use app\admin\model\Common;
use com\verify\HonrayVerify;

class Record extends Common
{

    protected $name = 'record';


    /**
     * [getDataList 列表]
     * @AuthorHTL
     * @DateTime  2017-02-10T22:19:57+0800
     * @param     [string]                   $keywords [关键字]
     * @param     [number]                   $page     [当前页数]
     * @param     [number]                   $limit    [t每页数量]
     * @return    [array]                             [description]
     */
    public function getDataList($keywords, $page, $limit)
    {
        $map = [];
        //根据keywords筛选信息
        if ($keywords) {
            $map['record.id|patient.name|doctor.name'] = ['like', '%' . $keywords . '%'];
        }
        $dataCount = $this
            ->where($map)
            ->alias('record')
            ->join('user patient', 'record.patient=patient.user_id', 'LEFT')
            ->join('user doctor', 'record.doctor=doctor.user_id', 'LEFT')
            ->count('patient.id');

        $list = $this
            ->where($map)
            ->alias('record')
            ->join('user patient', 'record.patient=patient.user_id', 'LEFT')
            ->join('user doctor', 'record.doctor=doctor.user_id', 'LEFT');

        // 若有分页
        if ($page && $limit) {
            $list = $list->page($page, $limit);
        }

        $list = $list
            ->field('record.*,patient.name as patient_name,doctor.name as doctor_name')
            ->select();

        $data['list'] = $list;
        $data['dataCount'] = $dataCount;

        return $data;
    }
    public function createData($param)
    {
        // 验证
        $validate = validate($this->name);
        if (!$validate->check($param)) {
            $this->error = $validate->getError();
            return false;
        }
        try {
            $this->data($param)->allowField(true)->save();
            return true;
        } catch(\Exception $e) {
            $this->error = 'Add failure';
            return false;
        }
    }

}