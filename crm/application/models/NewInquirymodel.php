<?php
//////////////////////////////////////////////////////////////////////
// 章爱军(永远的大牛)                                               //
// Trial License: For evaluation only!                              //
// (c) 2018, ZhangAijun, http://www.mydeershow.com                  //
//////////////////////////////////////////////////////////////////////

class NewInquirymodel extends CI_Model {
    
    /*
     * 询价单列表
     */
    public function getlist($param){
        $where = '';
        // 询价单状态
        if(isset($param['inquirystatus']) && in_array($param['inquirystatus'],[1,2,3,4])){
            $where .= 'status='.$param['inquirystatus'].' AND ';
        }
        // 询价单号
        if(!empty($param['inquirycode'])){
            $where .= 'inquirycode='.$param['inquirycode'].' AND ';
        }
        // 联系人电话
//        if(!empty($param['telphone'])){
//            $where .= 'shippingmobile='.$param['telphone'].' AND ';
//        }
        // 时间节点计算
        if(!empty($param['starttime'])){
            $where .= 'addtime > '.$param['starttime'].' AND ';
        }
        if(!empty($param['endtime'])){
            $where .= 'addtime < '.$param['endtime'].' AND ';
        }
        if(!empty($param['brandname'])){
            $brandstr = '';
            foreach ($param['brandname'] as $bdkey=>$bdval){
                if(!empty($bdval)){
                    $brandstr .= '\''.$bdval.'\',';
                }
            }
            $where .= ' brandname IN('.trim($brandstr,',').') AND ';
        }else{
            return ['rows'=>[],'total'=>0];
        }
        $where = trim($where,'AND ');
        // 查询总条数
        if(!empty($where)){
            $where = ' WHERE '.$where;
        }
        $countSql = 'SELECT DISTINCT(inquirycode) FROM new_inquiry'
                . $where;
        $countres = $this->purchaseslave->query($countSql)->result_array();
        // 分页获取
        if(empty($countres) || empty($countres[$param['offset']])){
            return ['rows'=>[],'total'=>count($countres)];
        }
        
        if(empty($countSql[($param['offset']-1+$param['limit'])])){
           $inquirydata = array_slice($countres, $param['offset']);
        }else{
           $inquirydata = array_slice($countres, $param['offset'],($param['offset']-1+$param['limit']));
        }
        
        // 
        $where = implode(',', array_column($inquirydata, 'inquirycode'));
        if(empty($where)){
            return ['rows'=>[],'total'=>count($countres)];
        }
        $where = ' WHERE inquirycode IN('.$where.')';
        $searchSql = 'SELECT * FROM new_inquiry'
                . $where
                . ' ORDER BY id DESC';
        $inqres = $this->purchaseslave->query($searchSql)->result_array();
        if(!empty($inqres)){
            return ['rows'=>$inqres,'total'=>count($countres)];
        }else{
            return ['rows'=>[],'total'=>count($countres)];
        }
    }
    
    /*
     * 询价单列表
     */
//    public function getofferlist($param){
//        $where = '';
//        // 询价单状态
//        if(isset($param['inquirystatus']) && in_array($param['inquirystatus'],[1,2,3,4])){
//            $where .= 'status='.$param['inquirystatus'].' AND ';
//        }
//        // 询价单号
//        if(!empty($param['inquirycode'])){
//            $where .= 'inquirycode='.$param['inquirycode'].' AND ';
//        }
//        // 联系人电话
////        if(!empty($param['telphone'])){
////            $where .= 'shippingmobile='.$param['telphone'].' AND ';
////        }
//        // 时间节点计算
//        if(!empty($param['starttime'])){
//            $where .= 'addtime > '.$param['starttime'].' AND ';
//        }
//        if(!empty($param['endtime'])){
//            $where .= 'addtime < '.$param['endtime'].' AND ';
//        }
//        if(!empty($param['brandname'])){
//            $brandstr = '';
//            foreach ($param['brandname'] as $bdkey=>$bdval){
//                if(!empty($bdval)){
//                    $brandstr .= '\''.$bdval.'\',';
//                }
//            }
//            $where .= ' brandname IN('.trim($brandstr,',').') AND ';
//        }
//        $where = trim($where,'AND ');
//        // 查询总条数
//        if(!empty($where)){
//            $where = ' WHERE '.$where;
//        }
//        $countSql = 'SELECT DISTINCT(inquirycode) FROM new_inquiry'
//                . $where
//                . ' ORDER BY id DESC';
//        $countres = $this->purchaseslave->query($countSql)->result_array();
//        // 分页获取
//        if(empty($countres) || empty($countres[$param['offset']])){
//            return ['rows'=>[],'total'=>count($countres)];
//        }
//        
//        if(empty($countSql[($param['offset']-1+$param['limit'])])){
//           $inquirydata = array_slice($countres, $param['offset']);
//        }else{
//           $inquirydata = array_slice($countres, $param['offset'],($param['offset']-1+$param['limit']));
//        }
//        
//        // 
//        $where = implode(',', array_column($inquirydata, 'inquirycode'));
//        if(empty($where)){
//            return ['rows'=>[],'total'=>count($countres)];
//        }
//        $where = ' WHERE inquirycode IN('.$where.')';
//        $searchSql = 'SELECT * FROM new_inquiry'
//                . $where
//                . ' ORDER BY id DESC';
//        $inqres = $this->purchaseslave->query($searchSql)->result_array();
//        if(!empty($inqres)){
//            return ['rows'=>$inqres,'total'=>count($countres)];
//        }else{
//            return ['rows'=>[],'total'=>count($countres)];
//        }
//    }
    
