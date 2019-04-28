<?php
	class Login extends Base_Controller {
		public $_id = null;
		function __construct() {
			parent::__construct();
			$this->loadModel('Login');
		}
		function index()
		{
			$this->view->render('login/get');
		}
		function runLogout()
		{
			session_destroy();
			header('Location: ' . BASE_URL .'login.php?message='.urlencode('logout success'));
		}
		function runLogin()
		{
			//$_GET['messo'] = "checkpoint:runLogin";
			$username = $_POST['username'];
			$password = $_POST['password'];
			$this->model->login_id = $this->model->login($username, $password);
			if (isset($this->model->login_id)) {
				if (isset($_SESSION["restaurantid"])) {
					header('Location:'. BASE_URL. 'restaurant/index.php?message='.urlencode('login successful'));
				} else if (isset($_SESSION["customerid"])) {
					header('Location:'. BASE_URL. 'customer/index.php?message='.urlencode('login successful'));
				}elseif (isset($_SESSION["deliverypersonid"])) {
					$_GET['messo'] = "checkpoint: session set";
					header('Location:'. BASE_URL. 'delivery/index.php?message='.urlencode('login successful'));
				}
			}else{
				header('Location:'. BASE_URL.'login.php?message='.urlencode('login failed: Wrong username or password'));

			}
		}

	}

?>