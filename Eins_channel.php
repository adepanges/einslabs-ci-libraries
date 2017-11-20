<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Eins_channel {

	protected $ci;

	function __construct(){
		$this->table_name = "channels";

		$this->ci =& get_instance();
		$this->ci->load->database();
	}

	function get_channel_by_api_key($api_key = '')
	{
		return $this->ci->db->get_where($this->table_name, ['api_key' => $api_key, 'status' => 1]);
	}
}
