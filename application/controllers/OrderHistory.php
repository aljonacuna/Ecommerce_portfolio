<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class OrderHistory extends CI_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->model("Customer");
			$this->load->model("Session");
		}

		public function render_html() {
			$this->display("");
		}
		public function switch_tab($tab) {
			$which_tab = ($tab == 9) ? "" : $tab;
			$this->display($which_tab);
		}

		public function display($tab) {
			$data['info'] = ($this->Session->is_loggedin()) ?
			$this->Session->get_session_userdata() : array();
			$data['order_history'] = $this->Customer->order_history($data['info']['id'], $tab);
			if (is_null($data['order_history']) || sizeof($data['order_history']) == 0) {
				if ($tab == "" || $tab == 0) {
					$data['lbl'] = "No orders yet";
				}
				else if ($tab == 1) {
					$data['lbl'] = "No shipped orders yet";
				}
				else {
					$data['lbl'] = "No canceled orders yet";
				}
				
				$this->load->view("partials_customer/empty_order", $data);
			}
			else {
				$this->load->view("partials_customer/purchases", $data);
			}
			
		}	
	}

?>