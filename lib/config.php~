<?php
/*
 * Defines configuration variables for our site
 */
class config {
	public $url_local    = '/s/bach/n/under/bpowley/public_html/CT310-P2/';
	public $url_public   = '/s/bach/n/under/bpowley/public_html/CT310-P2/';
	public $base_url     = '';  /* Selected below based upon server */
	public $site_name    = "CT 310: Project2";
	public $site_lmod    = "04/05/17";
	public $matience     = false;
	public $session_name = "CT310-P2";
	public $up_local     = "/s/bach/n/under/bpowley/public_html/CT310-P2/";
	public $up_public    = "/s/bach/n/under/bpowley/public_html/CT310-P2/assets/img/";
	public $upload_dir   = ''; /* Selected below based upon server */
	public $pad_length   = 6;
}

$config = new config();

/* Select the proper base_url for development vs. public server */
$test_local_p = (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', "::1")));
echo $test_local_p;
$config->base_url   = $test_local_p ? $config->url_local : $config->url_public;
$config->upload_dir = $test_local_p ? $config->up_local : $config->up_public; //