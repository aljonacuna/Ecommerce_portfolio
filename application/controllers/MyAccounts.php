<?php

	class MyAccounts extends CI_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->model("Customer");
			$this->load->model("Session");
		}

		public function index() {
			$this->switch_page("info-btn");
		}

		public function update_user_info($id){
			$data['info'] = $this->Session->get_session_userdata();
			$input = $this->input->post();
			$result = $this->Customer->update_user_info($input, $data['info']['email'], $id);
			$this->switch_page("info-btn");
		}

		public function update_address($role_id) {
			$input = $this->input->post();
			$result = $this->Customer->update_address($input, $role_id);
			$this->switch_page("address-btn");
		}

		public function changepass($id) {
			$input = $this->input->post();
			$result = $this->Customer->changepass($input, $id);
			$this->switch_page("changepass-btn");
		}

		public function switch_page($page) {
			$data['info'] = $this->Session->get_session_userdata();
			if ($page == "info-btn") {
				$data['msg'] = ($this->session->flashdata("msg") == TRUE) ? $this->session->flashdata("msg") : "";
				$this->load->view("partials_customer/user_info", $data);
			}
			else if ($page == "address-btn") {
				$id = $data['info']['id'];
				$data['msg'] = ($this->session->flashdata("msg_address") == TRUE) ? $this->session->flashdata("msg_address") : "";
				$address = $this->Customer->get_address($id);
				$data['shipping_address'] = $address[0];
				$data['billing_address'] = $address[1];
				$this->load->view("partials_customer/address_profile", $data);
			}
			else if ($page == "changepass-btn") {
				$data['msg'] = ($this->session->flashdata("msg_changepass") == TRUE) ? 
				$this->session->flashdata("msg_changepass") : "";
				$this->load->view("partials_customer/change_pass", $data);
			}
			else {
				//do nothing
			}
		}
	}

?>