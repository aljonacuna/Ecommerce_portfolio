<?php
	defined('BASEPATH') OR exit('No direct script access allowed'); 
	class Stripe_lib {
		var $CI;
		public function __construct() {
			$this->CI =& get_instance(); 
        	$this->CI->load->config('config'); 
			//load stripe library
			require APPPATH ."third_party/stripe-php/init.php";
			//set the api key
			\Stripe\Stripe::setApiKey($this->CI->config->item('stripe_secret'));
		}
		public function create_customer($email, $token) {
			try {
				$customer = \Stripe\Customer::create(array(
					"email" => $email,
					"source" => $token
				));
				return $customer;
			}
			catch(Exception $e) {
				return false;
			}
		}
		public function create_charge($tot_amount, $customer) {
			try {
				$charge = \Stripe\Charge::create(array(
	                "amount" => 100 * $tot_amount,
	                "currency" => "php",
	                "customer" => $customer,
	                "description" => "Test payment" 
		        ));
		        return true;
			}
			catch(Exception $e) {
				return $e;
			}
		}
	}


?>