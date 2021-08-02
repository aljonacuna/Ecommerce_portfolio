<?php 

	class AjaxCustomers extends CI_Controller {
		
		public function __construct() {
			parent::__construct();
			$this->load->model("Customer");
		}

		public function render_products() {
			$filter['search'] = "";
			$this->load->view("partials_customer/home_customer", $this->get_pagination_data(1, $filter));
		}

		public function sort_by($sort_param) {
			$filter['sort'] = $sort_param;
			$this->load->view("partials_customer/home_customer",$this->get_pagination_data(1, $filter));
		}

		public function search_category($category_param) {
			$filter['category'] = $category_param;
			$this->load->view("partials_customer/home_customer",$this->get_pagination_data(1, $filter));
		}
		public function search_prodname($search_param) {
			$filter['search'] = $search_param;
			$this->load->view("partials_customer/home_customer",$this->get_pagination_data(1, $filter));
		}

		public function isSearch() {
			if ($this->session->userdata("search") == FALSE) {
				return true;
			}
			else {
				return false;
			}
		}


		public function switchpage() {
			$input = $this->input->post();
			$page = $input['page'];
			$filter[$input['key']] = $input['search'];
			$this->load->view("partials_customer/home_customer",$this->get_pagination_data($page, $filter));
		}

		public function get_pagination_data($page_value, $search_sort_param) {
			$key = 	(isset($search_sort_param['search']) ? "search" : 
					(isset($search_sort_param['sort']) ? "sort" : 
					(isset($search_sort_param['category']) ? "category" : "")));
			$search_sort = isset($search_sort_param[$key]) ? $search_sort_param[$key] : "";
			$num_of_result = 12;
			$page = intval($page_value);
			$rows = $this->Customer->get_totprod_count($search_sort_param[$key], $key);
			$num_of_page = (round($rows / $num_of_result) + 1 >= $page + 8) ? $page + 8 : round($rows / $num_of_result) + 1; 
			$start = ($page-1) * $num_of_result;
            $data['links_end'] = $num_of_page;
            $data['links_start'] = $page;
            $data['max_page'] = round($rows / $num_of_result);
            $data['page'] = $page;
            $data['search'] = $search_sort;
            $data['key'] = $key;
            $data['current_category'] =  (isset($search_sort_param["category"])) ? $search_sort_param["category"] : "";
            $data['sort_by'] = (isset($search_sort_param["sort"])) ? $search_sort_param["sort"] : "";
			$data['products'] = $this->Customer->get_all_products($start, $num_of_result, $search_sort_param[$key], $key);
			$data['token'] = $this->security->get_csrf_hash();
			return $data;
		}
	}

?>