<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Admins extends CI_Controller {
		
		public function __construct() {
			parent::__construct();
			$this->load->model("Admin");
			$this->load->model("Session");
		}

		public function index() {
			$msg['msg_login'] = ($this->session->flashdata("msg_login") == TRUE) ?
			$this->session->flashdata("msg_login") : "";
			$this->load->view("admin/admin_login",$msg);
		}
		public function to_orders() {
			if ($this->Session->is_loggedin()) {
				$is_admin = $this->Session->get_session_userdata();
				$data['orders'] = "orders";
				$data['num_orders'] = $this->Admin->dashboard_num_order("");
				$data['process'] = $this->Admin->dashboard_num_order("0");
				$data['shipped'] = $this->Admin->dashboard_num_order("1");
				$data['canceled'] = $this->Admin->dashboard_num_order("2");
				$this->load->view("admin/dashboard", $data);
			}
			else{
				$this->index();
			}
		}
		function orders() {
			$this->to_orders();
		}
		public function login() {
			$this->load->model("Customer");
			$input = $this->input->post();
			$result = $this->Customer->login($input);	
			if ($result== TRUE && $result['user_role'] == 0) {
				redirect("admins/orders");
			}
			else{
				redirect("admins/index");
			}
		}

		public function logoff() {
			$this->session->unset_userdata("info");
			redirect("admins/index");
		}
		public function showorder($id) {
			if ($this->Session->is_loggedin()) {
				$limit =  $this->Admin->get_transactions_total_count();
				$temp = $this->Admin->get_transactions(0, $limit);
				$data['orders'] = $this->Admin->get_list_orders($id);
				$array = array();
				foreach ($temp as $value) {
					if ($value['id'] == $id) {
						$data["customer_info"] = $value;
					}
				}
				$this->load->view("admin/showorder", $data);
			}
			else{
				redirect("admins/index");
			}
			
		}


		//start product page
		public function product_page() {
			if ($this->Session->is_loggedin()) {
				$data['products'] = "products";
				$this->load->view("admin/product_page", $data);
			}
			else {
				redirect("admins/index");
			}
	
		}

		public function add_product_page() {
			$data['products'] = "products";
			$data['categories'] = $this->Admin->get_all_categories();
			$this->load->view("admin/add_product", $data);
		}

		public function edit_product($id) {
			$data['products'] = "products";
			$data['categories'] = $this->Admin->get_all_categories();
			$data['product'] = $this->Admin->get_product_by_id($id);
			$data['category'] = $this->Admin->get_category_byid($data['product']['category_id']);
			$img_explode = explode(",", $data['product']['image']);
			$thumb_image = array();
			foreach ($img_explode as $key => $value) {
				if (substr($value, 0, 5) == "main:") {
					$data['main_image'] = substr($value, 5, strlen($value));
				}
				else{
					array_push($thumb_image, $value);
				}
			}
			$data['thumb_images'] = $thumb_image;
			$this->load->view("admin/edit_product", $data);
		}

		public function edit_add_product() {
			$input = $this->input->post();
			$tag = $input['tag'];
			$url = ($tag == "add") ? "add_product_page" : "edit_product/".$input['id'];
			$data = array();
			if (!empty($_FILES['products_image']['name'][0])) {
				$filesCount = count($_FILES['products_image']['name']);
				if($filesCount >= 5) {
		            for ($i = 0 ; $i < $filesCount ; $i++) {
		            	$_FILES['upload_File']['name'] = $_FILES['products_image']['name'][$i]; 
		            	$_FILES['upload_File']['type'] = $_FILES['products_image']['type'][$i]; 
		            	$_FILES['upload_File']['tmp_name'] = $_FILES['products_image']['tmp_name'][$i]; 
		            	$_FILES['upload_File']['error'] = $_FILES['products_image']['error'][$i]; 
		            	$_FILES['upload_File']['size'] = $_FILES['products_image']['size'][$i]; 
		            	$config['upload_path'] = "./uploads/"; 
		            	$config['allowed_types'] = 'png|gif|jpg|jpeg';
		            	$this->load->library('upload', $config);
		                $this->upload->initialize($config);
		                if ($this->upload->do_upload('upload_File')) {	                	
		                    $fileData = $this->upload->data();
		                    $uploadData[$i]['file_name'] = $fileData['file_name'];
		                    $data = $uploadData;
		                }
		                else {
		                	echo $this->upload->display_errors();
		                }
		            }            
		            $new_data = array();
					$main = $input['radio'];
					foreach ($data as $key => $value) {
						$count+=1;
						if ($count == $main) {
							array_push($new_data, "main:".$value['file_name']);
						}
						else {
							array_push($new_data, $value['file_name']);
						}
					}
					$img_to_str = "";
					foreach ($new_data as $key => $value) {
						if ($img_to_str == "") {
							$img_to_str = $value;
						}
						else {
							$img_to_str = $img_to_str.",".$value;
						}
					}
					$this->Admin->edit_add_product($input, $img_to_str);
					// redirect("admins/".$url);
				}
				else {
					$this->session->set_flashdata("msg","Please upload image");
					// redirect("admins/".$url);
				}
				
			}
			else {
				if($tag == "edit") {
					$result = $this->Admin->edit_add_product($input, "");
					redirect("admins/".$url);
				}
				else {
					$this->session->set_flashdata("msg","Please upload image");
					// redirect("admins/".$url);
				}
			}
		}

	}


?>