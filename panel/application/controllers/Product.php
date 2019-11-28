<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller{
	public $viewFolder= "";
  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
		$this->viewFolder = "product_v";
  }

  function index()
  {
		$viewData =  new stdClass();
		$viewData->viewFolder = $this->viewFolder;
		$viewData->subViewFolder = "list";
		$this->load->view("{$this->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
  }

}
