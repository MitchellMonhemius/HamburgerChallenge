<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function view_user($user_id)
	{
		$this->load->model('users_model');
		$this->load->model('burgers_model');

		$data = array
		(
           'user' => $this->users_model->get_user($user_id),
           'burgers' => $this->burgers_model->get_burgers($user_id)
        );

		$this->load->view('user', $data);
		$this->load->view('footer/footer');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */