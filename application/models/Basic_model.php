<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Basic model
 *
 * @author  Mr.Satit Rianpit <rianpit@yahoo.com>
 * @copyright   MKHO <http://mkho.moph.go.th>
 *
 */

class Basic_model extends CI_Model
{
    public function get_changwat_list()
    {
        $sql = 'select code, name, left(code, 2) as chw
            from ref_catms c
            where substr(code, 3, 6)="000000"
            order by name';

        $rs = $this->db->query($sql)->result();

        return $rs;
    }
    public function get_ampur_list($chw)
    {
        $sql = 'select substr(code, 3, 2) as code, name
                from ref_catms c
                where substr(code, 1, 2) = "'.$chw.'"
                and substr(code, 3, 2) <> "00"
                and substr(code, 5, 2) = "00"
                and substr(code, 7, 2) = "00"
                order by name';

        $rs = $this->db->query($sql)->result();

        return $rs;
    }

    public function get_tambon_list($chw, $amp)
    {
        $sql = 'select substr(code, 5, 2) as code, name
                from ref_catms c
                where substr(code, 1, 2) = "'.$chw.'"
                and substr(code, 3, 2) = "'.$amp.'"
                and substr(code, 5, 2) <> "00"
                and substr(code, 7, 2) = "00"
                order by name';

        $rs = $this->db->query($sql)->result();

        return $rs;
    }

    public function get_moo_list($chw, $amp, $tmb)
    {
        $sql = 'select substr(code, 7, 2) as code, name
                from ref_catms c
                where substr(code, 1, 2) = "'.$chw.'"
                and substr(code, 3, 2) = "'.$amp.'"
                and substr(code, 5, 2) = "'.$tmb.'"
                and substr(code, 7, 2) not in ("00", "77")
                order by code';

        $rs = $this->db->query($sql)->result();

        return $rs;
    }

    function get_tmb_name($chw, $amp, $tmb)
    {
        $rs = $this->db
            ->where(array('code' => $chw . $amp . $tmb .'00'))
            ->get('ref_catms')
            ->row();

        return $rs ? $rs->name : '-';
    }

    function get_moo_name($chw, $amp, $tmb, $moo)
    {
        $rs = $this->db
            ->where(array('code' => $chw . $amp . $tmb . $moo))
            ->get('ref_catms')
            ->row();

        return $rs ? $rs->name : '-';
    }

    function get_ampur_name($chw, $amp)
    {
        $rs = $this->db
            ->where(array('code' => $chw . $amp .'0000'))
            ->get('ref_catms')
            ->row();

        return $rs ? $rs->name : '-';
    }

    function get_province_name($chw)
    {
        $rs = $this->db
            ->where(array('code' => $chw . '000000'))
            ->get('ref_catms')
            ->row();

        return $rs ? $rs->name : '-';
    }

    public function get_code506_list()
    {
        $rs = $this->db->get('ref_code506')->result();
        return $rs;
    }

    public function get_complication_list()
    {
        $rs = $this->db->get('ref_complication')->result();
        return $rs;
    }
    
    public function get_ogranism_list($code506)
    {
        $rs = $this->db
            ->where(array('code506' => $code506))
            ->get('ref_organisms')
            ->result();

        return $rs;
    }
    public function search_icd_ajax($q)
    {
        $sql = '
                select desc_r, code
                from ref_icd10
                where code like "'.$q.'%"
                or desc_r like "%'.$q.'%"
                limit 20
        ';

        $rs = $this->db->query($sql)->result();
        return $rs;
    }

    public function get_occupation_list() 
    {
        $rs = $this->db
            ->order_by('code')
            ->get('ref_nhso_occupation')
            ->result();

        return $rs;
    }

    public function get_nation_list() 
    {
        $rs = $this->db
            ->order_by('code')
            ->get('ref_nhso_nation')
            ->result();

        return $rs;
    }
    
    public function get_hospital_type_list() 
    {
        $rs = $this->db
            ->order_by('code')
            ->get('ref_hospital_type')
            ->result();

        return $rs;
    }

    public function get_diagname($code)
    {
        $rs = $this->db
            ->select(array('desc_r'))
            ->where(array('code' => $code))
            ->get('ref_icd10')
            ->row();

        return count($rs) > 0 ? $rs->desc_r : '-';
    }
    public function get_diag506name($code)
    {
        $rs = $this->db
            ->select(array('name'))
            ->where(array('code' => $code))
            ->get('ref_code506')
            ->row();

        return count($rs) > 0 ? $rs->name : '-';
    }

    public function get_506_nation($nhso_code)
    {
        $rs = $this->db
            ->where(array('nhso_code' => $nhso_code))
            ->get('ref_nation')
            ->row();

        return count($rs) > 0 ? $rs->code : '8';
    }

    public function get_506_occupation($nhso_code)
    {
        $rs = $this->db
            ->where(array('nhso_code' => $nhso_code))
            ->get('ref_occupation')
            ->row();

        return count($rs) > 0 ? $rs->code : '9999';
    }
    public function get_sex($sex){
        switch ($sex) {
            case 1:
                $r = "ชาย";
                break;
            case 2:
                $r = "หญิง";
                break;
            default:
                $rs = "ไม่ทราบ";
                break;
        }
        return $r;
    }
    public function get_mstatus($m){
        $rs = $this->db
            ->where(array('mstatus_code' => $m))
            ->get('ref_mstatus')
            ->row();

        return count($rs) > 0 ? $rs->mstatus_desc : '-';
    }
    public function get_nation($m){
        $rs = $this->db
            ->where(array('code' => $m))
            ->get('ref_nhso_nation')
            ->row();

        return count($rs) > 0 ? $rs->name : '-';
    }
 public function get_occupation($m){
        $rs = $this->db
            ->where(array('code' => $m))
            ->get('ref_nhso_occupation')
            ->row();
        return count($rs) > 0 ? $rs->name : '-';
    }
    public function encode($txt){
        $en=base64_encode(md5(md5($txt).'84c9aef34f7bc237'));
        return $en;
    }
}

/* End of file basic_model.php */
/* Location: ./application/models/basic_model.php */