<?php
require_once '../config.php';
class Login extends DBConnection {
	private $settings;
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;

		parent::__construct();
		ini_set('display_error', 1);
	}
	public function __destruct(){
		parent::__destruct();
	}
	public function index(){
		echo "<h1>Access Denied</h1> <a href='".base_url."'>Go Back.</a>";
	}
	public function login(){
		extract($_POST);
		$stmt = $this->conn->prepare("SELECT * from users where username = ? and password = ? ");
		$pw = md5($password);
		$stmt->bind_param('ss',$username,$pw);
		$stmt->execute();
		$qry = $stmt->get_result();
		if($qry->num_rows > 0){
			$res = $qry->fetch_array();
			if($res['status'] != 1){
				return json_encode(array('status'=>'notverified'));
			}
			foreach($res as $k => $v){
				if(!is_numeric($k) && $k != 'password'){
					$this->settings->set_userdata($k,$v);
				}
			}
			$this->settings->set_userdata('login_type',1);

		$audit_login=$this->conn->prepare("INSERT INTO log_audit (`firstname`,`lastname`,`username`,`user_type`,
			`activity`,`date`) 
			VALUES ('".$res['firstname']."','".$res['lastname']."','".$res['username']."','".$res['type']."','Login','".date(DATE_RFC2822)."')");
		$audit_login->execute();

		return json_encode(array('status'=>'success'));
		}else{
		return json_encode(array('status'=>'incorrect','error'=>$this->conn->error));
		}
	}
	public function logout(){
		$audit_logout=$this->conn->prepare("INSERT INTO log_audit (`firstname`,`lastname`,`username`,`user_type`,
			`activity`,`date`) 
			VALUES ('".$_SESSION['userdata']['firstname']."','".$_SESSION['userdata']['lastname']."','".$_SESSION['userdata']['username']."','".$_SESSION['userdata']['type']."',
				'Logout','".date(DATE_RFC2822)."')");
			$audit_logout->execute();

		if($this->settings->sess_des()){
			redirect('admin/login.php');
		}
	}
	function employee_login(){
		extract($_POST);
		$stmt = $this->conn->prepare("SELECT *,concat(lastname,', ',firstname,' ',middlename) as fullname from employee_list where email = ? and `password` = ? ");
		$pw = md5($password);
		$stmt->bind_param('ss',$email,$pw);
		$stmt->execute();
		$qry = $stmt->get_result();
		if($this->conn->error){
			$resp['status'] = 'failed';
			$resp['msg'] = "An error occurred while fetching data. Error:". $this->conn->error;
		}else{
			if($qry->num_rows > 0){
				$res = $qry->fetch_array();
				if($res['status'] == 1){
					foreach($res as $k => $v){
						$this->settings->set_userdata($k,$v);
					}
					$this->settings->set_userdata('login_type',2);
					$resp['status'] = 'success';
				}else{
					$resp['status'] = 'failed';
					$resp['msg'] = "Your Account is Inactive. Please Contact the Management to verify your account.";
				}
			}else{
				$resp['status'] = 'failed';
				$resp['msg'] = "Invalid email or password.";
			}
		}
		return json_encode($resp);
	}
	public function employee_logout(){
		if($this->settings->sess_des()){
			redirect('./login.php');
		}
	}
}
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$auth = new Login();
switch ($action) {
	case 'login':
		echo $auth->login();
		break;
	case 'logout':
		echo $auth->logout();
		break;
	case 'elogin':
		echo $auth->employee_login();
		break;
	case 'elogout':
		echo $auth->employee_logout();
		break;
	default:
		echo $auth->index();
		break;
}

