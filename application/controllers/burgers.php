<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Burgers extends CI_Controller {

	public function index()
	{
		//database stuff
		$this->load->model('burgers_model');

		$this->load->helper(array('form', 'url'));

		//get session data
		$fb_token = $this->session->userdata('fb_token');
		$session  = new Facebook\FacebookSession($fb_token);
		$fb_userdata = (new Facebook\FacebookRequest($session, 'GET', '/me?fields=id,first_name,last_name,email,tagged_places' ))->execute()->getGraphObject()->asArray();


		//load user model & get user_id from session_id
		$this->load->model('users_model');
		$current_user = $this->users_model->get_user_id($fb_userdata['id']);		

		$data = array
		(
           'burgers' => $this->burgers_model->get_burgers($current_user->user_id)
        );

		$this->load->view('burgers/my_burgers', $data);
		$this->load->view('footer/footer');
	}

	public function view_burger($burger_id)
	{
		$this->load->model('burgers_model');
		$this->load->model('users_model');

		$burger = $this->burgers_model->get_burger($burger_id);
		$members = $this->users_model->get_members($burger->group_id);

		foreach ($members as $member)
		{
			$votes = $this->burgers_model->get_burger_score($burger_id);

				$score = 0;
				$count = 0;

				foreach ($votes as $vote)
				{
					if ($vote->user_id == $member->user_id)
					{
						$score = $score + $vote->vote;
						$count++;
					}
				}

				if ($count>0)
				{
					$score = $score / $count;
				}

			$member->{"vote"} = $score;
		}

		$data = array
		(
           'burger' => $this->burgers_model->get_burger($burger_id),
           'ingredients' => $this->burgers_model->get_ingredients($burger_id),
           'members' => $members
        );

		$this->load->view('burgers/view', $data);
		$this->load->view('footer/footer');
	}

	public function vote_burger($burger_id)
	{
		$this->load->model('burgers_model');

		$data = array
		(
           'burger' => $this->burgers_model->get_burger($burger_id),
           'ingredients' => $this->burgers_model->get_ingredients($burger_id),
           'vote_types' => $this->burgers_model->get_vote_types()
        );

		$this->load->view('burgers/vote', $data);
		$this->load->view('footer/footer');
	}

	public function update_vote($burger_id)
	{
		$this->load->helper('url');

		//get session data
		$fb_token = $this->session->userdata('fb_token');
		$session  = new Facebook\FacebookSession($fb_token);
		$fb_userdata = (new Facebook\FacebookRequest($session, 'GET', '/me?fields=id,first_name,last_name,email,tagged_places' ))->execute()->getGraphObject()->asArray();

		//load user model & get user_id from session_id
		$this->load->model('users_model');
		$current_user = $this->users_model->get_user_id($fb_userdata['id']);

		//load burger model
		$this->load->model('burgers_model');

		$vote_types = $this->burgers_model->get_vote_types();

		foreach($vote_types as $vote_type)
		{
			$vote[] = array
			(
				'user_id' => $current_user->user_id,	
				'burger_id' => $burger_id,	
				'type_id' => $vote_type->type_id,	
				'vote' => $this->input->post($vote_type->type_id)
			);
		};

		$this->burgers_model->add_vote($vote);

		redirect(base_url().'profile');
	}

	public function new_burger()
	{
		$this->load->helper(array('form', 'url'));

		if (!isset($_SESSION['group-selected']))
		{
			redirect(base_url().'profile/no_group');
		};

		$this->load->view('burgers/form', array('error' => ' ' ));
		$this->load->view('footer/footer');
	}

	public function update_burger()
	{

		$this->load->helper(array('form', 'url'));

		//get session data
		$fb_token = $this->session->userdata('fb_token');
		$session  = new Facebook\FacebookSession($fb_token);
		$fb_userdata = (new Facebook\FacebookRequest($session, 'GET', '/me?fields=id,first_name,last_name,email,tagged_places' ))->execute()->getGraphObject()->asArray();


		//load user model & get user_id from session_id
		$this->load->model('users_model');
		$current_user = $this->users_model->get_user_id($fb_userdata['id']);


		//load burger model
		$this->load->model('burgers_model');

		//burger information
		$burger = array
		(
			'user_id' => $current_user->user_id,
			'name' => $this->input->post('burger-name'),
			'group_id' => $_SESSION['group-selected']
		);

		$this->burgers_model->add_burger($burger);

			
			//Photo Upload
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= (100*1024);

			$filename = "hamburger" . $_SESSION['burger_id'];
			$config['file_name'] = $filename;

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload())
			{
				print_r($this->upload->display_errors());
				die("bad upload!");
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());
			}


				//thumbnail
				$config['image_library'] = 'gd2';
				$config['source_image']	= './uploads/' . $filename . '.jpg';
				$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = TRUE;
				$config['width']	= 75;
				$config['height']	= 50;

				$this->load->library('image_lib', $config); 

				if ( ! $this->image_lib->resize())
				{
				    echo $this->image_lib->display_errors();
				}

		redirect(base_url().'burgers/add_ingredients');
	}

	public function add_ingredients()
	{
		$this->load->helper('url');

		//load burger model
		$this->load->model('burgers_model');

		//burger information
		$data = array
		(
			'ingredients' => $this->burgers_model->get_ingredients($_SESSION['burger_id'])
		);

		$this->load->view('burgers/ingredients_form', $data);
		$this->load->view('footer/footer');
	}

	public function update_ingredients()
	{
		$this->load->helper('url');

		//load burger model
		$this->load->model('burgers_model');

		//burger information
		$ingredient = array
		(
			'burger_id' => $_SESSION['burger_id'],
			'name' => $this->input->post('ingredient'),
			'color' => $this->input->post('color')
		);

		$this->burgers_model->add_ingredient($ingredient);

		redirect(base_url().'burgers/add_ingredients');
	}

	function do_upload()
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('upload_form', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());

			$this->load->view('upload_success', $data);
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */