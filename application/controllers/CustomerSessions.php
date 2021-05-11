<?php
	class ClassName extends AnotherClass {
		
		//get the users info on the session
		public function get_sessiondata() {
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
	}


?>