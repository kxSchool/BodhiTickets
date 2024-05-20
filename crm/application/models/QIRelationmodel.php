<?php
//////////////////////////////////////////////////////////////////////
// 章爱军(永远的大牛)                                               //
// Trial License: For evaluation only!                              //
// (c) 2018, ZhangAijun, http://www.mydeershow.com                  //
//////////////////////////////////////////////////////////////////////

class QIRelationmodel extends CI_Model {
    
    /**
     * 根据品牌或厂商获取供货商信息
     * @param string $brandname 品牌
     * @return array 供货商信息
     */
    public function getSupplierByBrandName($brandname=''){
       if(empty($brandname)){
            return [];
        }else{
            $this->purchaseslave->where(' brandname=\''.$brandname.'\'');
        }
        $this->purchaseslave->order_by(' q_shop_id ASC ');
        $this->purchaseslave->from('q_i_relation');
        $query = $this->purchaseslave->get();
        $result = $query->result_array();
        return empty($result) ? [] : $result;
    }
    
    /**
     * 根据店铺id获取店铺能寻报价的品牌信息
     * @param type $shopid
     * @return type
     */
    public function getBrandNameByShopId($shopid=0){
        if(empty($shopid)){
            return [];
        }
        $searchSql = 'SELECT * FROM q_i_relation WHERE q_shop_id='.$shopid.' OR s_shop_id='.$shopid.' '
                . 'ORDER BY id ASC ';
        $result = $this->purchaseslave->query($searchSql)->result_array();
        return empty($result) ? [] : $result;
    }

}