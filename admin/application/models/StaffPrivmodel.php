<?php

class StaffPrivmodel extends CI_Model {

    /*
     * 根据ac查找权限记录
     */
    public function getPrivByca($data){
        $this->crmslave->where($data);
        $query = $this->crmslave->get("staff_priv");
        $result = $query->row_array();
        return !empty($result) ? $result : '';
    }
    /*
     * 根据节点id得到节点信息
     */
    public function getPrivById($privid){
        $this->crmslave->where('privid',$privid);
        $query = $this->crmslave->get("staff_priv");
        $result = $query->row_array();
        return !empty($result) ? $result : '';
    }
    /*
     * 根据privid节点数组得到记录
     */
    public function getPrivByPrivids($privids){
        $this->crmslave->where('disabled',1);
        $this->crmslave->where_in('privid',$privids);
        $query = $this->crmslave->get("staff_priv");
        $result = $query->result_array();
        return !empty($result) ? $result : '';
    }
    /*
     * 得到所有权限节点
     */
    public function getAllPriv(){
        $query = $this->crmslave->get("staff_priv");
        $result = $query->result_array();
        return !empty($result) ? $result : '';
    }
    /*
     * 根据privid，得到直接下级节点
     */
    public function getChildPrivById($privid){
        $this->crmslave->where('parentid',$privid);
        $query = $this->crmslave->get("staff_priv");
        $result = $query->result_array();
        return !empty($result) ? $result : '';
    }
    /*
     * 根据privid删除节点
     */
    public function delPrivById($privid){
        $this->crmmaster->where('privid',$privid);
        $this->crmmaster->from('staff_priv');
        $result = $this->crmmaster->delete();
        if($result){
            return true;
        }else{
            return false;
        }
    }
    //保存权限节点
    public function savePriv($data){
        $privid = isset($data['privid']) ? $data['privid'] : 0;
        if(isset($data['priv'])){
            unset($data['priv']);
        }
        if($privid){
            $this->crmmaster->where('privid',$privid);
            if($this->crmmaster->update('staff_priv', $data)){
                return true;
            }else{
                return false;
            }
        }else{
            if($this->crmmaster->insert('staff_priv', $data)){
                return true;
            }else{
                return false;
            }
        }
    }
}
