<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Cart extends CI_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->model("Customer");
			$this->load->model("Session");
			$this->load->library('stripe_lib'); 
		}
		

		//save to session the add to cart products
		public function addtocart() {
			//check if user is currently online if not redirect to login
			if ($this->Session->is_loggedin()) {
				$user_data = $this->Session->get_session_userdata();
				$input = $this->input->post();
				$price = $this->Customer->get_price($input['id']);
				$orders = $this->Session->get_order_session();
				if (isset($orders[$user_data['id']])) {
					$qty_exceed = $this->check_quantity($input, $orders[$user_data['id']]);
					if ($qty_exceed == true) {
						//if user already put an item on cart do this
						$is_exist = $this->check_product($input, $orders, $user_data['id'], $price['price']);
						if (!$is_exist) {
							$new_orders[$user_data['id']] = $this->list_of_orders($input, $price, $user_data);
							array_push($orders[$user_data['id']], $new_orders[$user_data['id']]);
							$this->session->set_userdata("orders", $orders);
						}
						else {			
							//do nothing
						}
					}
					else {
						$this->session->set_flashdata("failed", "Unable to add this item to cart quantity exceed the limit");
					}
					
				}
				//if cart is empty do this
				else {
					$new_orders = $this->list_of_orders($input, $price, $user_data);
					$orders[$user_data['id']][0] = $new_orders;
					$this->session->set_userdata("orders", $orders);
				}					
				$this->load_nav($input['id']);
			}
			else{
				redirect("customers/to_login_register");
			}
			
		}
		// user added product on cart
		public function list_of_orders($input, $price, $user_data) {
			return array("prodname"=> $input['prod_name'],
								"prodimage"=> $input['prod_img'],
								"prod_id" => $input['id'],
								"user_id" => $user_data['id'],
								"price"=> $price['price'],
								"quantity"=> $input['quantity'],
								"tot_price"=> $price['price'] * $input['quantity']);
		}

		//check if product already exist on the cart, if it existing add quantity
		public function check_product($input, $cart, $user_id, $price) {
			$exist = false;
			foreach ($cart[$user_id] as $key => $value) {
				if ($input['id'] == $value['prod_id']) {
					$cart[$user_id][$key]['quantity'] = $cart[$user_id][$key]['quantity'] + $input['quantity'];
					$cart[$user_id][$key]['tot_price'] =  $price * $cart[$user_id][$key]['quantity'];
					$this->session->set_userdata("orders", $cart);
					return true;
				}
				else {
					$exist = false;
				}
			}
			return $exist;
		}

		public function check_quantity($input, $cart) {
			foreach ($cart as $key => $value) {
				if ($input['qty'] >= $value['quantity'] + $input['quantity']) {
					return true;
				}
				else {
					return false;
				}
			}

		}
		public function checkout() {
			$tot_amount = 0;
			$user_data = $this->Session->get_session_userdata();
			if ($this->Session->user_already_exist_in_cart($user_data['id'])) {
				$orders = $this->Session->get_order_session();
				foreach ($orders[$user_data['id']] as $key => $value) {
					$tot_amount = $tot_amount + $value['tot_price'];
					
				}
			}
			else {
				//do nothing
			}
			$data['tot_amount'] = $tot_amount;
			$data['success'] = ($this->session->flashdata("success") == TRUE) ? 
			$this->session->flashdata("success") : "";
			$this->load->view("customer/payment", $data);
		}

		public function handlePayment() {
			$orders = $this->Session->get_order_session();
			$info = $this->Session->get_session_userdata();
			$id = $info['id']; 
			$tot_amount = 0;
			$token = $this->input->post('stripeToken');
			foreach ($orders[$id] as $key => $value) {
				$tot_amount = $tot_amount + $value['tot_price'];
			}
			$customer_email = $this->Customer->get_email($id);
	      	$customer = $this->stripe_lib->create_customer($customer_email['email'], $token);
	      	if ($customer == true) {
	      		$charge = $this->stripe_lib->create_charge($tot_amount, $customer->id);
	      		if ($charge == true) {
	      			$address = $this->Customer->get_address($id);
					$shipping_address = $address[0];
					$billing_address = $address[1];
					$this->Customer->save_orders_transactions($shipping_address, $billing_address, $orders, $info);
					$this->session->set_flashdata('success', 'Payment has been successful.');
					redirect("cart/checkout"); 
	      		}
	      		else {
	      			$this->session->set_flashdata('success', 'Error: Failed to pay the products, Please try again.');
					redirect("cart/checkout"); 
	      		}	
	      	}
	      	else {
	      		$this->session->set_flashdata('success', 'Error: Failed to pay the products, Please try again.');
				redirect("cart/checkout"); 
	      	}
				
    	}

		public function review() {
			$input = $this->input->post();
			$result = $this->Customer->review($input);
			redirect("orderhistory");
		}

		public function edit_billing_address($id) {
			$input = $this->input->post();
			$result = $this->Customer->update_billing_address($input, $id);
			if ($result == true) {
				redirect("customers/cart");
			}
			else{
				echo "Error";
			}
		}
		public function delete_cart_items($key) {
			$user_data = $this->Session->get_session_userdata();
			$id = $user_data['id'];
			$arr = $this->session->userdata("orders");
			if (sizeof($arr[$id]) > 1) {
				unset($arr[$id][$key]);
			}
			else {
				unset($arr[$id]);
			}	
			$this->session->set_userdata("orders", $arr);
			redirect("customers/cart");
		}

		public function load_nav($prod_id) {
			if ($this->Session->is_loggedin()) {
				$user_info['info'] = $this->Session->get_session_userdata();
				$user_info['name'] = $this->user_name($user_info['info']);
				$id = $user_info['info']['id'];
				$qty = 0;
				$orders = ($this->Session->user_already_exist_in_cart($id)) ? $this->Session->get_order_session() : [$id => "null"];
				if ($orders[$id] != "null") {
					foreach ($orders[$id] as $key => $value) {
						if ($value['prod_id'] == $prod_id) {
							$qty = $value['quantity'];
						}
						else {
							$qty = 0;
						}
					}
				}
				$user_info['cart_qty'] = $qty;
				$this->load->view("partials_customer/navbar_main", $user_info);  
			}
			else{
				$this->load->view("partials_customer/navbar_guest");  
			}
		}
		public function user_name($info) {
			$name = (sizeof($info) > 0) ? $info['fname']." ".$info['lname'] : "";
			if (strlen($name) > 12) {
				return substr($name, 0, 12)."..";
			}
			else {
				return $name;
			}
		}
	}

?>