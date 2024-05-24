<?php 
/**
 * PHP for Codeigniter
 *
 * @package       CodeIgniter
 * @pengembang		Kassandra Production (https://kassandra.my.id)
 * @Author			@erikwahyudy
 * @version			3.0
 */

class login_m extends CI_model
{
	
 public function superadmin($nama='', $no_hp='', $email='', $password='', $id_level='1')
 {
  return $this->db->query("SELECT * from tb_pengguna where (nama='$nama' OR no_hp='$no_hp' OR email='$email') AND password='$password' AND id_level='$id_level' limit 1");
 }

 public function admin($nama='', $no_hp='', $email='', $password='', $id_level='2')
 {
  return $this->db->query("SELECT * from tb_pengguna where (nama='$nama' OR no_hp='$no_hp' OR email='$email') AND password='$password' AND id_level='$id_level' limit 1");
 }

 public function user($nama='', $no_hp='', $email='', $password='', $id_level='3')
 {
  return $this->db->query("SELECT * from tb_pengguna where (nama='$nama' OR no_hp='$no_hp' OR email='$email') AND password='$password' AND id_level='$id_level' limit 1");
 }

 public function pasien($nama='', $no_hp='', $email='', $password='', $id_level='4')
 {
  return $this->db->query("SELECT * from tb_pasien where (nama='$nama' OR no_hp='$no_hp' OR email='$email') AND password='$password' AND id_level='$id_level' limit 1");
 }

 public function IsEmailValidPengguna($email)
    {
    return $this->db->query("SELECT * from tb_pengguna where email='$email' or no_hp='$email' limit 1");
    }

public function IsEmailValidPasien($email)
    {
    return $this->db->query("SELECT * from tb_pasien where email='$email' or no_hp='$email' limit 1");
    }


}