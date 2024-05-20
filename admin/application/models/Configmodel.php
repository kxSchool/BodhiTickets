<?php

class Configmodel extends CI_Model {
    /*
     * 根据配置项名，得到配置value
     */
    public function getConfigByName($name){
        $this->slave->where('name', $name);
        $this->slave->from('config');
        $query = $this->slave->get();
        $result = $query->row_array();
        return !empty($result) ? $result : '';
    }
    /*
     * 根据配置项名，更新配置项信息
     */
    public function saveConfigByName($name,$data){
        $saveData = array(
            'value' => $data,
        );
        $this->master->where('name', $name);
        $this->master->update('config', $saveData);
        return true;
    }
}
