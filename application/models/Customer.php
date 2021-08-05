<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Customer extends CI_Model {
		
		public function __construct() {
			parent::__construct();
		}

		//start of getting all the products

		public function get_all_products($start, $limit, $search, $key) {
			return $this->product_query("getprod", $start, $limit, $search, $key)->result_array();
		}

		//end of getting all the products

		/*-----------------------------------------------------------------------------------------------------------*/

		//start get product price

		public function get_price($id) {
			return $this->db->query("SELECT price from products WHERE id = ?",array($id))->row_array();
		}

		//end get product price
		/*-----------------------------------------------------------------------------------------------------------*/


		//start count all the products

		public function get_totprod_count($search, $key) {
			return $this->product_query("count", 0, 9, $search, $key)->num_rows();
		}

		//end count all the products

		public function product_query($tag, $start, $limit, $search, $key) {
			$limit = ($tag == "count") ? "" : "LIMIT ".$start.", ".$limit;
			// if ($this->session->userdata("search") == FALSE) {
			// 	return $this->db->query("SELECT * from products $limit");
			// }
			// else {
				if ($key == "category") {
					return $this->db->query("SELECT products.name, products.id, products.image, 
							products.category_id, products.price 
							FROM products 
							LEFT JOIN categories ON categories.id = products.category_id
							WHERE categories.name = ? $limit", array($search));
				}
				else if ($key == "sort") {
					if ($search == "most") {
						return $this->db->query("SELECT products.name, products.id, products.image,
								products.category_id, products.price
								FROM products 
								LEFT JOIN orders on products.id = orders.product_id
								GROUP BY products.id
								ORDER BY SUM(orders.quantity) DESC $limit");
					}
					else {
						if($search != "5") {
							$order_by = ($search == "high") ? "DESC" : "ASC";
							return $this->db->query("SELECT * FROM products
									ORDER BY price $order_by $limit");
						}
						else {
							return $this->db->query("SELECT * FROM products $limit");
						}
					}
					
				}
				else{
					$search = ($search != "1") ? "%".urldecode($search)."%" : "%%";
					return $this->db->query("SELECT * from products
											WHERE name LIKE ? 
											$limit", array($search));
				}
				
			// }
		}
		/*------------------------------------------------------------------------------------------------------*/

		//start get user address

		public function get_address($id) {
			return $this->db->query("SELECT addresses.street, addresses.city, addresses.zip,
				 addresses.town, addresses_role.role, addresses.id, addresses_role.id As role_id FROM addresses
				INNER JOIN addresses_role on addresses.id = addresses_role.address_id
				INNER JOIN users on addresses_role.user_id = users.id
				WHERE users.id = ?
				ORDER BY addresses_role.id ASC", array($id))->result_array();
		}

		//end get user address

		/*------------------------------------------------------------------------------------------------------*/

		//start of saving the user address

		public function save_address($street, $town, $city, $zip) {
			$query_check = "SELECT id FROM addresses WHERE street = ?  && town = ? && city = ?";
			if ($this->check_address($street, $city, $town, $query_check) > 0) {
				return $this->db->query("SELECT id from addresses WHERE street = ?", array($street))->row_array();
			}
			else {
				$query = "INSERT INTO addresses (street, city, zip, town) VALUES(?,?,?,?)";
				$values = array($street, $city, $zip, $town);
				$this->db->query($query, $values);
				return $this->db->insert_id();
			}
		}

		//end of saving the user address
		/*-----------------------------------------------------------------------------------------------------*/

		//edit billing address functionalities
		public function check_address($street, $city, $town, $query) {
			$values = array($street, $town, $city);
			return $this->db->query($query, $values)->num_rows();
		}

		public function update_address($post, $id) {
			$query_check = "SELECT id FROM addresses WHERE street = ?  && town = ? && city = ?";
			if ($this->check_address($post['street'], $post['city'], $post['town'], $query_check) > 0) {
				$address_id = $this->db->query("SELECT id FROM addresses WHERE street = ?", array($post['street']))->row_array();
				$result = $this->db->query("UPDATE addresses_role SET address_id = ? WHERE id = ?", 
											array($address_id['id'], $id));
				if ($result == true) {
					$this->session->set_flashdata("msg_address", "Successfully updated your address");
					return true;
				}
				else {
					$this->session->set_flashdata("msg_address", "Failed to update your address, Please try again");
					return false;
				}
			}
			else {
				$query = "INSERT INTO addresses (street, city, town, zip) VALUES(?, ?, ?, ?)";
				$values = array($post['street'], $post['city'], $post['town'], $post['zip']);
				$result = $this->db->query($query, $values);
				$address_id = $this->db->insert_id();
				if ($result == true) {
					$this->db->query("UPDATE addresses_role SET address_id = ? WHERE id = ?",
										array($address_id, $id));
					return true;
				}
				else {
					return false;
				}

			}
		}

		/*------------------------------------------------------------------------------------------------------*/


		//start of getting all the categories

		public function get_all_categories() {			
			return $this->db->query("SELECT categories.name, COUNT(products.category_id)as num_category from categories
									INNER JOIN products on products.category_id = categories.id
									GROUP BY categories.name 
									ORDER BY categories.name asc")->result_array();
		}

		//end of getting all the categories

		/*------------------------------------------------------------------------------------------------------*/

		//start of getting similar products 

		public function get_similar_products($category_id) {			
			return $this->db->query("SELECT * from products WHERE category_id = ? limit 0,12",array($category_id))->result_array();
		}

		//end of getting similar products 

		/*------------------------------------------------------------------------------------------------------*/

		//start of saving the users info

		public function register($post, $user_role) {			
			$this->form_validation->set_error_delimiters('<div class="error">','</div>');
			date_default_timezone_set("Asia/Manila");
			$date = date("Y-m-d H:i:s");
			$salt = bin2hex(openssl_random_pseudo_bytes(22));			
			$this->form_validation->set_rules("fname", "First name", "trim|required");
			$this->form_validation->set_rules("lname", "Last name", "trim|required");
			$this->form_validation->set_rules("email", "Email", "trim|required|valid_email");
			$this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]");
			$this->form_validation->set_rules("cpassword", "Confirm Password", "trim|required|matches[password]");
			$this->form_validation->set_rules("street", "Street", "trim|required");
			$this->form_validation->set_rules("city", "City", "trim|required");
			$this->form_validation->set_rules("town", "Town", "trim|required");
			$this->form_validation->set_rules("zip", "Zip", "trim|required");
			if ($this->form_validation->run() === TRUE) {
				$fname = $post['fname'];
				$lname = $post['lname'];
				$email = $post['email'];
				$pass = $post['password'];
				$cpass = $post['cpassword'];
				$street = $post['street'];
				$city = $post['city'];
				$town = $post['town'];
				$zip = $post['zip'];
				//encrypt pass using md5 and salt
				$encrypt_pass = md5($pass.''.$salt);
				/*if user is valid do the following codes */
				if ($this->is_name_has_number($fname, $lname)) {
					/*check if there are user with the same email address if email already exist 
					do the else*/
					if ($this->isExist($email) == 0) {
						$address_id = $this->save_address($street, $town, $city, $zip);
						$query = "INSERT INTO users (email, password, salt, fname, lname, user_role, 
						created_at, updated_at) VALUES(?,?,?,?,?,?,?,?)";
						$values = array($email, $encrypt_pass, $salt, $fname, $lname, $user_role, $date, $date);
						$result = $this->db->query($query, $values);
						$id = $this->db->insert_id();
						for($x = 0 ; $x < 2 ; $x++) {
							$query_addressrole = "INSERT INTO addresses_role (role, address_id, user_id) 
							VALUES(?,?,?)";
							$values_addressrole = array($x, $address_id, $id);
							$this->db->query($query_addressrole, $values_addressrole);
						}
					}
					else {
						$this->session->set_flashdata("msg_reg","email");
						return false;
					}

				}
				else {
					$this->session->set_flashdata("msg_reg","invalidname");
					return false;
				}
			}
			else {
				foreach ($this->input->post() as $key => $value) {
					$msg[$key] = form_error($key);
				}
				$this->session->set_flashdata("msg_reg",$msg);
				return false;
			}
		}

		//update user info
		public function update_user_info($post, $email_current, $id) {
			$fname = $post['fname'];
			$lname = $post['lname'];
			$email = $post['email'];
			$is_email_existing = ($this->isExist($email) == 0);
			if ($this->is_name_has_number($fname, $lname) && 
				($is_email_existing || $email == $email_current)) {
				$query = "UPDATE users SET fname = ?, lname = ?, email = ? WHERE id = ?";
				$value = array($fname, $lname, $email, $id);
				$this->db->query($query, $value);
				$result = $this->user_info($email);
				$user = array(
							"id"=>$result["id"],
							"fname"=>$result["fname"],
							"lname"=>$result["lname"],
							"email"=>$result["email"],
							"is_logged_in"=>true
						);
				$this->session->set_userdata("info_customer", $user);
				$this->session->set_flashdata("msg", "Successfully updated user information");
				return true;
			}
			else {
				$msg = (!$is_email_existing && $email != $email_current) ? "Email address already taken" : "Name is invalid numbers are not allowed";
				$this->session->set_flashdata("msg", $msg);
				return false;
			}
		}

		public function changepass($post, $id) {
			$salt = bin2hex(openssl_random_pseudo_bytes(22));
			$newpass = $post['newpass'];
			$confpass = $post['confpass'];
			$encrypt_pass = md5($newpass.''.$salt);
			if (strlen($newpass) < 8) {
				$this->session->set_flashdata("msg_changepass", "Password length required atleast 8 characters");
				return false;
			}
			else if ($newpass != $confpass) {
				$this->session->set_flashdata("msg_changepass", "Passwords do not matched");
				return false;
			}
			else {
				$query = "UPDATE users SET password = ?, salt = ? WHERE id = ?";
				$value = array($encrypt_pass, $salt, $id);
				$this->session->set_flashdata("msg_changepass", "Successfully change your password");
				return $this->db->query($query, $value);
			}
		} 

		//end of saving the users info

		/*-----------------------------------------------------------------------------------------------------*/

		//start of users authentication
		public function login($post, $user_type) {
			$this->form_validation->set_rules("email_login", "Email", "trim|required|valid_email");
			$this->form_validation->set_rules("password_login", "Password", "trim|required|min_length[8]");
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			if ($this->form_validation->run() === TRUE) {
				$email = $post['email_login'];
				$pass = $post['password_login'];
				$result	= $this->user_info($email);
				$encrypt_pass = md5($pass.''.$result['salt']);
				if ($encrypt_pass == $result['password']) {
					$user = array(
							"id"=>$result["id"],
							"fname"=>$result["fname"],
							"lname"=>$result["lname"],
							"email"=>$result["email"],
							"is_logged_in"=>true
						);
					if ($user_type == "customer") {
						$this->session->set_userdata("info_customer", $user);
					}
					else {
						$this->session->set_userdata("info_admin", $user);
					}
					
					return $result;
				}
				else {
					$this->session->set_flashdata("msg_login","incorrect");
					return false;
				}
			}
			else {			
				foreach ($this->input->post() as $key => $value) {
					$msg[$key] = form_error($key);
				}
				$this->session->set_flashdata("msg_login",$msg);
				return false;
			}
		}
		/*-----------------------------------------------------------------------------------------------------*/
		//get the user info
		public function user_info($email) {
			$result = $this->db->query("SELECT * from users WHERE email = ?", array($email))->row_array();
			return $result;
		}
		//start of saving the orders
		public function save_orders_transactions($shipping_address, $billing_address, $orders, $info) {
			date_default_timezone_set("Asia/Manila");
			$date = date("Y-m-d H:i:s");
			$encounter_error = false;
			$query_orders = "INSERT INTO  orders (quantity, total, created_at, updated_at, user_id, product_id,
			transaction_id) VALUES(?,?,?,?,?,?,?)";
			$query_deduct_qty = "UPDATE products SET quantity = quantity - ? WHERE id = ?";
			$query_transaction = "INSERT INTO transactions (billing_id, shipping_id, status_id, created_at, updated_at)
			 VALUES (?,?,?,?,?)";
			$values_transaction = array($billing_address['id'], $shipping_address['id'], 0, $date, $date);
			$result = $this->db->query($query_transaction, $values_transaction);
			$id = $this->db->insert_id();
			if ($result == TRUE) {
				foreach ($orders[$info['id']] as $value) {
					$values = array($value['quantity'], $value['tot_price'], $date ,$date, 
						$info['id'], $value['prod_id'], $id);
					$values_deduct_qty = array($value['quantity'], $value['prod_id']);
					$encounter_error = $this->db->query($query_orders, $values);
					$this->db->query($query_deduct_qty, $values_deduct_qty);
				}
				$orders = $this->session->userdata("orders");	
				unset($orders[$info['id']]);	
				$this->session->set_userdata("orders", $orders);
			
			}
			if ($encounter_error) {
				return true;
			}
			else {
				$this->db->query("DELETE FROM transactions WHERE id = ?", array($id));
				return false;
			}
			
		}

		//end of saving the orders

		/*-----------------------------------------------------------------------------------------------------*/
	
		

		//orders history
		public function order_history($id, $status_id) {
			$query = "SELECT products.image, products.name, products.description,
				products.price, orders.product_id, orders.created_at, orders.quantity,
				orders.total, orders.user_id, transactions.status_id FROM orders
				LEFT JOIN products ON orders.product_id = products.id
				LEFT JOIN users ON orders.user_id = users.id
				LEFT JOIN transactions ON orders.transaction_id = transactions.id
				WHERE users.id = ?";
			if ($status_id == "") {
				return $this->db->query($query, array($id))->result_array();
			}
			else {
				return $this->db->query($query." && transactions.status_id = ?", array($id, $status_id))->result_array();
			}
			
		}
		
		public function review($post) {
			date_default_timezone_set("Asia/Manila");
			$date = date("Y-m-d H:i:s");
			$query = "INSERT INTO reviews (rating, comment, created_at, updated_at, product_id, user_id)
						 VALUES(?,?,?,?,?,?)";
			$values = array($post['rating'], $post['comment'], $date, $date, $post['product_id'], $post['user_id']);
			return $this->db->query($query, $values);
		}
		public function get_review($id) {
			return $this->db->query("SELECT reviews.rating, reviews.comment, reviews.created_at, 
				reviews.product_id, CONCAT(users.fname,' ',users.lname)AS name 
				FROM reviews LEFT JOIN users ON reviews.user_id = users.id
				WHERE product_id = ?",array($id))->result_array();
		}

		public function get_avg_review($id) {
			return $this->db->query("SELECT AVG(rating)as rating, COUNT(rating)as total
			 FROM reviews WHERE product_id = ? GROUP BY product_id", array($id))->row_array();
		}
		/* to check if user input invalid name like numbers on their name  */
		public function is_name_has_number($fname, $lname) {
			$isValid = true;
			$fname_valid = preg_match('/[0-9]/', $fname);
			if ($fname_valid) {
				$this->session->set_flashdata("msg","Invalid name");
				$isValid = false;
			}

			$lname_valid = preg_match('/[0-9]/', $lname);
			if ($lname_valid) {
				$this->session->set_flashdata("msg","Invalid name");
				$isValid = false;
			}
			return $isValid;
		}

		/*-----------------------------------------------------------------------------------------------------*/

		/* check if the specific exist we can use this for signing up */
		public function isExist($email) {
			$query = $this->db->query("SELECT * from users WHERE email = ?",array($email));
			return $query->num_rows();
		}

		public function get_email($id) {
			return $this->db->query("SELECT email from users WHERE id = ?", array($id))->row_array();
		}
	}

?>	