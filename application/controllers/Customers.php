<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Customers extends CI_Controller {
		
		public function __construct() {
			parent::__construct();
			
			$this->load->model("Customer");
			$this->load->model("Session");
		}
		public function index() {
			$this->home();
		}

		//get the products to dispaly on homepage
		public function show_product($prod_id, $category_id) {
			if($this->Session->is_loggedin("customer")) {
				// $this->session->unset_userdata('orders');
				$qty = 0;
				$data['info'] = $this->Session->get_session_userdata("customer");
				$id = $data['info']['id'];
			}
			else {
				$data['orders'] = array();
				$data['info'] = array();
			}
			$data['similar_products'] = $this->Customer->get_similar_products($category_id);
			$data['reviews'] = $this->Customer->get_review($prod_id);
			$data['avg_reviews'] = $this->Customer->get_avg_review($prod_id);
			foreach ($data['similar_products'] as $value) {
				if ($prod_id == $value['id']) {
					$data['product'] = array("id"=>$value['id'], 
											"name"=>$value['name'], 
											"price"=>$value['price'],
											"category_id" =>$category_id,
											"qty"=>$value['quantity'],
											"desc"=>$value['description']);
					$img_explode = explode(",", $value['image']);
					$array_images = array();
					foreach ($img_explode as $value_images) {
						if (substr($value_images, 0,5) == "main:") {
							$data['main_image'] = substr($value_images, 5,strlen($value_images));
						}
						else{
							array_push($array_images, $value_images);
						}
					}
					$data['sub_images'] = $array_images;
				}
				
			}
			// $this->output->enable_profiler(1);
			$this->load->view("customer/show_product",$data);
		}

		public function cart() {
			if ($this->Session->is_loggedin("customer")) {
				$info = $this->Session->get_session_userdata("customer");
				$id = $info['id'];
				$orders = ($this->Session->user_already_exist_in_cart($id)) ? $this->Session->get_order_session()
				 : [$id => "null"];
				$address = $this->Customer->get_address($id);
				$data['shipping_address'] = $address[0];
				$data['billing_address'] = $address[1];
				$data['is_loggedin'] = ($this->Session->is_loggedin("customer")) ? 
				$this->Session->get_session_userdata("customer") : "no";
				$data["cart"] = ($this->Session->user_already_exist_in_cart($id) && $orders[$id] != "null") ? true : false;
				$data['orders'] = $orders[$id];
				$data['user_info'] = $info;
				$data['name'] = $this->user_name($info);
				$this->load->view("customer/cart", $data);
			}
			else{
				$this->login_customer();
			}
			
		}

		public function order_history() {
			if ($this->Session->is_loggedin("customer")) {
				$data['is_loggedin'] = $this->Session->get_session_userdata("customer");
				$data['orders'] = ($this->Session->is_cartnotempty()) ? 
				$this->Session->get_order_session() : array();
				$data['info'] = $this->Session->get_session_userdata("customer");
				$data['name'] = $this->user_name($data['info']);
				$this->load->view("customer/order_history", $data);
			}
			else {
				redirect("customers/to_login_register");
			}
			
		}
	

		//loading the view of home page
		public function home() {
			$data['categories'] = $this->Customer->get_all_categories();
			//to check if guest or logged in user if user currently logged in i will pass the users info
			$data['is_loggedin'] = ($this->Session->is_loggedin("customer")) ? 
			$this->Session->get_session_userdata("customer"): "no";
			$info = ($this->Session->is_loggedin("customer")) ?
			$this->Session->get_session_userdata("customer") : array();
			$data['name'] = $this->user_name($info);
			$this->load->view("customer/home", $data);
		}
		
		//register method of users
		public function register_customer() {
			$user_role = 1;
			$input = $this->input->post();
			$result = $this->Customer->register($input, $user_role);
			if ($result == TRUE) {
				redirect("customers/to_login_register");
			}
			else{
				$this->session->set_flashdata("is_login_register","register");
				redirect("customers/to_login_register");
			}
		}


		//this is the process of authentication of users
		public function login_customer() {
			$input = $this->input->post();
			$isValid = $this->Customer->login($input, "customer");
			if ($isValid) {
				redirect("/");
			}
			else{
				$this->session->set_flashdata("is_login_register","login");
				redirect("customers/to_login_register");
			}
		}

		//this is the logout method of users
		public function logoff_customer() {
			$this->session->unset_userdata("info_customer");
			$this->session->set_flashdata("is_login_register","login");
			redirect("customers/to_login_register");
		}


		//use to load the view of login and registration
		public function to_login_register() {
			$msg_and_active['active'] = ($this->session->flashdata("is_login_register") == TRUE) ? 
			$this->session->flashdata("is_login_register") : "login";
			$msg_and_active['msg_reg'] = ($this->session->flashdata("msg_reg") == TRUE) ?
			$this->session->flashdata("msg_reg") : "";
			$msg_and_active['msg_login'] = ($this->session->flashdata("msg_login") == TRUE) ?
			$this->session->flashdata("msg_login") : "";
			$this->load->view("customer/registration_login", $msg_and_active);
		}

		public function myaccount() {
			if ($this->Session->is_loggedin("customer")) {
				$info = $this->Session->get_session_userdata("customer");
				$data['is_loggedin'] = $info;
				$data['name'] = $this->user_name($info);
				$this->load->view("customer/myaccount", $data);
			}
			else {
				redirect("customers/to_login_register");
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