<?php 

/**
* 
*/
class M_pasien extends CI_model
{

private $table = 'tb_pasien';

//View
public function view($value='')
{
  $this->db->select ('*');
  $this->db->from ($this->table);
  $this->db->order_by('nama', 'ASC');
  return $this->db->get();
}

public function view_id($id='')
{
 return $this->db->select ('*')->from ($this->table)->where ('id_pasien', $id)->get ();
}

//mengambil id urut terakhir
public function id_urut($value='')
{ 
  $this->db->select_max('id_pasien');
  $this->db->from ($this->table);
}

public function add($SQLinsert){
  return $this -> db -> insert($this->table, $SQLinsert);
}

public function update($id='',$SQLupdate){
  $this->db->where('id_pasien', $id);
  return $this->db-> update($this->table, $SQLupdate);
}

public function delete($id=''){
  $this->db->where('id_pasien', $id);
  return $this->db-> delete($this->table);
}

//untuk page pasien login
public function view_id_pasien($id='')
{
  $id = $this->session->userdata['id_pasien'];
  $this->db->select('*');
  $this->db->from($this->table);
  $this->db->where('id_pasien', $id);
  $this->db->order_by('id_pasien');
  return $this->db->get();
}

}