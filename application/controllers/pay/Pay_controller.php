<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pay_controller extends CI_Controller {

    public function __construct()    {
        parent::__construct();     
    }

    public function process()
    {
        require_once(APPPATH.'libraries/stripe-php-master/init.php');

        \Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));

        $id = $this->session->userdata('userId');

        $charge= \Stripe\Charge::create ([
            "amount" => $this->input->post('price'),
            "currency" => "EUR",
            "source" => $this->input->post('stripeToken'),
            "description" => $this->input->post('planName')
        ]);
        
        $stripresult = $charge->jsonSerialize();        


        $orderid                 = $stripresult['id'];
        $amount                  = $stripresult['amount'];
        $balance_transaction     = $stripresult['balance_transaction'];
        $currency                = $stripresult['currency'];
        $status                  = $stripresult['status'];

        //collect info to store into db
        $insert_data = array(
            'stripe_order_order_by_strip'                => $orderid,
            'stripe_order_transaction_id'                => time().'-'.mt_rand(),
            'fk_plan_id'                                 => $this->input->post('plan_id'),
            'fk_user_id'                                 => $id,
            'stripe_order_amount'                        => $amount,
            'balance_transaction'                        => $balance_transaction,
            'stripe_order_currency'                      => $currency,
            'stripe_order_acknowledge'                   => $status,
            'stripe_order_created_on'                    => date('Y-m-d H:i:s')
        );

        //insert payment details in the db
        $this->db->insert('vic_stripe_orders' , $insert_data);

        //update user status
        $this->db->set('vic_user_details_payment_status', 'paid');
        $this->db->where('vic_users_iduser_details', $id);
        $this->db->update('vic_user_details');

        $this->session->set_flashdata('success', 'Payment made successfully.');

        redirect(base_url('?'.$status), 'refresh');

    }
}

?>