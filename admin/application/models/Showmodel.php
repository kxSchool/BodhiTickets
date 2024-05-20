<?php

class Showmodel extends CI_Model
{
    public $slave, $master;
    public function __construct()
    {
        parent::__construct();
        $this->slave = $this->load->database('tickets_slave', true);
        $this->master = $this->load->database('tickets_master', true);
    }

    /************************** 增 *****************************/
    //保存品牌（适用于 “添加+修改” 操作）
    public function saveShow($data){
        //判断是否有id值，来确定是添加还是修改
        $id = isset($data['id']) ? $data['id'] : 0;
        if(isset($data['id'])){
            unset($data['id']);
        }
        if (isset($data['desc']))
        $data['desc'] = isset($data['desc']) ? $data['desc'] : '';
        $data['startdate']=strtotime($data['startdate']);
        $data['enddate']=strtotime($data['enddate']);
        if($id){
            //问题：
            $this->master->where('id',$id);
            if($this->master->update('show', $data)){
                return true;
            }else{
                return false;
            }
        }else{
            if($this->master->insert('show', $data)){
                return true;
            }else{
                return false;
            }
        }
    }


    /************************** 删 *****************************/
    //根据id，删除品牌
    public function delShowById($id){
        $this->master->where('id',$id);
        $this->master->from('show');
        $result = $this->master->delete();
        if($result){
            return true;
        }else{
            return false;
        }
    }

    /************************** 查 *****************************/
    //品牌列表
    public function showList($data){
        $result = array();
        if(isset($data['where']['namelike']) && !empty($data['where']['namelike'])){
            $this->slave->like('name',$data['where']['namelike'], 'both');
            $namelike = $data['where']['namelike'];
            unset($data['where']['namelike']);
        }

        if(isset($data['where'])){
            $this->slave->where($data['where']);
        }
        $this->slave->order_by($data['order']);
        $this->slave->limit($data['limit'],$data['offset']);
        $this->slave->from('show');
        $query = $this->slave->get();
        $result['rows'] = $query->result_array();
        $query->free_result();


        if(isset($namelike) && !empty($namelike)){
            $this->slave->like('name',$namelike, 'both');
            unset($namelike);
        }
        if(isset($data['where'])){
            $this->slave->where($data['where']);
        }
        $this->slave->from('show');
        $query = $this->slave->get();
        $result['total'] = $query->num_rows();
        $query->free_result();
        return $result;
    }

    // $id 通过 id值去查找某条记录的信息
    public function getShowById($id)
    {
        $this->slave->where('id',$id);
        $this->slave->from('show');
        $query = $this->slave->get();
        $result = $query->row_array();
        return !empty($result) ? $result : '';
    }


    //通过品牌名模糊匹配所有的品牌
    public function getShowsLikeName($name){
        $sql = "SELECT id,`name` FROM `show` WHERE `name` like '%".$name."%'";
        $query = $this->slave->query($sql);
        $result = $query->result_array();
        return !empty($result) ? $result : '';
    }


    //查询所有的品牌名
    public function getAllShows(){
        $sql = "SELECT id,`name` FROM `show`";
        $query = $this->slave->query($sql);
        $result = $query->result_array();
        return !empty($result) ? $result : '';
    }






}