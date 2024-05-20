<?php

class TicketsCategoryShowmodel extends CI_Model
{
    public $slave, $master;
    public function __construct()
    {
        parent::__construct();
        $this->slave = $this->load->database('tickets_slave', true);
        $this->master = $this->load->database('tickets_master', true);
    }


    /****************************** 增 *********************************/
    public function addShowCategory($data){
        $result = $this->master->insert_batch('category_show', $data);
        if($result){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    /****************************** 删 *********************************/
    public function delBCById($showid){
        $this->master->where('show_id', $showid);
        $result = $this->master->delete('category_show');
        if($result){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    /****************************** 改 *********************************/
    public function updateSort($data){
        $sql = "UPDATE category_show set sort = ".$data['sort'].
            " WHERE cat_id = ".$data['cat_id']." AND show_id = ".$data['show_id'];
        $result = $this->master->query($sql);
        if($result){
            return TRUE;
        }else{
            return FALSE;
        }
    }


    /****************************** 查 *********************************/
    //根据show_id去查询category_show_ids表
    public function getBCById($showid){
        $sql = "SELECT cat_id FROM category_show 
                WHERE show_id = ".$showid;
        $query = $this->slave->query($sql);
        $result = $query->result_array();
        $query->free_result();
        return $result;
    }

    //根据cat_id连表查询信息
    public function getCategoryShowInfo($cat_id){
        //a.show_id,b.name
        $sql = "SELECT a.*,b.id,b.name
                FROM category_show a INNER JOIN `show` b ON a.show_id = b.id  
                WHERE a.cat_id = ".$cat_id.
                " ORDER BY sort DESC";
        $query = $this->slave->query($sql);
        $result = $query->result_array();
        $query->free_result();
        return $result;
    }


}