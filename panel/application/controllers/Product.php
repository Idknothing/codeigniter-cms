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

    public function index()
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
			$insert = $this->product_model->add(array(
				"title" 			=> $this->input->post("title"),
				"description" => $this->input->post("description"),
				"url" 				=> convertToSEO($this->input->post('title')),
				"rank"				=> 0,
				"isActive"		=> 1,
				"createdAt"		=> date("Y-m-d H:i:s")
			));
			//TODO alert sistemi eklenecek
			if($insert){
				redirect(base_url('product'));
			}else {
				redirect(base_url('product'));
			}
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

	public function update_form($id){
		/** Tablodan Verilerin Getirilmesi..*/
		$item = $this->product_model->get(array(
			"id" => $id,
		));
		/** View'e gönderilecek Değişkenlerin Set Edilmesi**/
		$viewData =  new stdClass();
		$viewData->viewFolder = $this->viewFolder;
		$viewData->subViewFolder = "update";
		$viewData->item = $item;

		$this->load->view("{$this->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
	}

    public function update($id){
        $this->load->library("form_validation");
        //kurallar yazilir
        $item = $this->product_model->get(array(
            "id" => $id,
        ));
        $this->form_validation->set_rules("title", "Başlık", "required|trim");
        $this->form_validation->set_message(array(
            "required" => "{field} alani doldurulmalidir.."
        ));
        //form validation Calistirilir
        $validate = $this->form_validation->run();
        if($validate){
            $insert = $this->product_model->update(array(
                'id' => $id,
            ),array(
                "title" 			=> $this->input->post("title"),
                "description" => $this->input->post("description"),
                "url" 				=> convertToSEO($this->input->post('title')),
            ));
            //TODO alert sistemi eklenecek
            if($insert){
                redirect(base_url('product'));
            }else {
                redirect(base_url('product'));
            }
        }else{
            $viewData =  new stdClass();


            /** Tablodan Verilerin Getirilmesi..*/

            /** View'e gönderilecek Değişkenlerin Set Edilmesi**/
            $viewData->item = $item;
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;
            $this->load->view("{$this->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
        //Basairili ise kayit islemi baslar
        //Basarisiz ise hata ekranda gösterilir
    }
}
