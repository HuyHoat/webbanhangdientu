<?php
	
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	class product 
	{
		private $db;
		private $fm;
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}


		public function search_product($tukhoa){

			$tukhoa = $this->fm->validation($tukhoa);
			$query = "SELECT * FROM tbl_product WHERE productName LIKE '%$tukhoa%'";
			$result = $this->db->select($query);
			return $result;
		}

//them
		public function insert_product($data, $files){

			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
			$category = mysqli_real_escape_string($this->db->link, $data['category']);
			$brand = mysqli_real_escape_string($this->db->link, $data['brand']);
			$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
			$price = mysqli_real_escape_string($this->db->link, $data['price']);
			$type = mysqli_real_escape_string($this->db->link, $data['type']);

			//kiem tra hinh anh va lay hinh anh cho vao folder upload
			$permited = array('jpg', 'jpeg', 'png', 'gif');

			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;

				//kiem tra productName
			if($productName=="" || $category=="" || $brand=="" || $product_desc=="" || $price=="" || $type=="" || $file_name==""){
				$alert = "<span class='error'>Các trường không được trống</span>";
				return $alert;
			}else{
				move_uploaded_file($file_temp, $uploaded_image);
				$query = "INSERT INTO tbl_product(productName,catId,brandId,product_desc,price,type,image) 
							VALUES('$productName','$category','$brand','$product_desc','$price','$type','$unique_image')";
				$result = $this->db->insert($query);
				if($result){
					$alert = "<span class='success'>Thêm sản phẩm thành công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Thêm sản phẩm không thành công</span>";
					return $alert;
				}
			}
		}

// hien thi sap xep cac danh muc giam dan
		public function show_product(){

			$query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
						FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
											INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
						order by tbl_product.productId asc";

			 // $query = "SELECT * FROM tbl_product order by productId desc";
			
			$result = $this->db->select($query);
			return $result;
		}
//Cap nhat
		public function update_product($data, $files, $id){

			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
			$category = mysqli_real_escape_string($this->db->link, $data['category']);
			$brand = mysqli_real_escape_string($this->db->link, $data['brand']);
			$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
			$price = mysqli_real_escape_string($this->db->link, $data['price']);
			$type = mysqli_real_escape_string($this->db->link, $data['type']);

			//kiem tra hinh anh va lay hinh anh cho vao folder upload
			$permited = array('jpg', 'jpeg', 'png', 'gif');

			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;

			if($productName=="" || $category=="" || $brand=="" || $product_desc=="" || $price=="" || $type==""){
				$alert = "<span class='error'>Các trường không được trống</span>";
				return $alert;

			}else{
				if(!empty($file_name)){

					//nếu người dùng chọn ảnh
					if($file_size > 20480){
						$alert = "<span class='success'>Kích thước hình ảnh phải nhỏ hơn 2 MB!</span>";
					return $alert;
						
					}elseif(in_array($file_ext, $permited) === false){
						$alert = "<span class='success'>Bạn chỉ có thể tải lên:-".implode(', ', $permited)."</span>";
					return $alert;
					}

					$query = "UPDATE tbl_product SET

					productName = '$productName',
					catId = '$category',
					brandId = '$brand',
					type = '$type',
					price = '$price',
					image = '$unique_image',
					product_desc = '$product_desc'

					WHERE productId = '$id'";

				}else{
					//nếu người dùng ko chọn ảnh
					$query = "UPDATE tbl_product SET

					productName = '$productName',
					catId = '$category',
					brandId = '$brand',
					type = '$type',
					price = '$price',
					product_desc = '$product_desc'

					WHERE productId = '$id'";

				}


				$result = $this->db->update($query);
				if($result){
					$alert = "<span class='success'>Cập nhật sản phẩm thành công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Cập nhật sản phẩm không thành công</span>";
					return $alert;
				}
			}
		}

//xoa
		public function del_product($id){
			$query = "DELETE FROM tbl_product where productId = '$id'";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Xóa sản phẩm thành công</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Xóa sản phẩm không thành công</span>";
				return $alert;
			}
		}

//lay - lua chon
		public function getproductbyId($id){
			$query = "SELECT * FROM tbl_product where productId = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

	//F_END

		public function getproduct_all(){
			$query = "SELECT * FROM tbl_product ";
			$result = $this->db->select($query);
			return $result;
		}

		public function getproduct_feathered(){
			$query = "SELECT * FROM tbl_product where type = '0'";
			$result = $this->db->select($query);
			return $result;
		}

		public function getproduct_new(){

			$sp_tungtrang = 8;
			if(!isset($_GET['trang'])){
				$trang = 1;
			}else{
				$trang = $_GET['trang'];
			}

			$tung_trang = ($trang - 1)*$sp_tungtrang;
			$query = "SELECT * FROM tbl_product  order by productId desc LIMIT $tung_trang, $sp_tungtrang";
			$result = $this->db->select($query);
			return $result; 
		}

		public function get_all_product(){
			$query = "SELECT * FROM tbl_product";
			$result = $this->db->select($query);
			return $result; 
		}

		public function get_details($id){

			$query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
						FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
											INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
						WHERE tbl_product.productId = '$id'";
			
			$result = $this->db->select($query);
			return $result;
		}

		public function getLastesApple(){

			$query = "SELECT * FROM tbl_product WHERE brandId = '8'  order by productId desc LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}

		public function getLastesOppo(){

			$query = "SELECT * FROM tbl_product WHERE brandId = '9'  order by productId desc LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}

		public function getLastesSamsung(){

			$query = "SELECT * FROM tbl_product WHERE brandId = '10'  order by productId desc LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}

		public function getLastesDell(){

			$query = "SELECT * FROM tbl_product WHERE brandId = '11'  order by productId desc LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}
	}
?>