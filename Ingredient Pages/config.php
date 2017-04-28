<?php
/*
 * Defines configuration variables for our site
 */
class config{
	public $url_local    = '/courses/ct310/yr2017sp/aplay/310-Project2/';
	public $url_public   = '/~jcollera/310-Project2';
	public $base_url     = '';  /* Selected below based upon server */
	public $site_name    = "CT 310: Handling File Uploads";
	public $site_lmod    = "3/26/17";
	public $matience     = false;
	public $session_name = "File Upload Example";
	public $up_local     = "/Users/ross/Active/eclipse/mars/courses/ct310/yr2017sp/aplay/310-Project2/uploads/";
	public $up_public    = "/s/bach/a/class/jcollera/public_html/310-Project2/";
	public $upload_dir   = '/s/bach/a/class/jcollera/public_html/310-Project2/Ingredien Pages/'; /* Selected below based upon server */
	public $pad_length   = 6; 
}

$config = new config();

/* Select the proper base_url for development vs. public server */
$test_local_p = (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', "::1")));
$config->base_url   = $test_local_p ? $config->url_local : $config->url_public;
$config->upload_dir = $test_local_p ? $config->up_local : $config->up_public;
