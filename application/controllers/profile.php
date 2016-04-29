<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

	var $helper;

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('url');

		$this->helper =  new Facebook\FacebookRedirectLoginHelper( base_url().'facebook/redirect' );
	}

	public function index()
	{
		//database stuff
		$this->load->model('burgers_model');

		$this->load->helper('url');

		//get session data
		$fb_token = $this->session->userdata('fb_token');
		$session  = new Facebook\FacebookSession($fb_token);
		$fb_userdata = (new Facebook\FacebookRequest($session, 'GET', '/me?fields=id,first_name,last_name,email,tagged_places' ))->execute()->getGraphObject()->asArray();


		//load user model & get user_id from session_id
		$this->load->model('users_model');
		$current_user = $this->users_model->get_user_id($fb_userdata['id']);		

		$data = array
		(
           'burgers' => $this->burgers_model->get_burgers($current_user->user_id),
           'groups' => $this->users_model->get_groups($current_user->user_id),
           'logout_url' => $this->helper->getLogoutUrl($session, base_url().'facebook'),
           'invites' => $this->users_model->check_invites($fb_userdata['id'])
        );


		$this->load->view('profile/profile', $data);
		$this->load->view('footer/footer');
	}

	public function group_form()
	{
		$this->load->view('profile/group_form');
		$this->load->view('footer/footer');
	}

	public function group_select()
	{
		//database stuff
		$this->load->helper('url');

		//get session data
		$fb_token = $this->session->userdata('fb_token');
		$session  = new Facebook\FacebookSession($fb_token);
		$fb_userdata = (new Facebook\FacebookRequest($session, 'GET', '/me?fields=id,first_name,last_name,email,tagged_places' ))->execute()->getGraphObject()->asArray();


		//load user model & get user_id from session_id
		$this->load->model('users_model');
		$current_user = $this->users_model->get_user_id($fb_userdata['id']);		

		$data = array
		(
           'groups' => $this->users_model->get_groups($current_user->user_id)
        );

		$this->load->view('profile/group_select', $data);
		$this->load->view('footer/footer');
	}

	public function new_group()
	{
		$this->load->helper('url');

		//get session data
		$fb_token = $this->session->userdata('fb_token');
		$session  = new Facebook\FacebookSession($fb_token);
		$fb_userdata = (new Facebook\FacebookRequest($session, 'GET', '/me?fields=id,first_name,last_name,email,tagged_places' ))->execute()->getGraphObject()->asArray();


		//load user model & get user_id from session_id
		$this->load->model('users_model');
		$current_user = $this->users_model->get_user_id($fb_userdata['id']);


		//burger information
		$group = array
		(
			'moderator_id' => $current_user->user_id,
			'name' => $this->input->post('group-name')
		);

		$this->users_model->new_group($group,$current_user->user_id);

		redirect(base_url().'profile');
	}

	public function select_group()
	{

		if (isset($_POST['group-select']))
		{ 
			$_SESSION['group-selected'] = $_POST['group-select'];
		}

		redirect(base_url().'profile');
	}

	public function no_group()
	{
		$this->load->helper('url');

		//get session data
		$fb_token = $this->session->userdata('fb_token');
		$session  = new Facebook\FacebookSession($fb_token);
		$fb_userdata = (new Facebook\FacebookRequest($session, 'GET', '/me?fields=id,first_name,last_name,email,tagged_places' ))->execute()->getGraphObject()->asArray();

		//load user model & get user_id from session_id
		$this->load->model('users_model');
		$current_user = $this->users_model->get_user_id($fb_userdata['id']);

		$data = array
		(
           'groups' => $this->users_model->get_groups($current_user->user_id),
        );

		$this->load->view('no_group', $data);
		$this->load->view('footer/footer');
	}

	public function group_view($id)
	{
		$this->load->helper('url');

		//get session data
		$fb_token = $this->session->userdata('fb_token');
		$session  = new Facebook\FacebookSession($fb_token);
		$fb_userdata = (new Facebook\FacebookRequest($session, 'GET', '/me?fields=id,first_name,last_name,email,tagged_places' ))->execute()->getGraphObject()->asArray();

		//load user model & get user_id from session_id
		$this->load->model('users_model');
		$current_user = $this->users_model->get_user_id($fb_userdata['id']);
		$members = $this->users_model->get_members($id);

		$friends_array = (new Facebook\FacebookRequest($session, 'GET', '/me/friends' ))->execute()->getGraphObject()->asArray();
		$friends = $friends_array['data'];

		$data = array
		(
           'group' => $this->users_model->get_group($id),
           'user' => $current_user->user_id,
           'members' => $members,
           'friends' => $friends
        );

		$this->load->view('profile/group_view', $data);
		$this->load->view('footer/footer');
	}

	public function add_member($group_id)
	{
		$this->load->helper('url');

		//get session data
		$fb_token = $this->session->userdata('fb_token');
		$session  = new Facebook\FacebookSession($fb_token);
		$fb_userdata = (new Facebook\FacebookRequest($session, 'GET', '/me?fields=id,first_name,last_name,email,tagged_places' ))->execute()->getGraphObject()->asArray();

		//load user model & get user_id from session_id
		$this->load->model('users_model');
		$current_user = $this->users_model->get_user_id($fb_userdata['id']);

		//invite information
		$invite = array
		(
			'group_id' => $group_id,
			'inviter_id' => $current_user->user_id,
			'facebook_id' => $this->input->post('members-form')
		);

		$this->users_model->new_invite($invite);

		redirect(base_url().'profile');
	}

	public function accept_invite($invite_id)
	{
		$this->load->helper('url');

		//get session data
		$fb_token = $this->session->userdata('fb_token');
		$session  = new Facebook\FacebookSession($fb_token);
		$fb_userdata = (new Facebook\FacebookRequest($session, 'GET', '/me?fields=id,first_name,last_name,email,tagged_places' ))->execute()->getGraphObject()->asArray();

		//load user model & get user_id from session_id
		$this->load->model('users_model');
		$current_user = $this->users_model->get_user_id($fb_userdata['id']);
		$invite = $this->users_model->get_invite($invite_id);

		//invite information
		$new_member = array
		(
			'group_id' => $invite->group_id,
			'user_id' => $current_user->user_id
		);

		$this->users_model->accept_invite($new_member);
		$this->users_model->remove_invite($invite_id);

		redirect(base_url().'profile');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */