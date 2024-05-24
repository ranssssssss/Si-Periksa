<?php 

/**
* 
*/
class M_periksa extends CI_model
{

private $table = 'tb_periksa';
private $table2 = 'tb_pasien';

//View
public function view($tgl='')
{
  $this->db->select ('*');
  $this->db->from ($this->table);
  $this->db->join($this->table2, 'tb_pasien.id_pasien = tb_periksa.id_pasien');
  $this->db->where('tgl_periksa', $tgl);
  $this->db->where_in('status', array('BL', 'D', 'S'));
  $this->db->order_by('id_periksa', 'ASC');
  return $this->db->get();
}

public function view_diperiksa($tgl='')
{
  $this->db->select ('*');
  $this->db->from ($this->table);
  $this->db->join($this->table2, 'tb_pasien.id_pasien = tb_periksa.id_pasien');
  $this->db->where('status', 'D');
  $this->db->where('tgl_periksa', $tgl);
  $this->db->order_by('id_periksa', 'ASC');
  return $this->db->get();
}

public function view_sdh($tgl='')
{
  $this->db->select ('*');
  $this->db->from ($this->table);
  $this->db->join($this->table2, 'tb_pasien.id_pasien = tb_periksa.id_pasien');
  $this->db->where('status', 'S');
  $this->db->where('tgl_periksa', $tgl);
  $this->db->order_by('id_periksa', 'ASC');
  return $this->db->get();
}

public function view_blm($tgl='')
{
  $this->db->select ('*');
  $this->db->from ($this->table);
  $this->db->join($this->table2, 'tb_pasien.id_pasien = tb_periksa.id_pasien');
  $this->db->where('tgl_periksa', $tgl);
  $this->db->where_in('status', array('BL', 'D'));
  $this->db->order_by('id_periksa', 'ASC');
  return $this->db->get();
}

public function view_btl($tgl='')
{
  $this->db->select ('*');
  $this->db->from ($this->table);
  $this->db->join($this->table2, 'tb_pasien.id_pasien = tb_periksa.id_pasien');
  $this->db->where('status', 'BTL');
  $this->db->where('tgl_periksa', $tgl);
  $this->db->order_by('id_periksa', 'ASC');
  return $this->db->get();
}


public function view_id($id='')
{
 return $this->db->select ('*')->from ($this->table)->where ('id_periksa', $id)->get ();
}

//mengambil id urut terakhir
public function id_urut($value='')
{ 
  $this->db->select_max('id_periksa');
  $this->db->from ($this->table);
}

public function add($SQLinsert){
  return $this -> db -> insert($this->table, $SQLinsert);
}

public function update($id='',$SQLupdate){
  $this->db->where('id_periksa', $id);
  return $this->db-> update($this->table, $SQLupdate);
}

public function delete($id=''){
  $this->db->where('id_periksa', $id);
  return $this->db-> delete($this->table);
}

//untuk page pasien login
public function view_id_pasien($id='')
{
  $id = $this->session->userdata['id_pasien'];
  $this->db->select('*');
  $this->db->from($this->table);
  $this->db->join($this->table2, 'tb_pasien.id_pasien = tb_periksa.id_pasien');
  $this->db->where('tb_pasien.id_pasien', $id);
  $this->db->order_by('id_periksa', 'DESC');
  return $this->db->get();
}

}