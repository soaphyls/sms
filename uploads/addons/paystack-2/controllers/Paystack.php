<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paystack extends CI_Controller {

  public function __construct()
  {
      parent::__construct();
      // Your own constructor code
      $this->load->database();
      $this->load->library('session');
      $this->load->model('addons/paystack_model');
	  $this->load->model('crud_model');
      if (!$this->session->userdata('cart_items')) {
          $this->session->set_userdata('cart_items', array());
      }
  }

  public function payment_settings($param1 = "") {
    if ($this->session->userdata('admin_login') != true) {
      redirect(site_url('login'), 'refresh');
    }
    $this->paystack_model->update_paystack_settings();
    redirect(site_url('superadmin/payment_settings'), 'refresh');
	
  }

  // PAYPAL CHECKOUT ACTIONS
    public function paystack_payment($invoice_id = "", $amount_paid = "", $reference = "") {
        if($this->paystack_model->check_payment($reference)){
		$payment_method = 'Paystack';
        $data['payment_method'] = $payment_method;
		$data['invoice_id'] = $invoice_id;
		$data['amount_paid'] = $amount_paid;
		$this->crud_model->payment_success($data);
		$this->session->set_flashdata('flash_message', get_phrase('payment_successfully_done'));

		redirect(route('invoice'), 'refresh');
		 }
		else{
           $this->session->set_flashdata('error_message', get_phrase('your_payment_has_not_been_successful'));
           redirect(route('invoice'), 'refresh');
        
		 }
        
     }

}   