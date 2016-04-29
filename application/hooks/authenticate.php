<?php
class Authenticate {


	public function __construct()
	{
		// init app with app id and secret
		Facebook\FacebookSession::setDefaultApplication( '1656982164560887','fca0497ce9428d102362163f12ed8c19' );
	}


	public function check_facebook()
	{
		$CI = & get_instance();

		$CI->load->helper('url');

		$on_login_screen = (stripos($CI->uri->uri_string(), 'facebook') !== FALSE) ? TRUE : FALSE;

		if(!$on_login_screen)
		{

			 $fb_data = $CI->session->userdata('fb_userdata');

			 if(!$fb_data)
			 {
			     // redirect to login page
			    redirect('/facebook');
			}
		}
	}

}