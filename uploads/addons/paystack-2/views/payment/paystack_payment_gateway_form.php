<form action="#" class="form paystack-form">
  <script src="https://js.paystack.co/v1/inline.js"></script> 
  <hr class="border mb-4">
  <button type="button" name="pay_now" id="pay-now" class="payment-button float-right" onclick="payWithPaystack()"><?php echo get_phrase('pay_by_paystack'); ?></button>
</form>

<?php
$paystack_settings = $this->db->get_where('payment_settings', array('key' => 'paystack_keys'))->row()->value;
$paystack = json_decode($paystack_settings);
if($paystack[0]->testmode == 'off'):
  $key =  $paystack[0]->public_live_key;
else:
  $key =  $paystack[0]->public_test_key;
endif;

$user_details = $this->db->get_where('users', array('id' => $this->session->userdata('user_id')))->row_array();
?>

<!-- place below the html form -->
<script >
  function payWithPaystack(){
    var handler = PaystackPop.setup({
      // This assumes you already created a constant named
      // PAYSTACK_PUBLIC_KEY with your public key from the
      // Paystack dashboard. You can as well just paste it
      // instead of creating the constant
      key: '<?php echo $key; ?>',
      email: '<?php echo $user_details['email']; ?>',
      amount: '<?php echo $total_amount_in_this_invoice*100; ?>',
      currency: "<?php echo get_payment_settings('paystack_currency'); ?>",
      metadata: {
        custom_fields: [
          {
            display_name: "<?php echo $user_details['first_name'].' '.$user_details['last_name']; ?>",
            variable_name: "paid_on",
            value: '<?php echo site_url(); ?>'
          }
        ]
      },
      callback: function(response){

        location.replace("<?php echo site_url('addons/paystack/paystack_payment/'.$invoice_details['id'].'/'.$total_amount_in_this_invoice.'/'); ?>"+response.reference);
      },
      onClose: function(){
        location.replace("<?php echo route('payment/'.$invoice_details['id']); ?>");
      }
    });
    handler.openIframe();
  }
</script>