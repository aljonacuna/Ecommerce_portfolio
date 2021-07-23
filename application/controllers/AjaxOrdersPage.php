<?php

	class AjaxOrdersPage extends CI_Controller {
		
		public function __construct() {
			parent::__construct();
			$this->load->model("Admin");
			$this->load->model("Session");
		}
		public function orders_status() {
			$input = $this->input->post();
			$this->Admin->set_order_status($input);
			$this->load->view("partials_admin/dashboard_page", $this->get_pagination_data(1));
		}

		public function render_orders() {
			$this->load->view("partials_admin/dashboard_page", $this->get_pagination_data(1));
		}
		public function switch_page() {
			$input = $this->input->post("page");
			$this->load->view("partials_admin/dashboard_page", $this->get_pagination_data($input));
		}
		public function sort_by_status() {
			$to_search = $this->input->post();
			$this->session->set_userdata("search_orders", $to_search);
			$this->load->view("partials_admin/dashboard_page", $this->get_pagination_data(1));
		}
		public function search_orders() {
			//if search box is empty reset the session so it will display all the items again
			if(strlen($this->input->post("search_orders")) == 0) {
				if ($this->session->userdata("search_orders") == TRUE) {
					$this->session->unset_userdata("search_orders");
				} 
			}

			//if there is no session and post is not empty add the current post data to session
			if ($this->session->userdata("search_orders") == FALSE) {
				$to_search = ($this->input->post("search_orders") == TRUE) ? $this->input->post() : "";
				$this->session->set_userdata("search_orders", $to_search);
			}
			//else if post is empty add the session data to search else add the post data
			else {
				$to_search = ($this->input->post("search_orders") == FALSE) ?
				 $this->session->userdata("search_orders") : $this->input->post();
				$this->session->set_userdata("search_orders", $to_search);
			}
			$this->load->view("partials_admin/dashboard_page", $this->get_pagination_data(1));
		}

		public function get_pagination_data($page) {
			$num_of_result = 5;
			$rows = $this->Admin->get_transactions_total_count();
			$num_of_page = (round($rows / $num_of_result) + 1 >= $page + 2) ? $page + 2 : round($rows / $num_of_result) + 1; 
			$start = ($page-1) * $num_of_result;
			// $data["msg"] = ($this->session->flashdata("msg_orders") == TRUE) ?
			//  $this->session->flashdata("msg_orders") : "";
            $data['links_end'] = $num_of_page;
            $data['links_start'] = $page;
            $data['max_page'] = round($rows / $num_of_result);
            $data['page'] = $page;
			$data['orders'] = $this->Admin->get_transactions($start, $num_of_result);
			return $data;
		}
	}


?>