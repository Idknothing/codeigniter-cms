<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller{
	public $viewFolder= "";
  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More

		$this->viewFolder = "product_v";

		$this->load->model("product_model");
  }

  function index()
  {
		$viewData =  new stdClass();


		/** Tablodan Verilerin Getirilmesi..*/
		$items = $this->product_model->get_all();

		/** View'e gönderilecek Değişkenlerin Set Edilmesi**/
		$viewData->viewFolder = $this->viewFolder;
		$viewData->subViewFolder = "list";
		$viewData->items = $items;

		$this->load->view("{$this->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
  }
	public function new_form(){
		$viewData =  new stdClass();


		/** Tablodan Verilerin Getirilmesi..*/

		/** View'e gönderilecek Değişkenlerin Set Edilmesi**/
		$viewData->viewFolder = $this->viewFolder;
		$viewData->subViewFolder = "add";

		$this->load->view("{$this->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
	}
	public function save(){
		$this->load->library("form_validation");
		//kurallar yazilir

		$this->form_validation->set_rules("title", "Başlık", "required|trim");
		$this->form_validation->set_message(array(
			"required" => "{field} alani doldurulmalidir.."
		));
		//form validation Calistirilir
		$validate = $this->form_validation->run();
		if($validate){
			echo "Kayıt işlemlleri başlar";
		}else{
			$viewData =  new stdClass();


			/** Tablodan Verilerin Getirilmesi..*/

			/** View'e gönderilecek Değişkenlerin Set Edilmesi**/
			$viewData->viewFolder = $this->viewFolder;
			$viewData->subViewFolder = "add";
			$viewData->form_error = true;
			$this->load->view("{$this->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
		}
		//Basairili ise kayit islemi baslar
		//Basarisiz ise hata ekranda gösterilir
	}
}
