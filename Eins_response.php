<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Eins_response {

	protected $ci;

	function __construct()
	{
		$this->table_name = 'response_data';
		$this->wording_basic_response = [
			'failed' => [
				'id' => 'gagal',
				'en' => 'failed'
			],
			'success' => [
				'id' => 'berhasil',
				'en' => 'gagal'
			]
		];

		$this->ci =& get_instance();

		$this->ci->load->driver('cache',
			array('adapter' => 'apc', 'backup' => 'file', 'key_prefix' => 'kds_')
		);
		$this->ci->load->database();
		$this->ci->load->helper('database');
	}

	function get_by_code($code = '', $lang = 'id')
	{
		$message = $this->_basic_response('failed', $lang);
		if($code == 200) $message = $this->_basic_response('success', $lang);
		return $message;
	}

	protected function _basic_response($behavior = '', $lang = 'id'){
		$message = 'Error';
		if(isset($this->wording_basic_response[$behavior][$lang]))
			$message = $this->wording_basic_response[$behavior][$lang];
		return $message;
	}
}
