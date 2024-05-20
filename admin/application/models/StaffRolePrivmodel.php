<?php

class StaffRolePrivmodel extends CI_Model {
    /*
     * 根据privid得到表中记录值
     */
    public function getRolePrivByPrivid($privid){
        $this->crmslave->where('privid',$privid);
        $this->crmslave->from('staff_role_priv');
        $query = $this->crmslave->get();
        $result = $query->result_array();
        return !empty($result) ? $result : '';
    }
    /*
     * 根据roleid得到表中记录值
     */
    public function getRolePrivByRoleid($roleid){
        $this->crmslave->where('roleid',$roleid);
        $this->crmslave->from('staff_role_priv');
        $query = $this->crmslave->get();
        $result = $query->result_array();
        return !empty($result) ? $result : '';
    }
    /*
     * 根据角色id，删除角色对应的权限
     */
    public function delRolePrivByRoleid($roleid){
        $this->crmmaster->where('roleid',$roleid);
        $this->crmmaster->from('staff_role_priv');
        $result = $this->crmmaster->delete();
        if($result){
            return true;
        }else{
            return false;
        }
    }
    /*
     * 批量给角色分配权限
     */
    public function batchInsertRolePriv($data){
        $result = $this->crmmaster->insert_batch('staff_role_priv', $data);
        if($result){
            return true;
        }else{
            return false;
        }
    }
    /*
     * 根据权限节点id，删除角色对应的权限
     */
    public function delRolePrivByPrivid($privid){
        $this->crmmaster->where('privid',$privid);
        $this->crmmaster->from('staff_role_priv');
        $result = $this->crmmaster->delete();
        if($result){
            return true;
        }else{
            return false;
        }
    }
}
