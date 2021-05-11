<?php
	class Redirect extends CI_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->model("Admin");
		}
		public function add_product() {
			$data['products'] = "products";
			$data['categories'] = $this->Admin->get_all_categories();
			$this->load->view("admin/product_page",$data);
		}
		public function cart() {
			$this->load->view("customer/cart");
		}
		
	}

?>