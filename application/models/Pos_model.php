<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pos_model extends CI_Model
{

    public $table = 'pos';
    public $id = 'id_pos';
    public $order = 'ASC';

    function __construct()
    {
        parent::__construct();
    }

    function get_all(){
        return $this->db->get($this->table)->result();
    }
    function get_setoran_pos()
    {
        $this->db->select('pos.nm_pos,pos.id_pos');
        $this->db->from('anggota');
        $this->db->join('pos','anggota.pos = pos.id_pos','right outer');
        $this->db->order_by('nm_pos', $this->order);
        $this->db->group_by('pos.nm_pos');
        return $this->db->get();
    }

    function get_anggota_pos($id_pos){
        $this->db->select('anggota.id_anggota,anggota.nama,pos.nm_pos');
        $this->db->from('anggota');
        $this->db->join('pos','anggota.pos=pos.id_pos');
        $this->db->where('anggota.pos',$id_pos);
        return $this->db->get();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
   

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Saldo_model.php */
/* Location: ./application/models/Saldo_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-28 08:54:46 */
/* http://harviacode.com */