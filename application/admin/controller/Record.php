<?php
// +----------------------------------------------------------------------
// | Description: 系统用户
// +----------------------------------------------------------------------
// | Author: linchuangbin <linchuangbin@honraytech.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

class Record extends ApiCommon
{

    public function index()
    {   
        $recordModel = model('Record');
        $param = $this->param;
        $keywords = !empty($param['keywords']) ? $param['keywords']: '';
        $page = !empty($param['page']) ? $param['page']: '';
        $limit = !empty($param['limit']) ? $param['limit']: '';    
        $data = $recordModel->getDataList($keywords, $page, $limit);
        return resultArray(['data' => $data]);
    }

    public function read()
    {
        $recordModel = model('Record');
        $param = $this->param;
        $data = $recordModel->getDataById($param['id']);
        if (!$data) {
            return resultArray(['error' => $recordModel->getError()]);
        } 
        return resultArray(['data' => $data]);
    }

    public function save()
    {
        $recordModel = model('Record');
        $param = $this->param;
        $data = $recordModel->createData($param);
        if (!$data) {
            return resultArray(['error' => $recordModel->getError()]);
        }
        return resultArray(['data' => 'Add success']);
    }

    public function update()
    {
        $recordModel = model('Record');
        $param = $this->param;
        $data = $recordModel->updateDataById($param, $param['id']);
        if (!$data) {
            return resultArray(['error' => $recordModel->getError()]);
        } 
        return resultArray(['data' => 'Update success']);
    }

    public function delete()
    {
        $recordModel = model('Record');
        $param = $this->param;
        $data = $recordModel->delDataById($param['id']);
        if (!$data) {
            return resultArray(['error' => $recordModel->getError()]);
        } 
        return resultArray(['data' => 'Delete success']);
    }

    public function deletes()
    {
        $recordModel = model('Record');
        $param = $this->param;
        $data = $recordModel->delDatas($param['ids']);
        if (!$data) {
            return resultArray(['error' => $recordModel->getError()]);
        } 
        return resultArray(['data' => 'Delete success']);
    }

    public function enables()
    {
        $recordModel = model('Record');
        $param = $this->param;
        $data = $recordModel->enableDatas($param['ids'], $param['status']);
        if (!$data) {
            return resultArray(['error' => $recordModel->getError()]);
        } 
        return resultArray(['data' => 'Successful operation']);
    }
    
}
 