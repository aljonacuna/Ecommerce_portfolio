<?php

	class AjaxProductsPage extends CI_Controller {

		public function __construct() {
			parent::__construct();
			$this->load->model("Admin");
		}


		public function search() {
			if(strlen($this->input->post("search")) == 0) {
				if ($this->session->userdata("search") == TRUE) {
					$this->session->unset_userdata("search");
				} 
			}
			$this->load->view("partials_admin/product_page", $this->get_pagination_data(1));
		}

		 
		public function render_productpage() {
			$this->load->view("partials_admin/product_page", $this->get_pagination_data(1));
		}

		public function switch_page() {
			$input = $this->input->post("page");
			$this->load->view("partials_admin/product_page", $this->get_pagination_data($input));
		}
		public function get_pagination_data($page){
			//if there is no session and post is not empty add the current post data to session
			if ($this->session->userdata("search") == FALSE) {
				$to_search = ($this->input->post("search") == TRUE) ? $this->input->post() : "";
				$this->session->set_userdata("search", $to_search);
			}
			//else if post is empty add the session data to search else add the post data
			else {
				$to_search = ($this->input->post("search") == FALSE) ? $this->session->userdata("search") : 
				$this->input->post();
				$this->session->set_userdata("search", $to_search);
			}
			$num_of_result = 3;
			$rows = $this->Admin->prod_tot_num();
			$num_of_page = (round($rows / $num_of_result) + 1 >= $page + 2) ? $page + 2 : round($rows / $num_of_result) + 1; 
			$start = ($page-1) * $num_of_result;
			$data["msg"] = ($this->session->flashdata("msg") == TRUE) ? $this->session->flashdata("msg") : "";
            $data['links_end'] = $num_of_page;
            $data['links_start'] = $page;
            $data['max_page'] = round($rows / $num_of_result);
            $data['page'] = $page;
			$data['products'] = $this->Admin->products_admin($start, $num_of_result);
			$sold = array();
			foreach ($data['products'] as $value) {
				array_push($sold, $this->Admin->get_quantitysold($value['id']));
			}
			$data['sold'] = $sold;
			return $data;
		}
	}

?>