<?php
	class Admin extends CI_Model {
		
		public function __construct() {
			parent::__construct();

		}
		public function add_product($post,$images) {
			$this->form_validation->set_rules("prodname","Product name","trim|required");
			$this->form_validation->set_rules("price","Price","trim|required");
			$this->form_validation->set_rules("quantity","Quantity","trim|required");
			$this->form_validation->set_rules("desc","Description","trim|required");
			date_default_timezone_set("Asia/Manila");
			$date = date("Y-m-d H:i:s");
			$id = 0;
			$counter = 0;
			if ($this->form_validation->run() === TRUE) {
				if ($post['category'] == TRUE) {
					$category = $post['category'];
					/* START   this is to check wheter the user add or select existing categories  */
					if ($this->check_category($category) > 0) {
						$counter = 1;
					}
					else {
						$query = "INSERT INTO categories (name, created_at, updated_at) VALUES(?,?,?)";
						$values = array($post['category'], $date, $date);
						$this->db->query($query, $values);
						$id = $this->db->insert_id();
					}
				}
				else if ($post['category_select'] != "default") {
					$temp_id = $this->get_category_byname($post['category_select']);
					$id = $temp_id['id'];
				}
				else {
					$counter = 1;
				}
				/*END  of category validation */	

				/*i set counter = 1 if there are error in category validation so if this greater than zero
				meaning there are error in category validation  */
				if ($counter > 0) {
					$this->session->set_flashdata("msg","There are error in category please select or if not existing use add");
				}
				else {
					$query = "INSERT INTO products (category_id, name, price, quantity, description, image, created_at, updated_at)
								VALUES (?,?,?,?,?,?,?,?)";
					$values = array($id, $post['prodname'], $post['price'], $post['quantity'], $post['desc'], 
						$images ,$date, $date);
					return $this->db->query($query, $values);
				}
			}
			else {
				$this->session->set_flashdata("msg","Please fill out all the forms");
			}
		}

		//start get quantity sold

		public function get_quantitysold($prod_id) {
			return $this->db->query("SELECT SUM(orders.quantity)as quantity_sold, products.id, products.name FROM orders
									LEFT JOIN products on products.id = orders.product_id
									WHERE orders.product_id = ?", array($prod_id))->row_array();
		}

		//end get quantity sold

		/*-----------------------------------------------------------------------------------------------------*/

		// start product_page
		public function products_admin($start, $limit) {
			if ($this->session->userdata("search") == FALSE) {
				return $this->db->query("SELECT * from products limit $start, $limit")->result_array();
			}
			else {
				$search = $this->session->userdata("search");
				$name = "%".$search['search']."%";
				return $this->db->query("SELECT * from products 
				  						WHERE name LIKE  ?	limit $start, $limit",array($name))->result_array();
			}
		}

		public function prod_tot_num() {
			if ($this->session->userdata("search") == FALSE) {
				return $this->db->query("SELECT * from products")->num_rows();
			}
			else {
				$search = $this->session->userdata("search");
				$name = "%".$search['search']."%";
				return $this->db->query("SELECT * from products WHERE name LIKE ? ",array($name))->num_rows();
			}
		}

		//end product_page

		public function get_list_orders($id) {
			return $this->db->query("SELECT orders.id, products.name, products.price, 
				orders.total, orders.quantity FROM orders LEFT JOIN products ON 
				products.id = orders.product_id WHERE orders.transaction_id = ?",array($id))->result_array();
		}

		public function set_order_status($post) {
			$query = "UPDATE transactions SET status_id = ? WHERE id = ?";
			$values = array($post['status'], $post['id']);
			return $this->db->query($query, $values);
		}

		/*-----------------------------------------------------------------------------------------------------*/
		//start of get orders
		public function get_transactions($start, $limit) {
			$search = "";
			if ($this->Session->isSearch_notempty()) {
				$store_session = $this->Session->search_orders();
				$search = "%".$store_session["search_orders"]."%";
			} 
			else{
				$search = "%%";
			}
			return $this->db->query("SELECT transactions.id, CONCAT(users.fname,' ',users.lname) As name, 
				transactions.created_at, addresses.street, addresses.town, addresses.city, addresses.zip,
				SUM(orders.total) total , transactions.status_id FROM orders 
				LEFT JOIN users ON orders.user_id = users.id
				LEFT JOIN transactions ON orders.transaction_id = transactions.id
				LEFT JOIN addresses ON transactions.billing_id = addresses.id
				WHERE CONCAT(users.fname,' ',users.lname) LIKE ?  
				GROUP BY transactions.id LIMIT $start, $limit",array($search))->result_array();
		}

		//end of get orders

		/*-----------------------------------------------------------------------------------------------------*/
		//start of getting total count of  orders
		public function get_transactions_total_count() {
			$search = "";
			if ($this->Session->isSearch_notempty()) {
				$store_session = $this->Session->search_orders();
				$search = "%".$store_session["search_orders"]."%";
			} 
			else{
				$search = "%%";
			}
			return $this->db->query("SELECT transactions.id, CONCAT(users.fname,' ',users.lname) As name, 
				transactions.created_at, addresses.street, addresses.town, addresses.city, addresses.zip,
				SUM(orders.total) total , transactions.status_id FROM orders 
				LEFT JOIN users ON orders.user_id = users.id
				LEFT JOIN transactions ON orders.transaction_id = transactions.id
				LEFT JOIN addresses ON transactions.billing_id = addresses.id
				WHERE CONCAT(users.fname,' ',users.lname) LIKE ? 
				GROUP BY transactions.id ",array($search))->num_rows();
		}


		//end of getting total count of  orders
		/*-----------------------------------------------------------------------------------------------------*/

		//CATEGORIES section queries and validations

		//get all the categories 
		public function get_all_categories() {
			return $this->db->query("SELECT name from categories")->result_array();
		}

		//get category id by name we will use this if the select field is not equal to default
		public function get_category_byname($name) {
			return $this->db->query("SELECT id from categories WHERE name = ?",array($name))->row_array();
		}

		//check if the category already exist in the database
		public function check_category($name) {
			return $this->db->query("SELECT id from categories WHERE name = ?" , array($name))->num_rows();
		}
		
	}

?>