<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Setoran_model extends CI_Model
{

    public $table = 'setoran';
    public $id = 'id_setoran';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id_anggota)
    {
        $this->db->select('*');
        $this->db->join('anggota','setoran.id_anggota = anggota.id_anggota');
        $this->db->join('pos','anggota.pos = pos.id_pos');
        $this->db->order_by('setoran.tgl', 'ASC');
        $this->db->where('anggota.id_anggota', $id_anggota);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table);
    }

    function get_by_id2($id_anggota)
    {
        $sql="Select
        *
        From
            (Select
                anggota.id_anggota,
                 kud.anggota.nama,
                 kud.setoran.sesi ,
                 kud.setoran.jml_setoran ,
                 kud.setoran.tgl
             From
                 kud.setoran Inner Join
                 kud.anggota On kud.anggota.id_anggota = kud.setoran.id_anggota Inner Join
                 kud.pos On kud.pos.id_pos = kud.anggota.pos
             Where
                 kud.setoran.sesi = 1) As t1,
            (Select
                 kud.anggota.nama,
                 kud.setoran.sesi as sesi1,
                 kud.setoran.jml_setoran as setoran1,
                 kud.setoran.tgl
             From
                 kud.setoran Inner Join
                 kud.anggota On kud.anggota.id_anggota = kud.setoran.id_anggota Inner Join
                 kud.pos On kud.pos.id_pos = kud.anggota.pos
             Where
                 kud.setoran.sesi = 2) As t2
                 Where t1.tgl=t2.tgl and t1.nama=t2.nama and t1.id_anggota=$id_anggota 
                 and month(t1.tgl)= month(now())
            Order By
                 t1.tgl";
        return $this->db->query($sql)->result();
        
    }


    function setoran_sesi1($id_anggota){
    $sql="Select
        anggota.id_anggota,
        kud.anggota.nama,
        kud.setoran.id_setoran ,
        kud.setoran.sesi ,
        kud.setoran.jml_setoran ,
        kud.setoran.tgl
    From
        kud.setoran Inner Join
        kud.anggota On kud.anggota.id_anggota = kud.setoran.id_anggota Inner Join
        kud.pos On kud.pos.id_pos = kud.anggota.pos
    Where
        kud.setoran.sesi = 1 
        and anggota.id_anggota=$id_anggota
        and month(setoran.tgl)= month(now())
    Order By
        setoran.tgl";
         return $this->db->query($sql)->result();
    }

    function setoran_sesi2($id_anggota){
        $sql="Select
        anggota.id_anggota,
         kud.anggota.nama,
         kud.setoran.sesi ,
         kud.setoran.id_setoran ,
         kud.setoran.jml_setoran ,
         kud.setoran.tgl
     From
         kud.setoran Inner Join
         kud.anggota On kud.anggota.id_anggota = kud.setoran.id_anggota Inner Join
         kud.pos On kud.pos.id_pos = kud.anggota.pos
     Where
         kud.setoran.sesi = 2 
         and anggota.id_anggota=$id_anggota
         and month(setoran.tgl  )= month(now())
    Order By
        setoran.tgl";
         return $this->db->query($sql)->result();
    }

    function get_Setoran_byId($id){
        $sql="SELECT
        setoran.jml_setoran,
        anggota.nama,
        setoran.tgl
        FROM
        setoran
        INNER JOIN anggota ON setoran.id_anggota = anggota.id_anggota
        WHERE
        MONTH(tgl) = MONTH(NOW()) AND setoran.id_anggota=$id
        ORDER BY
        setoran.tgl ASC
        ";
        return $this->db->query($sql);
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_setoran', $q);
	$this->db->or_like('id_anggota', $q);
	$this->db->or_like('tgl', $q);
	$this->db->or_like('sesi', $q);
	$this->db->or_like('jml_setoran', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_setoran', $q);
	$this->db->or_like('id_anggota', $q);
	$this->db->or_like('tgl', $q);
	$this->db->or_like('sesi', $q);
	$this->db->or_like('jml_setoran', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
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

/* End of file Setoran_model.php */
/* Location: ./application/models/Setoran_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-28 08:54:46 */
/* http://harviacode.com */