<style>
    .paystack-form{
        display: none;
    }

    .payment-gateway-icon-paystack{
        width: 80%;
        float: right;
    }
    .paystack_payment_instruction{
        padding: 20px;
        min-height: 100px;
        width: 100%;
        background-color: #E6E9FC;
        margin-top: 100px;
        border-radius: 10px;
    }
</style>
<?php
    $paystack = json_decode(get_payment_settings('paystack_keys'));
?>

<?php if($paystack[0]->active != 0): ?>
<div class="row payment-gateway paystack" onclick="selectedPaystackPaymentGateway()">
    <div class="col-12">
        <img class="tick-icon paystack-icon" src="<?php echo base_url('assets/payment/tick.png'); ?>">
        <img class="payment-gateway-icon-paystack" src="<?php echo base_url('assets/payment/paystack.png'); ?>">
    </div>
</div>
<?php endif; ?>
<script>
    function selectedPaystackPaymentGateway(){
        $(".payment-gateway").css("border","2px solid #D3DCDD");
        $('.tick-icon').hide();
        $('.form').hide();

        $(".paystack").css("border","2px solid #00D04F");
        $('.paystack-icon').show();
        $('.paystack-form').show();
    }
</script>

