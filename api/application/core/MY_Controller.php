<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    
        protected $qirelationmodel;

	public function __construct() {
		parent::__construct();
                // 初始化基本库数据库连接
                $this->master = $this -> load -> database('master',true);
                $this->slave = $this -> load -> database('slave',true);
                // 职员管理库数据连接
                $this->crmmaster = $this -> load -> database('crm_master',true);
                $this->crmslave = $this -> load -> database('crm_slave',true);
                // 初始化采购库数据连接
                $this->purchasemaster = $this->load->database('purchase_master',true);
                $this->purchaseslave = $this->load->database('purchase_slave',true);
            
		date_default_timezone_set('Asia/Shanghai');
		$this->load->helper('url');//加载URL 辅助函数
		$this->load->helper('function');//加载自定义辅助函数
		$this->load->config('system');//加载系统配置文件

		define('CRM_STATIC_PATH', $this->config->item('crm_static_path'));
        define('STATIC_PATH', $this->config->item('static_path'));
		define('PAGESIZE',$this->config->item('pagesize'));
		define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
		define("IS_POST", strtolower($_SERVER['REQUEST_METHOD']) == 'post');

	}

}