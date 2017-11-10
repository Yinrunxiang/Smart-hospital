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

class Medicine extends Common
{

    protected $name = 'medicine';
    protected $createTime = 'create_time';
    protected $updateTime = false;
    protected $autoWriteTimestamp = true;
    protected $insert = [
        'status' => 1,
    ];

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
            $map['medicine_id|medicine_name'] = ['like', '%' . $keywords . '%'];
        }

        $dataCount = $this->alias('medicine')->where($map)->count('id');

        $list = $this
            ->where($map)
            ->alias('medicine');


        // 若有分页
        if ($page && $limit) {
            $list = $list->page($page, $limit);
        }

        $list = $list
            ->field('medicine.*')
            ->select();

        $data['list'] = $list;
        $data['dataCount'] = $dataCount;

        return $data;
    }


    /**
     * 创建药品信息
     * @param  array $param [description]
     */
    public function createData($param)
    {
        // 验证
        $validate = validate($this->name);
        if (!$validate->check($param)) {
            $this->error = $validate->getError();
            return false;
        }

        $this->startTrans();
        try {
            $this->data($param)->field(true)->save();
            $this->commit();
            return true;
        } catch (\Exception $e) {
            $this->rollback();
            $this->error = 'Add failure';
            return false;
        }
    }

    /**
     * 通过id修改信息
     * @param  array $param [description]
     */
    public function updateDataById($param, $medicine_id)
    {
        $checkData = $this->get($medicine_id);
        if (!$checkData) {
            $this->error = 'This data is not available';
            return false;
        }
        $this->startTrans();

        try {

            $this->allowField(true)->save($param, ['medicine_id' => $medicine_id]);
            $this->commit();
            return true;

        } catch (\Exception $e) {
            $this->rollback();
            $this->error = 'Update failure';
            return false;
        }
    }


}