<?php

class Sectionmodel extends CI_Model
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
    public function saveSection($data){
        //�ж��Ƿ���idֵ����ȷ������ӻ����޸�
        $id = isset($data['id']) ? $data['id'] : 0;
        if(isset($data['id'])){
            unset($data['id']);
        }
        if (isset($data['map_id']))
        $data['map_id'] = $data['map_id']  ;
        if (isset($data['fillcolor']))
        $data['fillcolor'] = $data['fillcolor'];
        if (isset($data['section_path']))
        $data['section_path'] = $data['section_path'];
        if($id){
            //���⣺
            $this->master->where('id',$id);
            if($this->master->update('map_section', $data)){
                return true;
            }else{
                return false;
            }
        }else{
            if($this->master->insert('map_section', $data)){
                return true;
            }else{
                return false;
            }
        }
    }


    /************************** ɾ *****************************/
    //����id��ɾ����Ժ�б�
    public function delSectionById($id){
        $this->master->where('id',$id);
        $this->master->from('map_section');
        $result = $this->master->delete();
        if($result){
            return true;
        }else{
            return false;
        }
    }

    /************************** �� *****************************/
    //��Ժ�б�
    public function sectionList($data){
        $result = array();
        if(isset($data['where'])){
            $this->slave->where('map_id',$data['where']['map_id']);
        }
        $this->slave->order_by($data['order']);
        $this->slave->limit($data['limit'],$data['offset']);
        $this->slave->from('map_section');
        $query = $this->slave->get();
        $result['rows'] = $query->result_array();
        $query->free_result();
        if(isset($data['where'])){
            $this->slave->where('map_id',$data['where']['map_id']);
        }
        $this->slave->from('map_section');
        $query = $this->slave->get();
        $result['total'] = $query->num_rows();
        $query->free_result();
        return $result;
    }

    // $id ͨ�� idֵȥ����ĳ����¼����Ϣ
    public function getSectionById($id)
    {
        $this->slave->where('id',$id);
        $this->slave->from('map_section');
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