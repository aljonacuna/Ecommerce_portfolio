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
			$page = $input['page'];
			$search[$input['key']] = $input['search_paging'];
			$this->load->view("partials_admin/dashboard_page", $this->get_pagination_data($page, $search));
		}

		public function render_orders() {
			$param['search_orders'] = "";
			$this->load->view("partials_admin/dashboard_page", $this->get_pagination_data(1, $param));
		}
		public function switch_page() {
			$input = $this->input->post();
			$page = $input['page'];
			$search[$input['key']] = $input['search_paging'];
			$this->load->view("partials_admin/dashboard_page", $this->get_pagination_data($page, $search));
		}
		public function sort_by_status($sort_param) {
			$sort['status_sort'] = $sort_param;
			$this->load->view("partials_admin/dashboard_page", $this->get_pagination_data(1, $sort));
		}
		public function search_orders($search_param) {
			$search['search_orders'] = $search_param;
			$this->load->view("partials_admin/dashboard_page", $this->get_pagination_data(1, $search));
		}

		public function get_pagination_data($page, $search_sort_param) {
			$key = 	(isset($search_sort_param['search_orders']) ? "search_orders" : 
					(isset($search_sort_param['status_sort']) ? "status_sort" : ""));
			$search_sort = isset($search_sort_param[$key]) ? $search_sort_param[$key] : "";
			$num_of_result = 5;
			$rows = $this->Admin->get_transactions_total_count($search_sort, $key);
			$num_of_page = (round($rows / $num_of_result) + 1 >= intval($page) + 2) ? 
			intval($page) + 2 : round($rows / $num_of_result) + 1; 
			$start = (intval($page)-1) * $num_of_result;
			// $data["msg"] = ($this->session->flashdata("msg_orders") == TRUE) ?
			//  $this->session->flashdata("msg_orders") : "";
            $data['links_end'] = $num_of_page;
            $data['links_start'] = intval($page);
            $data['max_page'] = round($rows / $num_of_result);
            $data['page'] = intval($page);
            $data['search'] = $search_sort;
            $data['key'] = $key;
            $data['num_orders'] = $this->Admin->dashboard_num_order("");
			$data['process'] = $this->Admin->dashboard_num_order("0");
			$data['shipped'] = $this->Admin->dashboard_num_order("1");
			$data['canceled'] = $this->Admin->dashboard_num_order("2");
        	$data['token'] = $this->security->get_csrf_hash();
			$data['orders'] = $this->Admin->get_transactions($start, $num_of_result, $search_sort, $key);
			return $data;
		}
	}


?>