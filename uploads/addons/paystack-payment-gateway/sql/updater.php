<?php
$CI = get_instance();
$CI->load->database();
$CI->load->dbforge();

$data_settings_keys['key'] = 'paystack_keys';
$data_settings_keys['value'] = '[{"active":"1","testmode":"on","secret_test_key":"sk_test_c746060e693dd50c6f397dffc6c3b2f655217c94","public_test_key":"pk_test_0816abbed3c339b8473ff22f970c7da1c78cbe1b","secret_live_key":"sk_live_xxxxxxxxxxxxxxxxxxxxx","public_live_key":"pk_live_xxxxxxxxxxxxxxxxxxxxx"}]';
$CI->db->insert('payment_settings', $data_settings_keys);

$data_settings_currency['key'] = 'paystack_currency';
$data_settings_currency['value'] = 'NGN';
$CI->db->insert('payment_settings', $data_settings_currency);


//Adding paystack field for currency table
$paystack_field = array(
        'paystack_supported' => array('type' => 'INT', 'default' => 0)
);
$CI->dbforge->add_column('currencies', $paystack_field);

$CI->db->where('code', 'NGN');
$CI->db->update('currencies', array('paystack_supported' => 1));
?>
