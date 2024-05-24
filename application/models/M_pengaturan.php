<?php 
/**
 * PHP for Codeigniter
 *
 * @package       CodeIgniter
 * @pengembang		Kassandra Production (https://kassandra.my.id)
 * @Author			@erikwahyudy
 * @version			3.0
 */

class M_pengaturan extends CI_model
{

private $table = 'tb_pengaturan';

//pengaturan
public function view($value='')
{
  $this->db->select ('*');
  $this->db->from ($this->table);
  return $this->db->get();
}

public function view_id($id='')
{
 return $this->db->select ('*')->from ($this->table)->where ('id_pengaturan', $id)->get ();
}

//mengambil id pengaturan urut terakhir
public function id_urut($value='')
{ 
  $this->db->select_max('id_pengaturan');
  $this->db->from ($this->table);
}

public function add($SQLinsert){
  return $this -> db -> insert($this->table, $SQLinsert);
}

public function update($id='',$SQLupdate){
  $this->db->where('id_pengaturan', $id);
  return $this->db-> update($this->table, $SQLupdate);
}

public function delete($id=''){
  $this->db->where('id_pengaturan', $id);
  return $this->db-> delete($this->table);
}

}