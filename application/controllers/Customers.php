<?php
	
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
			$data['orders'] = ($this->Session->is_cartnotempty()) ? 
			$this->Session->get_order_session() : array();
			$data['info'] = ($this->Session->is_loggedin()) ?
			$this->Session->get_session_userdata() : array();
			$data['similar_products'] = $this->Customer->get_similar_products($category_id);
			$data['reviews'] = $this->Customer->get_review($prod_id);
			$data['avg_reviews'] = $this->Customer->get_avg_review($prod_id);
			$data['is_loggedin'] = ($this->Session->is_loggedin()) ? 
			$this->Session->get_session_userdata() : "no";
			foreach ($data['similar_products'] as $value) {
				if ($prod_id == $value['id']) {
					$data['product'] = array("id"=>$value['id'], 
											"name"=>$value['name'], 
											"price"=>$value['price'],
											"category_id" =>$category_id,
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
			$this->load->view("customer/show_product",$data);
		}


		//save to session the add to cart products
		public function addtocart() {
			if ($this->Session->is_loggedin()) {
				$user_data = $this->Session->get_session_userdata();
				$input = $this->input->post();
				$price = $this->Customer->get_price($input['id']);
				$new_orders = array("prodname"=> $input['prod_name'],
								"prod_id" => $input['id'],
								"user_id" => $user_data['id'],
								"price"=> $price['price'],
								"quantity"=> $input['quantity'],
								"tot_price"=> $price['price'] * $input['quantity']);

				if ($this->Session->is_cartnotempty()) {
					$orders = $this->Session->get_order_session();
					array_push($orders, $new_orders);
					$this->session->set_userdata("orders",$orders);
				}
				else {
					$this->session->set_userdata("orders",array($new_orders));
				}
				redirect("customers/show_product/".$input['id']."/".$input['category_id']);
			}
			else{
				redirect("customers/to_login_register");
			}
			
		}

		//loading the view of home page
		public function home() {
			$data['categories'] = $this->Customer->get_all_categories();
			//to check if guest or logged in user if user currently logged in i will pass the users info
			$data['is_loggedin'] = ($this->Session->is_loggedin()) ? 
			$this->Session->get_session_userdata(): "no";
			$this->load->view("customer/home", $data);
		}
		//redirect to cart function
		public function cart() {
			if ($this->Session->is_loggedin()) {
				$info = $this->Session->get_session_userdata();
				$id = $info['id']; 
				$address = $this->Customer->get_address($id);
				$data['shipping_address'] = $address[0];
				$data['billing_address'] = $address[1];
				$data['orders'] = ($this->Session->is_cartnotempty()) ? $this->Session->get_order_session() : "";
				$data['user_info'] = $info;
				$this->load->view("customer/cart",$data);
			}
			else{
				$this->login_customer();
			}
			
		}
		public function checkout() {
			date_default_timezone_set("Asia/Manila");
			$date = date("Y-m-d H:i:s");
			$info = $this->Session->get_session_userdata();
			$id = $info['id']; 
			$address = $this->Customer->get_address($id);
			$orders= $this->Session->get_order_session();
			$this->Customer->save_orders_transactions($address, $orders, $info);
			redirect("customers/cart");
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
			$isValid = $this->Customer->login($input);
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
			$this->session->unset_userdata("info");
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
			$this->load->view("customer/registration_login",$msg_and_active);
		}
		public function delete_cart_items($key) {
			$arr = $this->session->userdata("orders");
			unset($arr[$key]);
			$this->session->set_userdata("orders",$arr);
			$this->cart();

		}
		public function order_history() {
			$data['orders'] = ($this->Session->is_cartnotempty()) ? 
			$this->Session->get_order_session() : array();
			$data['info'] = ($this->Session->is_loggedin()) ?
			$this->Session->get_session_userdata() : array();
			$data['order_history'] = $this->Customer->order_history($data['info']['id']);
			$this->load->view("customer/order_history",$data);
		}
		public function review() {
			$input = $this->input->post();
			$result = $this->Customer->review($input);
			redirect("customers/order_history");
		}
	}




?>