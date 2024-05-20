<?php

class SupplierBrandmodel extends CI_Model {

    // 保存供货商对应关系信息
    public function saveSupplierBrandInfo($data){
        if(isset($data) && !empty($data)){
            if($this->master->insert('supplier_brand',$data)){
                return TRUE;
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }
    
    // 
    public function getSupplierInfoBySSBId($suppliersellerbrandid=0){
        if(empty($suppliersellerbrandid)){
            return [];
        }
        // 语句
        $searchSql = 'SELECT * FROM supplier_brand '
                . 'WHERE id='.$suppliersellerbrandid;
        $supplierres = $this->slave->query($searchSql)->result_array();
        if(empty($supplierres[0])){
            return [];
        }
        //首先根据会员的id，判定需要查询哪个会员表
        $maxNUmber = $this->config->item('max_members');//每张用户表最大存储记录数
        $userTableName = 'members'.ceil($supplierres[0]['shopid']/$maxNUmber);
        // 查询会员信息
        $searchUserSql = 'SELECT * FROM '.$userTableName.' WHERE userid='.$supplierres[0]['shopid'];
        $userres = $this->slave->query($searchUserSql)->result_array();
        if(empty($userres[0])){
            return [];
        }
        // 合并数组
        return array_merge($supplierres[0],$userres[0]);
    }
}
