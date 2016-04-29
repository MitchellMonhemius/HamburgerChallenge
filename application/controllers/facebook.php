<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Facebook extends CI_Controller {


	var $helper;

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->helper =  new Facebook\FacebookRedirectLoginHelper( base_url().'facebook/redirect' );
	}


	public function index()
	{

		//clear session data
	    $session_array = array();
	    $_SESSION = array();

		$data = array
		(
           'login_url' => $this->helper->getLoginUrl( array( 'email, user_birthday, user_about_me, user_friends' ) )
        );

		$this->load->view('login', $data);
	}


	public function logout()
	{
		
	    $session_array = array();
	    $_SESSION = array();
	    session_destroy();

		redirect(base_url().'facebook');
	}

	public function redirect()
	{
		//load user model
		$this->load->model('users_model');

		//set session
		$session  = $this->helper->getSessionFromRedirect();
		$fb_token = $session->getToken();

		if($fb_token)
		{

		    if($session->validate())
		    {
		      $fb_userdata = (new Facebook\FacebookRequest($session, 'GET', '/me?fields=id,first_name,last_name,email,tagged_places' ))->execute()->getGraphObject()->asArray();
		      
		      $session_array = array
		      (
		      	'fb_token' => $fb_token,
		        'fb_userdata'  => $fb_userdata
		      );

		      // if() fb data is valid
		      $this->session->set_userdata($session_array);
		    }
		}


		//setup user for id check and possible database entry
		$user = array
		(
			'facebook_id' => $fb_userdata['id'],
			'first_name' => $fb_userdata['first_name'],
			'last_name' => $fb_userdata['last_name'],
			'email' => $fb_userdata['email']
		);

		$this->users_model->new_user_check($user);

		//go to ranking page
		redirect(base_url().'profile');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */