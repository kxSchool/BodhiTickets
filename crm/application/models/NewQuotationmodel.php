<?php
//////////////////////////////////////////////////////////////////////
// 章爱军(永远的大牛)                                               //
// Trial License: For evaluation only!                              //
// (c) 2018, ZhangAijun, http://www.mydeershow.com                  //
//////////////////////////////////////////////////////////////////////

class NewQuotationmodel extends CI_Model {
    /**
     * 根据询价单批次号和报价单批次号获取询价单信息
     * @param string $inquirybatchcode 询价单批次号
     * @param string $offerbatchcode 报价单批次号
     * @return array 返回询价单信息
     */
    public function getInquiryOfferInfoByInquiryBatchcode($inquirybatchcode='',$offerbatchcode=''){
       if(empty($inquirybatchcode)){
            return [];
        }else{
            $this->purchaseslave->where(' inquiry_batchcode=\''.$inquirybatchcode.'\'');
        }
        if(!empty($offerbatchcode)){
            $this->purchaseslave->where(' batchcode=\''.$offerbatchcode.'\'');
        }
        $this->purchaseslave->order_by(' shopid DESC ');
        $this->purchaseslave->from('new_quotation');
        $query = $this->purchaseslave->get();
        $result = $query->result_array();
        return empty($result) ? [] : $result;
    }
    
    
    public function getInquiryOfferInfoByInquiryCode($inquirycode='',$offercode=''){
        if(empty($inquirycode)){
            return [];
        }
        $searchSql = 'SELECT iqr.shoperid,iqr.staffid,iqr.status,nq.* FROM inquriy_quotation_relation iqr,new_quotation nq '
                . 'WHERE iqr.inquirycode=\''.$inquirycode.'\' AND iqr.id=nq.iqrid '
                .(empty($offercode)? '': ' AND nq.batchcode=\''.$offercode.'\' ')
                . 'ORDER BY nq.shopid ASC ';
        $data = $this->purchaseslave->query($searchSql)->result_array();
        return empty($data) ? [] : $data;
    }
    
    /**
     * 批量添加询价单列表
     * @param array $data 询价单信息
     * @return boolean true表示添加成功,否则失败
     */
    public function batchAddQuotationList($data=[]){
        if(empty($data)){
            return false;
        }
        $flag = $this->purchasemaster->insert_batch('new_quotation',$data);
        return $flag ? true : false;
    }

}