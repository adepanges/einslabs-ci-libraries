<?php defined('BASEPATH') OR exit('No direct script access allowed');
use League\Fractal;
use League\Fractal\Manager;
use League\Fractal\Serializer\DataArraySerializer;


class Eins_transform {
	var $path = APPPATH;

	function __construct(){
		$this->manager = new Manager();
		$this->manager->setSerializer(new DataArraySerializer());
	}

	function init($config){
		if(isset($config['module']) && !empty($config['module']))
		{
			$folder = $this->path.'module/'.$config['module'];
			if(file_exists($folder)) $this->path = $folder;
		}
	}

	function model($model_name, $data = array()){
		$model_name = ucfirst(strtolower(str_replace(" ", "", $model_name)));
		$file = $this->path.'/transformers/'.$model_name.'.php';

		if(file_exists($file)){
			require_once $file;
			$resource = new $model_name($data);

			$data = $this->manager->createData($resource)->toArray();
			return (isset($data['data']))?$data['data']:array();
		} else {
			echo 'Model not found';
			return FALSE;
			exit;
		}
	}
}
