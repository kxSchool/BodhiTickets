<?php


defined('BASEPATH') OR exit('No direct script access allowed');
header("Content-type:text/html;charset=utf-8");
 class Alipay extends MY_Controller
  {

    //支付
     public function alipay($price = 0.01,$auto_id = 1){
         $alipay_config['order_sn']=$this->_getSn();

         $alipay_config['order_amount']=$price;

         $alipay_config['postscript']='票多多';

//合作身份者id，以2088开头的16位纯数字
         $alipay_config['partner']		= '2088921655563871';
//收款支付宝账号
         $alipay_config['seller_email']	= 'm13651831468@163.com';
//安全检验码，以数字和字母组成的32位字符
         $alipay_config['key']			= 'qmg9xe9wuxvg6ug27267tbg8p1bvp2iv';
//↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
//签名方式 不需修改
         $alipay_config['sign_type']    = strtoupper('MD5');
//字符编码格式 目前支持 gbk 或 utf-8
//$alipay_config['input_charset']= strtolower('utf-8');
//ca证书路径地址，用于curl中ssl校验
//请保证cacert.pem文件在当前文件夹目录中
//$alipay_config['cacert']    = getcwd().'\\cacert.pem';
//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
         $alipay_config['transport']    = 'http';
// ******************************************************配置 end*************************************************************************************************************************

// ******************************************************请求参数拼接 start*************************************************************************************************************************
         $parameter = array(
             "service" => "create_direct_pay_by_user",
             "partner" => $alipay_config['partner'], // 合作身份者id
             "seller_email" => $alipay_config['seller_email'], // 收款支付宝账号
             "payment_type"	=> '1', // 支付类型
             "notify_url"	=> 'http://www.baidu.com', // 服务器异步通知页面路径
             "return_url"	=> 'http://www.baidu.com', // 页面跳转同步通知页面路径
             "out_trade_no"	=> $alipay_config['order_sn'], // 商户网站订单系统中唯一订单号
             "subject"	=> "票", // 订单名称
             "total_fee"	=> $alipay_config['order_amount'], // 付款金额
             "body"	=> $alipay_config['postscript'], // 订单描述 可选
             "show_url"	=> "", // 商品展示地址 可选
             "anti_phishing_key"	=> "", // 防钓鱼时间戳  若要使用请调用类文件submit中的query_timestamp函数
             "exter_invoke_ip"	=> "", // 客户端的IP地址
             "_input_charset"	=> 'utf-8', // 字符编码格式
         );
// 去除值为空的参数
         foreach ($parameter as $k => $v) {
             if (empty($v)) {
                 unset($parameter[$k]);
             }
         }
// 参数排序
         ksort($parameter);
         reset($parameter);

// 拼接获得sign
         $str = "";
         foreach ($parameter as $k => $v) {
             if (empty($str)) {
                 $str .= $k . "=" . $v;
             } else {
                 $str .= "&" . $k . "=" . $v;
             }
         }
         $parameter['sign'] = md5($str . $alipay_config['key']);	// 签名
         $parameter['sign_type'] = $alipay_config['sign_type'];
//        return $parameter;
// ******************************************************请求参数拼接 end*************************************************************************************************************************


   
// ******************************************************模拟请求 start*************************************************************************************************************************
         $sHtml = "<form id='alipaysubmit' name='alipaysubmit' action='https://mapi.alipay.com/gateway.do?_input_charset=utf-8' method='get'>";
         foreach ($parameter as $k => $v) {
             $sHtml.= "<input type='hidden' name='" . $k . "' value='" . $v . "'/>";
         }

         $sHtml .= '<input type="submit" value="去支付">';

//$sHtml = $sHtml."<script>document.forms['alipaysubmit'].submit();</script>";

// ******************************************************模拟请求 end*************************************************************************************************************************
//var_dump($sHtml);
         echo $sHtml;

     }
     //随机单号
     public function _getSn(){
         return date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
     }
    public function alipayNotifyUrl(){
        //调用支付宝支付接口配置信息
        //合作身份者ID
        $this->load->config('alipay_config');
        //收款支付宝账号
        $alconfig['parter'] = $this->config->item('parter');
        //MD5密钥，安全校验码
        $alconfig['seller_email'] = $this->config->item('seller_email');
        //服务器异步通知页面路径
        $alconfig['notify_url'] = $this->config->item('notify_url');
        //页面跳转同步通知页面路径
        $alconfig['return_url'] = $this->config->item('return_url');
        //字符编码格式
        $alconfig['_input_charset'] = $this->config->item('_input_charset');
        //支付类型
        $alconfig['payment_type'] = $this->config->item('payment_type');
        //产品类型
        $alconfig['service']=$this->config->item('service');
        // 签名方式
        $alconfig['sign_type']=$this->config->item('sign_type');
        //计算得出通知验证结果
        $alipayNotify = new AlipayNotify($alconfig);
        $verify_result = $alipayNotify->verifyNotify();

        // log_message('error',$verify_result); 可以用ci自带日志调试或使用支付宝的logResult();

        if($verify_result) {//验证成功

            //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
            //商户订单号
            $out_trade_no = $_POST['out_trade_no'];
            //支付宝交易号
            $trade_no = $_POST['trade_no'];
            //交易状态
            $trade_status = $_POST['trade_status'];
            $total_fee      = $_POST['total_fee'];         //交易金额
           $notify_id      = $_POST['notify_id'];         //通知校验ID。
           $notify_time    = $_POST['notify_time'];       
           //通知的发送时间。格式为yyyy-MM-dd HH:mm:ss。
           $seller_email    = $_POST['seller_email'];       
           //买家支付宝帐号；
            $parameter = array(
             "out_trade_no"     => $out_trade_no, //商户订单编号；
             "trade_no"     => $trade_no,     //支付宝交易号；
             "total_fee"     => $total_fee,    //交易金额；
             "trade_status"     => $trade_status, //交易状态
             "notify_id"     => $notify_id,    //通知校验ID。
             "notify_time"   => $notify_time,  //通知的发送时间。
             "seller_email"   => $seller_email,  //卖家支付宝帐号；
           );

            if($_POST['trade_status'] == 'TRADE_SUCCESS') {

                // 支付成功处理业务逻辑，例如修改订单支付状态等等
                /* $sql=mysql_query("select * from user_account where out_trade_no='$out_trade_no'");
        
                $info=@mysql_fetch_array($sql);
        
                $a=$info['total_fee'];
                //echo 111;
                //echo $a;
        
                $sql2=mysql_query("select * from user_account where account='$info[account]'");
                $info2=@mysql_fetch_array($sql2);
                
                $b=$info2['amount'];
                
                $c=$a+$b;
                //echo $c;
                
                
                echo $out_trade_no;
                
                if($info[out_trade_no]='$out_trade_no'&&$info[status]=='未付款'&&$trade_no!=''){
                echo '测试访问';
                mysql_query("update user_account set amount='$c' where username='$info[account]'");
                
                //echo $info[out_trade_no];
                //echo $info[out_trade_no];
                
                mysql_query("update user_account set status='支付成功',trade_no='$trade_no' where account='$info[account]' and out_trade_no='$out_trade_no'"); */
             
            }
            echo "success";     //请不要修改或删除

        } else {

            //验证失败
            echo "fail";

            //调试用，写文本函数记录程序运行情况是否正常
            //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
        }
    }

    /** 
      * alipayReturnUrl 支付宝页面跳转同步通知页面(处理支付成功后提示页面) 
      * @author lyne 
      */  
     public function alipayReturnUrl(){  
       
         // 调用支付宝支付接口配置信息  
         $this->load->config('alipay_config');  
         $alconfig['partner']=$this->config->item('partner');             // 合作身份者ID  
         $alconfig['seller_email']=$this->config->item('seller_email');         // 收款支付宝账号  
         $alconfig['key']=$this->config->item('key');                     // MD5密钥，安全检验码  
         $alconfig['notify_url']=$this->config->item('notify_url');       // 服务器异步通知页面路径  
         $alconfig['return_url']=$this->config->item('return_url');       // 页面跳转同步通知页面路径  
         $alconfig['_input_charset']=$this->config->item('_input_charset'); // 字符编码格式   
         $alconfig['payment_type']=$this->config->item('payment_type');   // 支付类型  
         $alconfig['service']=$this->config->item('service');             // 产品类型  
         $alconfig['sign_type']=$this->config->item('sign_type');         // 签名方式  
      
         //计算得出通知验证结果  
         $alipayNotify = new AlipayNotify($alconfig);  
         $verify_result = $alipayNotify->verifyReturn();  
         if($verify_result) {//验证成功  
              
             //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表  
             //商户订单号  
             $out_trade_no = $_GET['out_trade_no'];  
             //支付宝交易号  
             $trade_no = $_GET['trade_no'];  
             //交易状态  
             $trade_status = $_GET['trade_status'];  
            $total_fee      = $_POST['total_fee'];         //交易金额
           $notify_id      = $_POST['notify_id'];         //通知校验ID。
           $notify_time    = $_POST['notify_time'];       
           //通知的发送时间。格式为yyyy-MM-dd HH:mm:ss。
           $seller_email    = $_POST['seller_email'];       
           //买家支付宝帐号；
            $parameter = array(
             "out_trade_no"     => $out_trade_no, //商户订单编号；
             "trade_no"     => $trade_no,     //支付宝交易号；
             "total_fee"     => $total_fee,    //交易金额；
             "trade_status"     => $trade_status, //交易状态
             "notify_id"     => $notify_id,    //通知校验ID。
             "notify_time"   => $notify_time,  //通知的发送时间。
             "seller_email"   => $seller_email,  //卖家支付宝帐号；
           );

      
             if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {  
                 //判断该笔订单是否在商户网站中已经做过处理  
                 //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序  
                   
                 // echo '交易成功！跳转成功页面';  
                   
                 //如果有做过处理，不执行商户的业务程序  
               
             }else {  
                 echo "trade_status=".$_GET['trade_status'];  
             }  
      
         } else {  
             //验证失败   
             echo "验证失败";  
         }  
     }  
 }