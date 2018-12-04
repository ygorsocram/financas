<?php 

class MY_Controller extends CI_Controller {

 	public function __construct(){
        parent::__construct();	
		
		$logado = $this->session->userdata("logado");
		
		if ($logado != 1){ 
			$this->session->set_flashdata("titulo", "Desculpe!");
			$this->session->set_flashdata("tipo", "warning");
			$this->session->set_flashdata("mensagem", "É necessario estar logado para acessar esta pagina.");
			redirect(base_url('login'));
		}	
    }
}

class inicio_controller extends CI_Controller {

 	public function __construct(){
        parent::__construct();
		
		$logado = $this->session->userdata("logado");

		if ($logado != 1){
			redirect(base_url('login'));
		}		
    }
}

class cdl_controller extends CI_Controller {

 	public function __construct(){
        parent::__construct();
		
		$logado = $this->session->userdata("logado");

		if ($logado != 'administrador'){
			redirect(base_url('login'));
		}		
    }
}

class registro_controller extends CI_Controller {

 	public function __construct(){
        parent::__construct();
		
		$logado = $this->session->userdata("logado");
		if ($logado == 1){
			redirect(base_url('inicio'));
		}elseif($logado == 'administrador'){
            redirect(base_url('adm'));
        }
    }
}
