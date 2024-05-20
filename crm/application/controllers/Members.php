<?php
//////////////////////////////////////////////////////////////////////
// 章爱军(永远的大牛)                                               //
// Trial License: For evaluation only!                              //
// (c) 2018, ZhangAijun, http://www.mydeershow.com                  //
//////////////////////////////////////////////////////////////////////
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends MY_Controller {

	private $membersmodel;
        private $staffroledb;

	public function __construct() {
            parent::__construct();
            // 初始化数据库连接
            $this->master=$this -> load -> database('master',true);
            $this->slave=$this -> load -> database('slave',true);
            // 加载member表
            $this->load->model('Membersmodel');
            $this->membersmodel = $this->Membersmodel;
            // 加载地址表
            $this->load->model('Membersmodel');
            $this->membersmodel = $this->Membersmodel;
	}
    
        
        public function ajaxSearch(){
            if(IS_AJAX){
                $searchkey = $this->input->post('data'); // 检索关键字
                if(empty($searchkey)){
                    echo json_encode([]);
                    return;
                }
                $limit = is_numeric($this->input->post('maxRows')) ? $this->input->post('maxRows'):10 ; // 获取条数
                // 获取用户信息列表
                $userlist = $this->membersmodel->getMembersInfoBySearchFieldsLimit(['realname'=>'like \'%'.$searchkey.'%\'','username'=>'like \'%'.$searchkey.'%\'','mobile'=>'like \'%'.$searchkey.'%\''],$limit,true);
                echo json_encode(!empty($userlist)?$userlist:[]);
                return;
            }else{
                echo json_encode([]);
                return;
            }
        }
        
        public function ajaxGetmember(){
            if(IS_AJAX){
                $userid = $this->input->post('userid'); // 检索关键字
                $data = $this->membersmodel->getMemberInfoByUserid($userid);
                // 收货地址
                $this->load->model('Useraddressmodel');
                $address = $this->Useraddressmodel->getUserDefaultAddress($userid);
                $data['recname'] = empty($address['recname']) ? '':$address['recname'];
                $data['areaid'] = empty($address['addressid']) ? '':$address['addressid'];
                $data['recphone'] = empty($address['recphone'])?'':$address['recphone'];
                $data['address'] = empty($address['address'])?'':$address['address'];
                $data['shortaddress'] = str_replace(empty($address['shortaddress'])?'':$address['shortaddress'],"",$data['address']);
                $data['provid'] = empty($address['provid'])?'':$address['provid'];
                $data['cityid'] = empty($address['cityid'])?'':$address['cityid'];
                $data['counid'] = empty($address['counid'])?'':$address['counid'];
                echo json_encode($data);
                return;
            }else{
                echo json_encode([]);
                return;
            }
        }


}
