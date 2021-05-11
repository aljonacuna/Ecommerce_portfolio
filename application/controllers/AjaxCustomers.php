<?php 

	class AjaxCustomers extends CI_Controller {
		
		public function __construct() {
			parent::__construct();
			$this->load->model("Customer");
		}

		public function render_products() {
			$this->load->view("partials_customer/home_customer",$this->get_pagination_data(1));
		}

		public function search_category() {
			//if there is no session and post is not empty add the current post data to session
			if ($this->session->userdata("search") == FALSE) {
				$to_search = ($this->input->post("category") == TRUE) ? $this->input->post() : "";
				$this->session->set_userdata("search", $to_search);
			}
			//else if post is empty add the session data to search else add the post data
			else {
				$to_search = ($this->input->post("category") == FALSE) ? $this->session->userdata("search") : 
				$this->input->post();
				$this->session->set_userdata("search", $to_search);
			}
			$this->load->view("partials_customer/home_customer",$this->get_pagination_data(1));
		}
		public function search_prodname() {
			//if search box is empty reset the session so it will display all the items again
			if(strlen($this->input->post("search")) == 0) {
				if ($this->session->userdata("search") == TRUE) {
					$this->session->unset_userdata("search");
				} 
			}

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
			$this->load->view("partials_customer/home_customer",$this->get_pagination_data(1));
		}


		public function switchpage() {
			$input = $this->input->post("page");
			$this->load->view("partials_customer/home_customer",$this->get_pagination_data($input));
		}

		public function get_pagination_data($page) {
			
			$num_of_result = 9;
			$rows = $this->Customer->get_totprod_count();
			$num_of_page = (round($rows / $num_of_result) >= $page + 8) ? $page + 8 : round($rows / $num_of_result) ; 
			$start = ($page-1) * $num_of_result;
            $data['links_end'] = $num_of_page;
            $data['links_start'] = $page;
            $data['max_page'] = round($rows / $num_of_result);
            $data['page'] = $page;
            $data['current_category'] = ($this->input->post("category") == TRUE) ? $this->input->post("category") : "";
			$data['products'] = $this->Customer->get_all_products($start, $num_of_result);
			return $data;
		}
	}

?>