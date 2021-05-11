<?php
	class Session extends CI_Model {
		
		//get the users info on the session
		public function get_session_userdata() {
			return $this->session->userdata("info");
		}

		//to check if there are currently logged in user
		public function is_loggedin() {
			if ($this->session->userdata("info") == TRUE) {
				return true;
			}
			else{
				return false;
			}
		}


		//get orders session 
		public function get_order_session() {
			return $this->session->userdata("orders");
		}

		//to check if there are orders in cart
		public function is_cartnotempty() {
			if ($this->session->userdata("orders") == TRUE) {
				return true;
			}
			else{
				return false;
			}
		}

		public function isSearch_notempty() {
			if ($this->session->userdata("search_orders") == TRUE) {
				return true;
			}
			else{
				return false;
			}
		}
		public function search_orders() {
			return $this->session->userdata("search_orders");
		}	
	}


?>