    /*
     * 根据询价单号获取询价单信息
     */
    public function getDetailByInquiryCode($inquirycode=''){
        if(empty($inquirycode)){
            return [];
        }
        $this->purchaseslave->where('inquirycode',$inquirycode);
        $this->purchaseslave->from('new_inquiry');
        $query = $this->purchaseslave->get();
        $result = $query->result_array();//row_array();
        return !empty($result) ? $result : [];
    }
    
    /**
     * 批量添加询价单列表
     * @param array $data 询价单信息
     * @return boolean true表示添加成功,否则失败
     */
    public function batchAddInquiryList($data=[]){
        if(empty($data)){
            return false;
        }
        $flag = $this->purchasemaster->insert_batch('new_inquiry',$data);
        return $flag ? true : false;
    }
    
    /**
     * 报价信息修改
     * @param string $inquirycode 询价单号
     * @param string $offerbatchcode 报价单批次号
     * @return boolean true表示修改成功否则失败
     */
    public function updateInquiryQuoting($inquirycode='',$offerbatchcode=''){
        if(empty($inquirycode) || empty($offerbatchcode)){
            return false;
        }
        // 修改询价单
        $this->purchasemaster->trans_start(); // 开启事务
        
        $this->purchasemaster->where('inquirycode',$inquirycode);
        $flag1 = $this->purchasemaster->update('new_inquiry', ['quotation_batchcode'=>$offerbatchcode,'status'=>2]);
        
        $this->purchasemaster->where('inquirycode',$inquirycode);
        $flag2 = $this->purchasemaster->update('inquriy_quotation_relation', ['status'=>2]);
        
        if($flag1 && $flag2){
            $this->purchasemaster->trans_commit();
            return true;
        }
        
        $this->purchasemaster->trans_rollback();
        return false;
    }
    
    /**
     * 取消询价单
     * @param string $inquirycode 询价单号
     * @return boolean true表示修改成功否则失败
     */
    public function updateInquiryToBeCancelStatus($inquirycode=''){
        if(empty($inquirycode)){
            return false;
        }
        $this->purchasemaster->trans_start(); // 开启事务
        // 修改询价单
        $this->purchasemaster->where('inquirycode',$inquirycode);
        $flag1 = $this->purchasemaster->update('new_inquiry', ['status'=>3]); // 询价单状态{1:待报价,2:已报价,3:已作废,4:待处理}
        
        $this->purchasemaster->where('inquirycode',$inquirycode);
        $flag2 = $this->purchasemaster->update('inquriy_quotation_relation', ['status'=>3]); // 询价单状态{1:待报价,2:已报价,3:无需报价}
        
        if($flag1 && $flag2){ // 写入都成功提交事务
           $this->purchasemaster->trans_commit();
           return true;
        }
        $this->purchasemaster->trans_rollback();
        return false ;
    }
    
    /**
     * 根据询价单号和询价单批次号获取询价单详情
     * @param type $inquirycode
     * @param type $inquirybatchcode
     * @return type
     */
    public function getInquiryStatusByInquiryCodeAndBatchCode($inquirycode=''){
        if(empty($inquirycode)){
            return [];
        }
        $searchSql = 'SELECT status,batchcode AS ibatchcode,quotation_batchcode AS qbatchcode,'
                . 'memeberid AS bayerid FROM new_inquiry WHERE '
                . 'inquirycode=\''.$inquirycode.'\' ORDER BY id ASC LIMIT 1 ';
        $data = $this->purchaseslave->query($searchSql)->result_array();
        return empty($data[0]) ? [] : $data[0];
    }
    
    /**
     * 更新指定询价单为指定状态
     * @param string $inquirycode 询价单状态
     * @param int $status 询价单状态(询价单状态{1:待报价,2:已报价,3:已作废,4:待处理:5:已超时(24小时)})
     * @return boolean
     */
    public function updateInquiryListStatusToTakeStatus($inquirycode='',$status=1){
        if(empty($inquirycode) || !in_array($status, [1,2,3,4,5])){
            return false;
        }
        $this->purchasemaster->where('inquirycode',$inquirycode);
        $flag = $this->purchasemaster->update('new_inquiry', ['status'=>$status]); // 询价单状态{1:待报价,2:已报价,3:已作废,4:待处理}
        return $flag ? true : false;
    }

}