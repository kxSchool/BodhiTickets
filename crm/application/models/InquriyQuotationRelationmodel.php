<?php
//////////////////////////////////////////////////////////////////////
// 章爱军(永远的大牛)                                               //
// Trial License: For evaluation only!                              //
// (c) 2018, ZhangAijun, http://www.mydeershow.com                  //
//////////////////////////////////////////////////////////////////////

class InquriyQuotationRelationmodel extends CI_Model {
    /**
     * 批量添加询价单列表
     * @param array $data 询价单信息
     * @return boolean true表示添加成功,否则失败
     */
    public function batchAddData($data=[]){
        if(empty($data)){
            return false;
        }
        $flag = $this->purchasemaster->insert_batch('inquriy_quotation_relation',$data);
        return $flag ? true : false;
    }
    
    public function getSupplierByInquiryCode($inquirycode=''){
        if(empty($inquirycode)){
            return [];
        }
        $this->purchaseslave->where('inquirycode',$inquirycode);
        $this->purchaseslave->from('inquriy_quotation_relation');
        $query = $this->purchaseslave->get();
        $result = $query->result_array();
        return !empty($result) ? $result : [];
    }
    
    public function getSupplierPermissionInfo($inquirycode='',$shopid=0){
        if(empty($inquirycode) || empty($shopid)){
            return [];
        }
        $this->purchaseslave->where('inquirycode',$inquirycode);
        $this->purchaseslave->where('shoperid',$shopid);
        $this->purchaseslave->from('inquriy_quotation_relation');
        $query = $this->purchaseslave->get();
        $result = $query->result_array();
        return !empty($result[0]) ? $result[0] : [];
    }
    
    public function updateIQRStatus($data=[]){
        if(empty($data['id'])){
            return false;
        }
        $this->purchasemaster->where('id',$data['id']);
        $flag = $this->purchasemaster->update('inquriy_quotation_relation', $data);
        return $flag ? true : false;
    }
    

}