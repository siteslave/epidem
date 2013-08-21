<?php
class User_model extends CI_Model
{
    public function do_auth($username, $password)
    {
        $rs = $this->db
            ->select('u.id,u.username,u.name,u.user_level, u.user_type, u.office as hospcode,h.name as hospname')

            ->where('username', $username)
            ->where('password', md5($password))
            ->join('ref_hospital h','h.hospcode=u.office','LEFT')
            ->limit(1)
            ->get('mas_users u')
            ->row();
        //echo $this->db->last_query();
        return $rs;
    }
    public function get_user($id){
        $rs = $this->db
            ->select('*')
            ->where('id',$id)
            ->get('mas_users')
            ->result();
        return $rs;
    }
    public function get_hserv($id){
        $rs = $this->db
            ->select('hserv')
            ->where('hospcode',$id)
            ->get('ref_hserv')
            ->row();
        return $rs;
    } public function get_amp_code($id){
        $rs = $this->db
            ->select('amp_code')
            ->where('hospcode',$id)
            ->get('ref_hserv')
            ->row();
        return $rs;
    }
}