<?php 

/**
* 
*/
class M_informasi extends CI_model
{

private $table = 'tb_informasi';

//informasi INTERNET
public function view($value='')
{
  $this->db->select ('*');
  $this->db->from ($this->table);
  $this->db->order_by('id_informasi');
  return $this->db->get();
}

public function view_id($id='')
{
 return $this->db->select ('*')->from ($this->table)->where ('id_informasi', $id)->get ();
}

//mengambil id informasi urut terakhir
public function id_urut($value='')
{ 
  $this->db->select_max('id_informasi');
  $this->db->from ($this->table);
}

public function add($SQLinsert){
  return $this -> db -> insert($this->table, $SQLinsert);
}

public function update($id='',$SQLupdate){
  $this->db->where('id_informasi', $id);
  return $this->db-> update($this->table, $SQLupdate);
}

public function delete($id=''){
  $this->db->where('id_informasi', $id);
  return $this->db-> delete($this->table);
}

}