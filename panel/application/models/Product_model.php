<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model{
  public $tableName = "products";
  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }
  //tüm kayıtları getirecek olan metot
  public function get_all(){
    return $this->db->get($this->tableName)->result();
  }
}