<?php
/**
 * User: lvjinliang
 * Date: 2017-06-23
 * Time: 14:58
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Shopreview extends MY_Controller {
    private $membersdb, $regiondb;

    public function __construct() {
        parent::__construct();
        $this->load->model('Membersmodel');
        $this->membersdb = $this->Membersmodel;
        $this->load->model('Regionmodel');
        $this->regiondb = $this->Regionmodel;

    }

    public function index() {
        if ($this->input->post('dosearch')) {
            $authority = $this->input->post('authority');
        } else {
            $authority = $this->input->get('authority');
        }

        if (isset($authority) && $authority!=='' ) {
            $parameter['authority'] = $authority;
            $this->load->vars('authority', $authority);
            $data['where'] = array('authority' => $authority);
        }
        $data['order'] = "add_time DESC";
        $data['limit'] = PAGESIZE;
        $page = $this->input->get('page');
        $currentPage = $page = isset($page) ? intval($page) : 1;
        $offset = ($page - 1) * PAGESIZE;
        $data['offset'] = $offset;
        $result = $this->membersdb->sellerProfileList($data);
        foreach ($result['rows'] as $k => $v) {
            //得到商铺的经验值
            $memberInfo = $this->membersdb->getMemberInfoByUserid($v['userid']);
            if (!empty($memberInfo)) {
                $result['rows'][$k]['username'] = $memberInfo['username'];
            }
        }
        $this->load->library('Page');
        $uri = '';
        if (isset($parameter)) {
            $uri = '?'.http_build_query($parameter);
            $pageObject = new Page($result['total'], PAGESIZE, $currentPage, $parameter);
        } else {
            $pageObject = new Page($result['total'], PAGESIZE, $currentPage);
        }

        $pageObject->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $pages = $pageObject->show();
        $dataShow = array('pages' => $pages, 'datas' => $result['rows']);
        $this->load->view('shopreview/index', $dataShow);
    }

    //申请入驻商铺资料详情
    public function detail(){
        $userid = $this->input->get('userid');
        $userInfo = [];
        if (!empty($userid)) {
            $userInfo = $this->membersdb->getMemberInfoByUserid($userid);
            if(!empty($userInfo)){
                //扩展表中信息
                $profileInfo = $this->membersdb->getsellerProfileByUserId($userid);
                $userInfo = array_merge($userInfo, $profileInfo);
                if (!empty($userInfo['region_id'])) {
                    $userInfo['city_name'] = $this->regiondb->getRegionNameById($userInfo['region_id']);
                }

                $sellerShopImages = $this->membersdb->sellerImagesList($userid);
                if (!empty($sellerShopImages)) {
                    foreach ($sellerShopImages as $key => $val) {
                        $userInfo['shop_image'][$key]  = (!empty($val['filename'])) && file_exists($this->config->item('seller_images_path').$userid.'/original/'.$val['filename'])?$this->config->item('seller_images_url').$userid.'/original/'.$val['filename']:'';
                    }
                }

                $sellerZsImages = $this->membersdb->sellerZsList($userid);
                if (!empty($sellerZsImages)) {
                    foreach ($sellerZsImages as $key => $val) {
                        $userInfo['shop_zs'][$key]  = (!empty($val['image'])) && file_exists($this->config->item('seller_certificate_path').$userid.'/'.$val['image'])?$this->config->item('seller_certificate_url').$userid.'/'.$val['image']:'';
                    }
                }
                $userInfo['city'] = $this -> regiondb -> getRegionNameById($userInfo['region_id']);
                $userInfo['refuse'] = $this->membersdb->getRefuseByuserid($userid);
            }
        }
        $this->load->vars('userinfo', $userInfo);
        $this->load->view('shopreview/detail');
    }

    public function ajax_allow() {
        $json = ['success'=>0];
        $data = $this->input->post();
        if (empty($data['userid'])) {
            $json['msg'] = '参数错误';
            echo json_encode($json);exit();
        }

        $result = $this->membersdb->updateprofile($data['userid'], ['authority'=>2]);
        $result1 = $this->membersdb->saveRefuse($data);
        if ($result&&$result1) {
            $json = ['success'=>1];
        } else {
            $json = ['success'=>0,'msg'=>'网络异常'];
        }
        echo json_encode($json);exit();
    }

    public function ajax_refuse() {
        $json = ['success'=>0];
        $data = $this->input->post();
        if (empty($data['userid'])) {
            $json['msg'] = '参数错误';
            echo json_encode($json);exit();
        }

        $profileData['authority'] = 1;
        if ( (isset($data['shop_contact'])&&$data['shop_contact']==0) || (isset($data['contact_number'])&&$data['contact_number']==0)) {
            $profileData['reg_step'] = 2;
        } else {
            $profileData['reg_step'] = 3;
        }
        $result = $this->membersdb->updateprofile($data['userid'], $profileData);
        $result1 = $this->membersdb->saveRefuse($data);
        if ($result&&$result1) {
            $json = ['success'=>1];
        } else {
            $json = ['success'=>0,'msg'=>'网络异常'];
        }
        echo json_encode($json);exit();
    }
}