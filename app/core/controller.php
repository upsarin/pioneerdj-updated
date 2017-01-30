<?php
Class Controller {

	public $model;
	public $view;
	//public $modules;
	
	
	function __construct()
	{
		$this->view = new View();
		$this->model = new Model();
		//$this->modules = new minc();
	}
	
	// действие (action), вызываемое по умолчанию
	
	public function showPage($page)
	{
		return DBConnect::init()->selectPage($page);
	}
	
	public function index($array)
	{	
		if($_SESSION['user']['permissions'] > $array['permission']) {
			if($array['name'] == 'administrator'){
				echo minc::pos('admin-login', $array['id']);
			} else {
				header("Location: /");
			}		
		
		} else {
			
			$data = $this->model->get_data($array);
			$this->view->generate($array['temp'] .'_view.php', $array['template_type'] .'_view.php', $data, $array['id']); 
		}
		
	} 
	
	public function detail($array)
	{	
		
		if($_SESSION['user']['permissions'] > $array['permission']) {
			header("Location: /");
		}
		$data = $this->model->get_data_one($array);
		$this->view->generate($array['temp'] .'_view.php', $array['template_type'] .'_view.php', $data, $array['id']); 
	} 
	
	public function create($array)
	{	
		if($_SESSION['user']['permissions'] > $array['permission']) {
			header("Location: /");
		}
		$data = $this->model->create($array);
		$this->view->generate($array['temp'] .'_view.php', $array['template_type'] .'_view.php', $data, $array['id']); 
	}
	public function edit($array)
	{	
		if($_SESSION['user']['permissions'] > $array['permission']) {
			header("Location: /");
		}
		$data = $this->model->edit($array);
		$this->view->generate($array['temp'] .'_view.php', $array['template_type'] .'_view.php', $data, $array['id']); 
	}
	
	public function settings($array)
	{	
		if($_SESSION['user']['permissions'] > $array['permission']) {
			header("Location: /");
		}
		$data = $this->model->settings($array);
		
		$this->view->generate($array['temp'] .'_view.php', $array['template_type'] .'_view.php', $data, $array['id']); 
	}
	
	public function activate()
	{
		$data = $this->model->activate();
		$routes = explode('/', $_SERVER['REQUEST_URI']);
		
		if($routes[1] == 'administrator'){
			header("Location: /administrator/". $routes[2] ."/?phrase=". $data['mess']);
		} else {
			header("Location: /administrator/". $routes[1] ."/?phrase=". $data['mess']);
		}
	}
	
	public function deactivate()
	{
		$data = $this->model->deactivate();
		$routes = explode('/', $_SERVER['REQUEST_URI']);
		
		if($routes[1] == 'administrator'){
			header("Location: /administrator/". $routes[2] ."/?phrase=". $data['mess']);
		} else {
			header("Location: /administrator/". $routes[1] ."/?phrase=". $data['mess']);
		}
	}
	
	public function preload($array){
		
		$this->view->generate($array['temp'] .'_view.php', $array['template_type'] .'_view.php', $array, $array['id']);
	}
	
	public function error_404($array){
		
		$this->view->generate($array['temp'] .'_view.php', $array['template_type'] .'_view.php', $array, $array['id']);
	}
	
	
}