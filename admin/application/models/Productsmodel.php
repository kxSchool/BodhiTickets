<?php

class Productsmodel extends CI_Model {

    /*
     *根据商铺会员id，和库存开始时间、结束时间得到库存中的一条记录
     */
    public function getProductsBysellerIdAndBetweenTime($seller_id,$start_time,$end_time){
        $result = array();
        $this->slave->where('seller_id',$seller_id);
        $this->slave->where('start_time >=',$start_time);
        $this->slave->where('end_time <=',$end_time);
        $this->slave->from('products');
        $query = $this->slave->get();
        $result = $query->row_array();
        return $result;
    }
    /*
    *根据商铺会员id，和库存开始时间、结束时间得到库存中的一条记录
    */
    public function getManyProductsBysellerIdAndBetweenTime($seller_id,$start_time,$end_time){
        $result = array();
        $this->slave->where('seller_id',$seller_id);
        $this->slave->where('start_time >=',$start_time);
        $this->slave->where('end_time <=',$end_time);
        $this->slave->from('products');
        $query = $this->slave->get();
        $result = $query->result_array();
        return $result;
    }
    /*
     * 批量添加商铺服务时间
     */
    public function batchAddProducts($data){
        return $this->master->insert_batch('products', $data);
    }
    /*
     * 根据商铺ID和日期，获取该商铺在这个日期内的时间安排
     */
    public function getProductsBysellerIdAndTime($seller_id,$whichDay){
        $result = array();
        $t = $whichDay;
        $start_time = mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t));
        $end_time = mktime(23,59,59,date("m",$t),date("d",$t),date("Y",$t));
        $this->slave->where('seller_id',$seller_id);
        $this->slave->where('start_time >=',$start_time);
        $this->slave->where('end_time <=',$end_time);
        $this->slave->order_by('start_time', 'ASC');
        $this->slave->from('products');
        $query = $this->slave->get();
        $result = $query->result_array();
        return $result;
    }
    /*
     * 根据product_id，删除服务时间段
     */
    public function deleteProductById($product_id){
        $this->master->where('product_id', $product_id);
        if($this->master->delete('products')){
            return true;
        }else{
            return false;
        }
    }
    /*
     * 根据produt_id数组，判断服务时间段是否过期或已预约过
     */
    public function judgeProductExpiredByProductIds($productIds){
        if(!is_array($productIds)){
            return false;
        }else{
            $this->master->where_in('product_id', $productIds);
            $this->slave->from('products');
            $query = $this->slave->get();
            $result = $query->result_array();
            foreach($result as $v){
                if($v['start_time'] < time() || $v['product_number'] == 0){
                    break;
                    return false;
                }
            }
            return true;
        }
    }
    /*
     * 根据product_id，将库存设置为0
     */
    public function setProductNumberZero($product_id){
        $this->master->where('product_id',$product_id);
        $data['product_number'] = 0;
        if($this->master->update('products', $data)){
            return true;
        }else{
            return false;
        }
    }
    /*
     * 根据product_id，将库存设置为1
     */
    public function setProductNumberOne($product_id){
        $this->master->where('product_id',$product_id);
        $data['product_number'] = 1;
        if($this->master->update('products', $data)){
            return true;
        }else{
            return false;
        }
    }
    /*
     * 根据product_id，得到服务时间信息
     */
    public function getProductsById($product_id){
        $this->slave->where('product_id',$product_id);
        $this->slave->from('products');
        $query = $this->slave->get();
        $result = $query->row_array();
        return !empty($result) ? $result : '';
    }

}
