<?php

class Paymentmodel extends CI_Model {
    /*
     * 支付方式列表
     */
    public function paymentlist($data){
        $result = array();
        if(isset($data['where'])){
            $this->slave->where($data['where']);
        }
        $this->slave->order_by($data['order']);
        $this->slave->limit($data['limit'],$data['offset']);
        $this->slave->from('payment');
        $query = $this->slave->get();
        $result['rows'] = $query->result_array();
        $query->free_result();

        if(isset($data['where'])){
            $this->slave->where($data['where']);
        }
        $this->slave->from('payment');
        $query = $this->slave->get();
        $result['total'] = $query->num_rows();
        $query->free_result();
        return $result;
    }
    /*
     * 根据支付方式id，得到支付方式
     */
    public function getPaymentById($pay_id){
        $this->slave->where('pay_id',$pay_id);
        $this->slave->from('payment');
        $query = $this->slave->get();
        $result = $query->row_array();
        return !empty($result) ? $result : '';
    }
    /*
     * 保存支付方式
     */
    public function savePayment($data){
        $pay_id = isset($data['pay_id']) ? $data['pay_id'] : 0;
        if(isset($data['pay_id'])){
            unset($data['pay_id']);
        }
        if($pay_id){
            $this->master->where('pay_id',$pay_id);
            if($this->master->update('payment', $data)){
                return true;
            }else{
                return false;
            }
        }else{
            if($this->master->insert('payment', $data)){
                return true;
            }else{
                return false;
            }
        }
    }
    /*
     * 根据支付方式id，删除支付方式
     */
    public function delPaymentById($pay_id){
        $this->master->where('pay_id',$pay_id);
        $this->master->from('payment');
        $result = $this->master->delete();
        if($result){
            return true;
        }else{
            return false;
        }
    }
}
