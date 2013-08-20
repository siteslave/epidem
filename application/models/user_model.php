<?php
class User_model extends CI_Model
{
    public function do_auth($u, $p)
    {
        $rs = $this->db
            ->select('u.id,u.username,u.name,u.user_level,u.office,off.off_name')

            ->where('username', $u)
            ->where('password', md5(md5($p).'bhjhjghjg'))
           // ->count_all_results('mas_users');
            ->join('co_office off','u.office=off.off_id','LEFT')
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