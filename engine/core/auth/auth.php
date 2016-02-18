<?php
class Auth{
	public $auth;
	function __construct(){
		session_start();
		if(isset($_SESSION['userid']))    {
		    $this->auth = true;
		}
		if(isset($_SESSION['userid']))    {
		    $this->auth = false;
		}
	}
}