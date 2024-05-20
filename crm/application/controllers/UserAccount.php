<?php
/**
 * Created by PhpStorm.
 * User: as
 * Date: 2018/4/28
 * Time: 18:18
 */
class UserAccount extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination'); //系统的library
        $this->load->model('useraccountmodel', 'useraccount');    //调数据库数据
        $this->load->helper('url');       //系统的帮助类

    }
    //资金管理
    public function useraccount()
    {
        if($this->input->post('dosearch')){
            $fields = $this->input->post('fields');
            $search = $this->input->post('search');
        }else{
            $fields = $this->input->get('fields');
            $search = $this->input->get('search');
        }

        if(!empty($fields) && !empty($search)){
            $this->load->vars('fields',$fields);
            $parameter['fields'] = $fields;

            $this->load->vars('search',$search);
            $parameter['search'] = $search;
            $data['fields'] = $fields;
            if($search == 'admin_user'){
                $data['like'] = strtolower(trim($search));
            }else{
                $data['like'] = trim($search);
            }
        }

        $data['limit'] = PAGESIZE;
        $page = $this->input->get('page');
        $currentPage = $page = isset($page) ? intval($page) : 1;
        $offset = ($page - 1) * PAGESIZE;
        $data['offset'] = $offset;
        $result = $this->useraccount->getAllVenues($data);
        foreach($result['rows'] as &$v){
            if(isset($v['admin_user']) && !empty($v['admin_user'])){
                $v['admin_user'] = $this->config->item('url') . $v['admin_user'];
            }
        }
        $this->load->library('Page');
        if(isset($parameter)){
            $pageObject = new Page($result['total'], PAGESIZE, $currentPage,$parameter);
        }else{
            $pageObject = new Page($result['total'], PAGESIZE, $currentPage);
        }
        $pageObject->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $pages = $pageObject->show();
        $dataShow = array('pages' => $pages, 'datas' => $result['rows']);

        $this->load->view('UserAccount/useraccount',$dataShow);
    }



    //充值
    public function useraccountAdd(){
         $this->load->view('UserAccount/useraccountAdd');
    }
    public function saveUseraccount(){
        //余额充值
        //获取充值信息       
        //$this->load->view('UserAccount/Useraccount');
    }
    //提现
    public function useraccountCash(){
        $this->load->view('UserAccount/useraccountCash');
    }

    //导出
    public function excel_out(){
        header("Content-type:text/html;charset=utf-8");
        header("Content-Disposition:attachment;filename=提现管理.xls");
        $array=$this->db->get("user_account")->result_array();
        $str="id\t"."admin_user\t"."amount\n";
        foreach($array as $val){
            $str.=$val['id']."\t".$val['admin_user']."\t".$val['amount']."\n";
        }
        echo $str;
    }
    
}