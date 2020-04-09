<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Gaji_model extends CI_Model{
    public $table='gaji';
    public $id='id_gaji';
    public $order='DESC';

    function insert($data){
        $this->db->insert($this->table,$data);
    }
}
