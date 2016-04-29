<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ranking extends CI_Controller {

	var $helper;

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('url');

		$this->helper =  new Facebook\FacebookRedirectLoginHelper( base_url().'facebook/redirect' );
	}

	public function index()
	{
		if (!isset($_SESSION['group-selected']))
		{
			redirect(base_url().'profile/no_group');
		};

		$fb_token = $this->session->userdata('fb_token');
		$session  = new Facebook\FacebookSession($fb_token);
		$fb_userdata = (new Facebook\FacebookRequest($session, 'GET', '/me?fields=id,first_name,last_name,email,tagged_places' ))->execute()->getGraphObject()->asArray();


		//database stuff
		$this->load->model('burgers_model');
		$burgers = $this->burgers_model->get_burgers_by_group($_SESSION['group-selected']);

		$this->load->model('users_model');	
		$current_user = $this->users_model->get_user_id($fb_userdata['id']);
		$votes_by_user = $this->burgers_model->get_votes($current_user);

		//get scores
		foreach ($burgers as $burger)
		{
			$votes = $this->burgers_model->get_burger_score($burger->burger_id);

				$score = 0;
				$count = 0;

				foreach ($votes as $vote)
				{
					$score = $score + $vote->vote;
					$count++;
				}

				if ($count>0)
				{
					$score = $score / $count;
				}

			$burger->{"score"} = $score;
		}

		$vote_check = [];

			//vote check by burger id
			foreach ($votes_by_user as $vote)
			{
				if($vote->burger_id)
				{
					$vote_check[$vote->burger_id] = true;
				}
			}


		$data = array
		(
			'user_id' => $current_user->user_id,
           	'logout_url' => $this->helper->getLogoutUrl( $session, base_url().'facebook/logout' ),
           	'registered_users' => $this->users_model->get_registered_users($_SESSION['group-selected']),
           	'burgers' => $burgers,
           	'votes' => $vote_check
        );

		$this->load->view('ranking', $data);
		$this->load->view('footer/footer');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */