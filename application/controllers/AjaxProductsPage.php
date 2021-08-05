<?php

	class AjaxProductsPage extends CI_Controller {

		public function __construct() {
			parent::__construct();
			$this->load->model("Admin");
		}


		public function search($search) {
			$this->load->view("partials_admin/product_page", $this->get_pagination_data(1, $search));
		}

		 
		public function render_productpage() {
			$this->load->view("partials_admin/product_page", $this->get_pagination_data(1, "1"));
		}

		public function switch_page() {
			$input = $this->input->post();
			$this->load->view("partials_admin/product_page", $this->get_pagination_data($input, ""));
		}
		public function delete_product() {
			$input = $this->input->post();
			$id = $input['prod_id'];
			$page = $input["current_page"];
			$result = $this->Admin->delete_product($id);
			$this->load->view("partials_admin/product_page", $this->get_pagination_data($page, ""));
		}
		public function get_pagination_data($post, $search){
			$page = isset($post['page']) ? $post['page'] : $post;
			$search = (isset($post['search_paging']) ? $post['search_paging'] : ($search == "1" ? "" : $search));
			$num_of_result = 5;
			$rows = $this->Admin->prod_tot_num($search);
			$num_of_page = (round($rows / $num_of_result) + 1 >= intval($page)+ 2) 
			? intval($page)+ 2 : round($rows / $num_of_result) + 1; 
			$start = (intval($page)-1) * $num_of_result;
			// $data["msg"] = ($this->session->flashdata("msg") == TRUE) ? $this->session->flashdata("msg") : "";
            $data['links_end'] = $num_of_page;
            $data['links_start'] = intval($page);
            $data['max_page'] = round($rows / $num_of_result);
            $data['page'] = intval($page);
            $data['search'] = $search;
			$data['products'] = $this->Admin->products_admin($start, $num_of_result, $search);
			$sold = array();
			foreach ($data['products'] as $value) {
				array_push($sold, $this->Admin->get_quantitysold($value['id']));
			}
			$data['sold'] = $sold;
			$data['token'] = $this->security->get_csrf_hash();
			return $data;
		}
	}

?>