<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['profile_id']	= 'UA-111602628-1'; // GA profile id
$config['email']		= 'dmcrtccmaster@gmail.com'; // GA Account mail
$config['password']		= 'admintcc'; // GA Account password

$config['cache_data']	= false; // request will be cached
$config['cache_folder']	= '/cache'; // read/write
$config['clear_cache']	= array('date', '90 day ago'); // keep files 1 day
	
$config['debug']		= false; // print request url if true