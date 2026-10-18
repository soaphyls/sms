<?php
$paystack_value = $this->db->get_where('payment_settings', array('key' => 'paystack_currency'))->row()->NGN;

$paystack_settings = $this->db->get_where('payment_settings', array('key' => 'paystack_keys'))->row()->value;
$paystack = json_decode($paystack_settings);
?>
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title"><p><?php echo get_phrase('setup_paystack_settings'); ?></p></h4>
            <form class="" action="<?php echo site_url('addons/paystack/payment_settings'); ?>" method="post" enctype="multipart/form-data">
                 <div class="col-12 ">
					<div class="form-group row mb-3">
                   <label class="col-md-3 col-form-label" for="system_currency"><?php echo get_phrase('active'); ?></label>
                     <div class="col-md-9">
					<select class="form-control select2" data-toggle="select2" id = "paystack_active" name="paystack_active">
                        <option value="0" <?php if ($paystack[0]->active == 0) echo 'selected';?>> <?php echo get_phrase('no');?></option>
                        <option value="1" <?php if ($paystack[0]->active == 1) echo 'selected';?>> <?php echo get_phrase('yes');?></option>
                    </select>
                </div>

					<div class="col-12 mt-3">
					<div class="form-group row mb-3">
                   <label class="col-md-3 col-form-label" ><?php echo get_phrase('test_mode'); ?></label>
                    <div class="col-md-9">
					<select class="form-control select2" data-toggle="select2" id = "testmode" name="testmode">
                        <option value="on" <?php if ($paystack[0]->testmode == 'on') echo 'selected';?>> <?php echo get_phrase('on');?></option>
                        <option value="off" <?php if ($paystack[0]->testmode == 'off') echo 'selected';?>> <?php echo get_phrase('off');?></option>
                    </select>
                </div>
				</div>
				</div>
				
				
					<div class="col-12">
					<div class="form-group row mb-3">
                    <label class="col-md-3 col-form-label" ><?php echo get_phrase('paystack_currency'); ?></label>
					 <div class="col-md-9">
                    <select class="form-control select2" data-toggle="select2" id = "paystack_currency" name="paystack_currency" required>
                        <option value=""><?php echo get_phrase('select_paystack_currency'); ?></option>
                        <?php
                        $this->db->where('paystack_supported', 1);
                        $currencies = $this->db->get('currencies')->result_array();
                        foreach ($currencies as $currency):?>
                        <option value="<?php echo $currency['code'];?>"
                            <?php echo 'selected';?>> <?php echo $currency['code'];?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
			</div>
			</div>
            <div class="col-12">
					<div class="form-group row mb-3">
                    <label class="col-md-3 col-form-label" ><?php echo get_phrase('secret_test_key'); ?></label>
                <div class="col-md-9">
				<input type="text" name="secret_test_key" class="form-control" value="<?php echo $paystack[0]->secret_test_key;?>" required />
            </div>
			</div>
			</div>
            <div class="col-12">
					<div class="form-group row mb-3">
                    <label class="col-md-3 col-form-label" ><?php echo get_phrase('public_test_key'); ?></label>
                <div class="col-md-9">
				<input type="text" name="public_test_key" class="form-control" value="<?php echo $paystack[0]->public_test_key;?>" required />
            </div>
			</div>
			</div>

            <div class="col-12">
					<div class="form-group row mb-3">
                    <label class="col-md-3 col-form-label" ><?php echo get_phrase('secret_live_key'); ?></label>
                <div class="col-md-9">
				<input type="text" name="secret_live_key" class="form-control" value="<?php echo $paystack[0]->secret_live_key;?>" required />
            </div>
			</div>
			</div>
            <div class="col-12">
					<div class="form-group row mb-3">
                    <label class="col-md-3 col-form-label" ><?php echo get_phrase('public_live_key'); ?></label>
                 <div class="col-md-9">
				<input type="text" name="public_live_key" class="form-control" value="<?php echo $paystack[0]->public_live_key;?>" required />
            </div>
			</div>
			</div>

            <div class="row justify-content-md-center">
                <div class="form-group col-md-6">
                    <button class="btn btn-block btn-primary" type="submit"><?php echo get_phrase('update_paystack_keys'); ?></button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>