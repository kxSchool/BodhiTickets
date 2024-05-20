<?php

class Test extends MY_Controller{
//    private $membersdb;
//    private $inquiryoffermodel;
//    private $inquirylistmodel;
//    private $addressmodel;
//    private $qirelationmodel;
    public function __construct() {
        parent::__construct();
        // 初始化基本库数据库连接
//        $this->master=$this -> load -> database('master',true);
//        $this->slave=$this -> load -> database('slave',true);
//        // 初始化采购库数据连接
//        $this->purchasemaster = $this->load->database('purchase_master',true);
//        $this->purchaseslave = $this->load->database('purchase_slave',true);
//
//        $this->load->model('Membersmodel');
//        $this->membersdb = $this->Membersmodel;
//        // 初始化询价单相关数据模型
        $this->load->model('NewInquirymodel');
        $this->inquirylistmodel = $this->NewInquirymodel;
//
//        $this->load->model('NewQuotationmodel');
//        $this->inquiryoffermodel = $this->NewQuotationmodel;
//        // 收货地址
//        $this->load->model('Addressmodel');
//        $this->addressmodel = $this->Addressmodel;
//        
//        // 供货商品牌对应关系
//        $this->load->model('QIRelationmodel');
//        $this->qirelationmodel = $this->QIRelationmodel;

    }
    
    public function index(){
        // var_dump($data= $this->qirelationmodel->getSupplierByBrandName('别克'));
        //var_dump($data= $this->inquiryoffermodel->getInquiryOfferInfoByInquiryCode('107090115280277'));
//        var_dump($this->getInquiryAndQuationBrand());
        // $this->inquirylistmodel->getlist(['brandname'=>$this->getInquiryAndQuationBrand(1),'inquirystatus'=>1]);
        //$data = $this->inquirylistmodel->getInquiryStatusByInquiryCodeAndBatchCode('107083116103075');
        // var_dump($data);
        $this->load->model('InquriyQuotationRelationmodel');
        $data = $this->InquriyQuotationRelationmodel->getSupplierPermissionInfo('107110115583435',66);
        var_dump($data);
    }
}

