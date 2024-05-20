<?php

class StaffRolemodel extends CI_Model {
    //角色列表
    public function rolelist($data){
        $result = array();
        $this->crmslave->order_by($data['order']);
        $this->crmslave->limit($data['limit'],$data['offset']);
        $this->crmslave->from('staff_role');
        $query = $this->crmslave->get();
        $result['rows'] = $query->result_array();
        $query->free_result();

        $this->crmslave->from('staff_role');
        $query = $this->crmslave->get();
        $result['total'] = $query->num_rows();
        $query->free_result();
        return $result;
    }
    //得到所有管理员角色
    public function getAllRole(){
        $this->crmslave->from('staff_role');
        $query = $this->crmslave->get();
        $result = $query->result_array();
        return $result;
    }
    //保存角色
    public function saveRole($data){
        $roleid = isset($data['roleid']) ? $data['roleid'] : 0;
        if(isset($data['roleid'])){
            unset($data['roleid']);
        }
        if($roleid){
            $this->crmmaster->where('roleid',$roleid);
            if($this->crmmaster->update('staff_role', $data)){
                return true;
            }else{
                return false;
            }
        }else{
            if($this->crmmaster->insert('staff_role', $data)){
                return $this->crmmaster->insert_id();
            }else{
                return false;
            }
        }
    }
    //通过角色id得到角色信息
    public function getRoleById($roleid,$flag=false){
        if(empty($roleid) || !is_array($roleid)){
            return [];
        }
        $this->crmslave->where_in('roleid',$roleid);
        $this->crmslave->from('staff_role');
        $query = $this->crmslave->get();
        $result = $query->result_array();
        if(empty($result[0])){
            return [];
        }else{
            if($flag){
                $returndata = [];
                foreach($result as $reskey=>$resval){
                    if(!array_key_exists($resval['roleid'], $returndata)){
                        $returndata[$resval['roleid']] = $resval;
                        continue;
                    }
                }
                return $returndata;
            }
            return $result[0] ;
        }
        return !empty($result) ? $result : '';
    }
    //根据角色id删除角色
    public function delRoleById($roleid){
        $this->crmmaster->where('roleid',$roleid);
        $this->crmmaster->from('staff_role');
        $result = $this->crmmaster->delete();
        if($result){
            return true;
        }else{
            return false;
        }
    }
}
