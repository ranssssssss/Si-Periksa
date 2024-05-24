<?php 

/**
* 
*/
class M_pengguna extends CI_model
{

private $table = 'tb_pengguna';

//Superadmin
public function viewSuperadmin($value='')
{
  $this->db->select ('*');
  $this->db->from ($this->table);
  $this->db->where('id_level', 1);
  $this->db->order_by('nama', 'ASC');
  return $this->db->get();
}

//Admin
public function viewAdmin($value='')
{
  $this->db->select ('*');
  $this->db->from ($this->table);
  $this->db->where('id_level', 2);
  $this->db->order_by('nama', 'ASC');
  return $this->db->get();
}

//Dosen
public function viewUser($value='')
{
  $this->db->select ('*');
  $this->db->from ($this->table);
  $this->db->where('id_level', 3);
  $this->db->order_by('nama', 'ASC');
  return $this->db->get();
}

public function view_id($id='')
{
 return $this->db->select ('*')->from ($this->table)->where ('id_pengguna', $id)->get ();
}

//mengambil id pengguna urut terakhir
public function id_urut($value='')
{ 
  $this->db->select_max('id_pengguna');
  $this->db->from ($this->table);
}

public function add($SQLinsert){
  return $this -> db -> insert($this->table, $SQLinsert);
}

public function update($id='',$SQLupdate){
  $this->db->where('id_pengguna', $id);
  return $this->db-> update($this->table, $SQLupdate);
}

public function delete($id=''){
  $this->db->where('id_pengguna', $id);
  return $this->db-> delete($this->table);
}

//untuk page dokter login
public function view_id_pengguna($id='')
{
  //join table tb_dokter dan tb_paket di dokter
  $id = $this->session->userdata['id_pengguna'];
  $this->db->select('*');
  $this->db->from($this->table);
  $this->db->where('id_pengguna', $id);
  $this->db->order_by('id_pengguna');
  return $this->db->get();
}

}