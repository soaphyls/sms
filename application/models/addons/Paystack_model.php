<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paystack_model extends CI_Model {

	function __construct()
	{
	    parent::__construct();
 	}


 	function get_paystack_supported_currencies()
	  {
	    $this->db->where('paystack_supported', 1);
	    return $this->db->get('currencies')->result_array();
	  }

	public function update_paystack_settings()
	  {
	    // update paystack keys
	    $paystack_info = array();

	    $paystack['active'] = $this->input->post('paystack_active');
	    $paystack['testmode'] = $this->input->post('testmode');
	    $paystack['secret_test_key'] = $this->input->post('secret_test_key');
	    $paystack['public_test_key'] = $this->input->post('public_test_key');
	    $paystack['secret_live_key'] = $this->input->post('secret_live_key');
	    $paystack['public_live_key'] = $this->input->post('public_live_key');

	    array_push($paystack_info, $paystack);

	    $data['value']    =   json_encode($paystack_info);
	    $this->db->where('key', 'paystack_keys');
	    $this->db->update('payment_settings', $data);

	    $data['value'] = html_escape($this->input->post('paystack_currency'));
	    $this->db->where('key', 'paystack_currency');
	    $this->db->update('payment_settings', $data);
	  }

	function check_payment($reference = ""){
	  $paystack_keys = json_decode(get_payment_settings('paystack_keys'));
	  if($paystack_keys[0]->testmode == 'on'){
	  	$secret_key = $paystack_keys[0]->secret_test_key;
		
	  }else{
	  	$secret_key = $paystack_keys[0]->secret_live_key;
		
	  }
	  $curl = curl_init();
  
	  curl_setopt_array($curl, array(
	    CURLOPT_URL => "https://api.paystack.co/transaction/verify/".$reference,
	    CURLOPT_RETURNTRANSFER => true,
	    CURLOPT_ENCODING => "",
	    CURLOPT_MAXREDIRS => 10,
	    CURLOPT_TIMEOUT => 30,
	    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	    CURLOPT_CUSTOMREQUEST => "GET",
	    CURLOPT_HTTPHEADER => array(
	      "Authorization: Bearer ".$secret_key,
	      "Cache-Control: no-cache",
	    ),
	  ));
	  
	  $response = curl_exec($curl);
	  $err = curl_error($curl);
	  curl_close($curl);
	  
	  if ($err) {
	    return false;
	  } else {
	    return json_decode($response)->status;
	  }
	 }
}