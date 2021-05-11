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
		public function dashboard() {
			if ($this->Session->is_loggedin()) {
				$is_admin = $this->Session->get_session_userdata();
				$data['orders'] = "orders";
				$this->load->view("admin/dashboard",$data);
			}
			else{
				$this->index();
			}
		}

		public function login() {
			$this->load->model("Customer");
			$input = $this->input->post();
			$result = $this->Customer->login($input);	
			if ($result== TRUE && $result['user_role'] == 0) {
				$this->dashboard();
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
				$temp = $this->Admin->get_transactions(0,$limit);
				$data['orders'] = $this->Admin->get_list_orders($id);
				$array = array();
				foreach ($temp as $value) {
					if ($value['id'] == $id) {
						$data["customer_info"] = $value;
					}
				}
				$this->load->view("admin/showorder",$data);
			}
			else{
				redirect("admins/index");
			}
			
		}


		//start product page
		public function product_page() {
			if ($this->Session->is_loggedin()) {
				$data['products'] = "products";
				$data['categories'] = $this->Admin->get_all_categories();
				$this->load->view("admin/product_page", $data);
			}
			else {
				redirect("admins/index");
			}
	
		}

		public function add_product() {
			$input = $this->input->post();
			$data = array();
			if (isset($_FILES['products_image']['name']) && !empty($_FILES['products_image']['name'])) {
				$filesCount = count($_FILES['products_image']['name']);
	            for($i = 0; $i < $filesCount; $i++){
	            	$_FILES['upload_File']['name'] = $_FILES['products_image']['name'][$i]; 
	            	$_FILES['upload_File']['type'] = $_FILES['products_image']['type'][$i]; 
	            	$_FILES['upload_File']['tmp_name'] = $_FILES['products_image']['tmp_name'][$i]; 
	            	$_FILES['upload_File']['error'] = $_FILES['products_image']['error'][$i]; 
	            	$_FILES['upload_File']['size'] = $_FILES['products_image']['size'][$i]; 

	            	$config['upload_path'] = "./uploads/"; 
	            	$config['allowed_types'] = 'png|gif|jpg|jpeg';
	            	$this->load->library('upload', $config);
	                $this->upload->initialize($config);

	                if($this->upload->do_upload('upload_File')){
	                	
	                    $fileData = $this->upload->data();
	                    $uploadData[$i]['file_name'] = $fileData['file_name'];
	                    $data = $uploadData;
	                }
	                else{
	                	echo $this->upload->display_errors();
	                }
	            }            
	            $new_data = array();
				$count = 0;
				foreach ($data as $key => $value) {
					$count+=1;
					if ($count == 1) {
						array_push($new_data, "main:".$value['file_name']);
					}
					else{
						array_push($new_data, $value['file_name']);
					}
					
				}
				$img_to_str = "";
				foreach ($new_data as $key => $value) {
					if ($img_to_str == "") {
						$img_to_str = $value;
					}
					else{
						$img_to_str = $img_to_str.",".$value;
					}
					
				}
				$this->Admin->add_product($input,$img_to_str);
				redirect("redirect/add_product");
			}
			else{
				$this->session->set_flashdata("msg","Please upload image");
				redirect("redirect/add_product");
			}
		}

	}


?>