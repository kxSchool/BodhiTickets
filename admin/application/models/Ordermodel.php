<?php

class Ordermodel extends CI_Model {
    /*
     * 订单列表
     */
    public function orderlist($data){
        $result = array();
        if(isset($data['whereZiXun']) && !empty($data['whereZiXun'])){
            //查找库存表
            foreach($data['whereZiXun'] as $k=>$v){
                $this->slave->where($k,$v);
            }
            $this->slave->select('product_id');
            $this->slave->from('products');
            $query = $this->slave->get();
            $products = $query->result_array();
            $query->free_result();
            if(isset($products) && !empty($products)){
                $productIdArr = array();
                foreach($products as $v){
                    $productIdArr[] = $v['product_id'];
                }
                $this->slave->where_in('product_id', $productIdArr);
                $this->slave->select('order_id');
                $this->slave->from('order_goods');
                $query = $this->slave->get();
                $orderGoods = $query->result_array();
                $query->free_result();
                $orderIdArr = array();
                if(!empty($orderGoods)){
                    foreach($orderGoods as $v){
                        $orderIdArr[] = $v['order_id'];
                    }
                }
            }
        }
        if(isset($data['where']) && !empty($data['where'])){
            foreach($data['where'] as $k=>$v){
                $this->slave->where($k,$v);
            }
        }
        if(isset($orderIdArr) && !empty($orderIdArr)){
            $this->slave->where_in('order_id', $orderIdArr);
        }
        $this->slave->order_by($data['order']);
        $this->slave->limit($data['limit'],$data['offset']);
        $this->slave->from('order_info');
        $query = $this->slave->get();
        $result['rows'] = $query->result_array();
        $query->free_result();

        if(isset($data['where']) && !empty($data['where'])){
            foreach($data['where'] as $k=>$v){
                $this->slave->where($k,$v);
            }
        }
        if(isset($orderIdArr) && !empty($orderIdArr)){
            $this->slave->where_in('order_id', $orderIdArr);
        }
        $this->slave->from('order_info');
        $query = $this->slave->get();
        $result['total'] = $query->num_rows();
        $query->free_result();
        return $result;
    }
    //导出订单Excel
    public function exportOrderExcel($data){
        if(isset($data['whereZiXun']) && !empty($data['whereZiXun'])){
            //查找库存表
            foreach($data['whereZiXun'] as $k=>$v){
                $this->slave->where($k,$v);
            }
            $this->slave->select('product_id');
            $this->slave->from('products');
            $query = $this->slave->get();
            $products = $query->result_array();
            $query->free_result();
            if(isset($products) && !empty($products)){
                $productIdArr = array();
                foreach($products as $v){
                    $productIdArr[] = $v['product_id'];
                }
                $this->slave->where_in('product_id', $productIdArr);
                $this->slave->select('order_id');
                $this->slave->from('order_goods');
                $query = $this->slave->get();
                $orderGoods = $query->result_array();
                $query->free_result();
                $orderIdArr = array();
                if(!empty($orderGoods)){
                    foreach($orderGoods as $v){
                        $orderIdArr[] = $v['order_id'];
                    }
                }
            }
        }
        if(isset($data['where']) && !empty($data['where'])){
            foreach($data['where'] as $k=>$v){
                $this->slave->where($k,$v);
            }
        }
        if(isset($orderIdArr) && !empty($orderIdArr)){
            $this->slave->where_in('order_id', $orderIdArr);
        }
        $this->slave->order_by($data['order']);
        $this->slave->from('order_info');
        $query = $this->slave->get();
        $result = $query->result_array();
        return !empty($result) ? $result : '';
    }
    /*
     * 根据order_id，得到order_goods表中记录
     */
    public function getOrderGoodsByOrderId($order_id){
        $this->slave->where('order_id',$order_id);
        $this->slave->from('order_goods');
        $query = $this->slave->get();
        $result = $query->row_array();
        return !empty($result) ? $result : '';
    }
    /*
     * 根据order_id，得到order_ginfo表中记录
     */
    public function getOrderInfoByOrderId($order_id){
        $this->slave->where('order_id',$order_id);
        $this->slave->from('order_info');
        $query = $this->slave->get();
        $result = $query->row_array();
        return !empty($result) ? $result : '';
    }
    /*
    * 更新order_info表信息
    */
    public function updateOrderInfo($data){
        $order_id = isset($data['order_id']) ? $data['order_id'] : 0;
        if(isset($data['order_id'])){
            unset($data['order_id']);
        }
        if($order_id){
            $this->master->where('order_id',$order_id);
            if($this->master->update('order_info', $data)){
                return true;
            }else{
                return false;
            }
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
     * 商铺咨询时间列表
     */
    public function productslist($data){
        $result = array();
        $this->slave->order_by($data['order']);
        $this->slave->limit($data['limit'],$data['offset']);
        $this->slave->from('products');
        $query = $this->slave->get();
        $result['rows'] = $query->result_array();
        $query->free_result();

        $this->slave->from('products');
        $query = $this->slave->get();
        $result['total'] = $query->num_rows();
        $query->free_result();
        return $result;
    }
    /*
     * 根据库存id，得到产生的所有order_goods记录
     */
    public function getOrderGoodsByProductid($productid){
        $this->slave->where('product_id',$productid);
        $this->slave->from('order_goods');
        $query = $this->slave->get();
        $result = $query->result_array();
        return !empty($result) ? $result : '';
    }
    /*
     * 根据product_id，得到products表中记录
     */
    public function getProductByProductId($productid){
        $this->slave->where('product_id',$productid);
        $this->slave->from('products');
        $query = $this->slave->get();
        $result = $query->row_array();
        return !empty($result) ? $result : '';
    }
    /*
    * 根据order_id，得到买家填写的困惑信息
    */
    public function getOrderVisitorByOrderId($order_id){
        $this->slave->where('order_id',$order_id);
        $this->slave->from('order_visitor');
        $query = $this->slave->get();
        $result = $query->row_array();
        return !empty($result) ? $result : '';
    }
    /*
     * 根据订单号，得到订单的log
     */
    public function getOrderActionByOrderId($order_id){
        $this->slave->where('order_id',$order_id);
        $this->slave->order_by('log_time','desc');
        $this->slave->from('order_action');
        $query = $this->slave->get();
        $result = $query->result_array();
        return !empty($result) ? $result : '';
    }
    /*
     * 生成订单表记录
     */
    public function insertOrderInfo($data){
        $result = $this->master->insert('order_info',$data);
        if($result){
            return $this->master->insert_id();
        }else{
            return false;
        }
    }
    /*
     * 生成订单商品表记录
     */
    public function insertOrderGood($data){
        $result = $this->master->insert('order_goods',$data);
        if($result){
            return $this->master->insert_id();
        }else{
            return false;
        }
    }
    /*
     * 生成订单交易记录
     */
    public function insertOrderAction($data){
        $result = $this->master->insert('order_action',$data);
        if($result){
            return $this->master->insert_id();
        }else{
            return false;
        }
    }
    
    /**
      * 根据订单id获取商品信息
      * @param int $orderid 订单id
      * @return array 商品信息
      */
     public function getOrderGoodsInfoByOrderId($orderid){
         $this->slave->where('order_id',$orderid);
         $this->slave->from('order_goods');
         $query = $this->slave->get();
         $reslut = $query->result_array();
         if(!empty($reslut)){
             foreach($reslut as $rekey=>$reval){
                 $reslut[$rekey]['goods_attr'] = string2array($reval['goods_attr']);
                 $reslut[$rekey]['goodsid'] = $reval['goods_id'];
             }
         }
         return  $reslut ;
     }
}
