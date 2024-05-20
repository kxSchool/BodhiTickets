<?php

class MapSeatmodel extends CI_Model
{
    public $slave, $master;
    public function __construct()
    {
        parent::__construct();
        $this->slave = $this->load->database('tickets_slave', true);
        $this->master = $this->load->database('tickets_master', true);
    }

    /************************** �� *****************************/
    //����Ʒ�ƣ������� �����+�޸ġ� ������
    public function saveEvent($data){
        //�ж��Ƿ���idֵ����ȷ������ӻ����޸�
        $id = isset($data['id']) ? $data['id'] : 0;
        if(isset($data['id'])){
            unset($data['id']);
        }
        $data['venue_name'] = isset($data['venue_name']) ? $data['venue_name'] : '';
        $data['Province'] = isset($data['Province']) ? $data['Province'] : '';
        $data['City'] = isset($data['City']) ? $data['City'] : '';
        $data['Village'] = isset($data['Village']) ? $data['Village'] : '';
        $data['address'] = isset($data['address']) ? $data['address'] : '';
        $data['picname'] = isset($data['picname']) ? $data['picname'] : '';
        $data['desc'] = isset($data['desc']) ? $data['desc'] : '';
        //$data['startdate']=strtotime($data['startdate']);
        //$data['enddate']=strtotime($data['enddate']);
        if($id){
            //���⣺
            $this->master->where('id',$id);
            if($this->master->update('venue', $data)){
                return true;
            }else{
                return false;
            }
        }else{
            if($this->master->insert('venue', $data)){
                return true;
            }else{
                return false;
            }
        }
    }


    /************************** ɾ *****************************/
    //����id��ɾ����Ժ�б�
    public function delEventById($id){
        $this->master->where('id',$id);
        $this->master->from('venue');
        $result = $this->master->delete();
        if($result){
            return true;
        }else{
            return false;
        }
    }

    /************************** �� *****************************/
    //��Ժ�б�
    public function eventList($data){
        $result = array();
        if(isset($data['where'])){
            $this->slave->where('show_id',$data['where']['show_id']);
        }
        $this->slave->order_by($data['order']);
        $this->slave->limit($data['limit'],$data['offset']);
        $this->slave->from('event');
        $query = $this->slave->get();
        $result['rows'] = $query->result_array();
        $query->free_result();
        if(isset($data['where'])){
            $this->slave->where('show_id',$data['where']['show_id']);
        }
        $this->slave->from('event');
        $query = $this->slave->get();
        $result['total'] = $query->num_rows();
        $query->free_result();
        return $result;
    }

    // $id ͨ�� idֵȥ����ĳ����¼����Ϣ
    public function getEventById($id)
    {
        $this->slave->where('id',$id);
        $this->slave->from('event');
        $query = $this->slave->get();
        $result = $query->row_array();
        return !empty($result) ? $result : '';
    }


    //ͨ��Ʒ����ģ��ƥ�����еľ�Ժ 
    public function getEventsLikeName($name){
        $sql = "SELECT id,venue_name FROM event WHERE venue_name like '%".$name."%'";
        $query = $this->slave->query($sql);
        $result = $query->result_array();
        return !empty($result) ? $result : '';
    }


    //��ѯ���еľ�Ժ
    public function getAllVenues($data){
        //��1����ѯָ������
        $result = array();
        if(isset($data['fields'])  && isset($data['like'])){
            $this->slave->like($data['fields'], $data['like'], 'both');
        }

        $this->slave->limit($data['limit'],$data['offset']);
        $this->slave->from('venue');
        $query = $this->slave->get();

        $result['rows'] = $query->result_array();
        $query->free_result();

        //(2)��ѯ������
        if(isset($data['fields'])  && isset($data['like'])){
            $this->slave->like($data['fields'], $data['like'], 'both');
        }
        $this->slave->from('venue');
        $query = $this->slave->get();
        $result['total'] = $query->num_rows();
        $query->free_result();
        return $result;
    }


    //�����ظ�ֵ������
    public function isCommonData($data){
        if(!empty($data)){
            $sql = "SELECT id FROM venue WHERE `venue_name`='".$data['venue_name']."' and Province='".$data['Province']."' and City='".$data['City']."' and Village='".$data['Village']."' and address='".$data['address']."'";
            $query =  $this->slave->query($sql);
            $result = $query->result_array();
            if($result){
                return $result;
            }else{
                return FALSE;
            }
        }
    }




}