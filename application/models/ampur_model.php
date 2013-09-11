<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Patient model
 *
 * @author  Mr.Satit Rianpit <rianpit@yahoo.com>
 * @copyright   MKHO <http://mkho.moph.go.th>
 *
 */
class Ampur_model extends CI_Model
{

    public function get_list($amp_code,$start, $limit)
    {
        $result = $this->db
            ->where('amp_code',$amp_code)
            ->where('e0_sso IS NOT NULL')
            ->order_by('e0_sso')
            ->limit($limit, $start)
            ->get('epe0')
            ->result();
        return $result;
    }

    public function get_list_by_ptstatus($amp_code,$start, $limit, $p)
    {
        $result = $this->db
            ->where('amp_code',$amp_code)
            ->where('e0_sso IS NOT NULL')
            ->where('result', $p)
            ->order_by('e0_sso')
            ->limit($limit, $start)
            ->get('epe0')
            ->result();
        return $result;
    }

    public function search($amp_code, $q)
    {
        $sql = '
            select * from epe0
            where amp_code="'. $amp_code .'"
            and e0_sso is not null
            and (
            cid="'. $q .'"
            or hn="'. $q .'"
            or name like "%'. $q .'%"
            )
        ';

        $rs = $this->db->query($sql)->result();

        return $rs;
    }

    public function get_list_filter($amp_code, $s, $e, $start, $limit)
    {
        $result = $this->db
            ->where('amp_code',$amp_code)
            ->where('e0_sso IS NOT NULL')
            //->where('result', $p)
            ->where('datesick >=', $s)
            ->where('datesick <=', $e)

            ->order_by('e0_sso')
            ->limit($limit, $start)
            ->get('epe0')
            ->result();
        return $result;
    }

    public function get_list_filter_by_ptstatus($amp_code, $s, $e, $start, $limit, $p)
    {
        $result = $this->db
            ->where('amp_code',$amp_code)
            ->where('e0_sso IS NOT NULL')
            ->where('result', $p)
            ->where('datesick >=', $s)
            ->where('datesick <=', $e)

            ->order_by('e0_sso')
            ->limit($limit, $start)
            ->get('epe0')
            ->result();
        return $result;
    }

    public function get_list_total_filter($amp_code, $s, $e){
        $rs = $this->db
            ->where('amp_code',$amp_code)
            ->where('e0_sso IS NOT NULL')
            //->where('result', $p)
            ->where('datesick >=', $s)
            ->where('datesick <=', $e)

            ->count_all_results('epe0');
        return $rs;
    }

    public function get_list_total_filter_by_ptstatus($amp_code, $s, $e, $p){
        $rs = $this->db
            ->where('amp_code',$amp_code)
            ->where('e0_sso IS NOT NULL')
            ->where('result', $p)
            ->where('datesick >=', $s)
            ->where('datesick <=', $e)

            ->count_all_results('epe0');
        return $rs;
    }

    public function get_list_total($amp_code){
        $rs = $this->db
            ->where('amp_code',$amp_code)
            ->where('e0_sso IS NOT NULL')
            ->count_all_results('epe0');
        return $rs;
    }

    public function get_list_total_by_ptstatus($amp_code, $p){
        $rs = $this->db
            ->where('amp_code',$amp_code)
            ->where('e0_sso IS NOT NULL')
            ->where('result', $p)
            ->count_all_results('epe0');
        return $rs;
    }

    public function get_detail($id)
    {
        $rs = $this->db
            ->where(array('id' => $id))
            ->get('epe0')
            ->result();

        return count($rs) > 0 ? $rs[0] : NULL;
    }

    public function get_waiting_list($amp_code,$start, $limit)
    {
        $rs = $this->db
            ->select(array('e.*', 'i.desc_r as diag_name', 'c.name as code506_name'))
            ->where('e.amp_code' ,$amp_code)
            ->where('e.e0_sso IS NULL')
            ->join('ref_icd10 i', 'i.code=e.icd10', 'left')
            ->join('ref_code506 c', 'c.code=e.disease', 'left')
            ->limit($limit, $start)
            ->order_by('e.datesick')
            ->get('epe0 e')
            ->result();

        return $rs;
    }

    public function get_waiting_list_by_ptstatus($amp_code,$start, $limit, $p)
    {
        $rs = $this->db
            ->select(array('e.*', 'i.desc_r as diag_name', 'c.name as code506_name'))
            ->where('e.amp_code' ,$amp_code)
            ->where('result', $p)
            ->where('e.e0_sso IS NULL')
            ->join('ref_icd10 i', 'i.code=e.icd10', 'left')
            ->join('ref_code506 c', 'c.code=e.disease', 'left')
            ->limit($limit, $start)
            ->order_by('e.datesick')
            ->get('epe0 e')
            ->result();

        return $rs;
    }

    public function get_waiting_list_total($amp_code)
    {
        $rs = $this->db
            ->where('e0_sso IS NULL')
            ->where('amp_code', $amp_code)
            ->count_all_results('epe0');

        return $rs ? $rs : 0;
    }

    public function get_waiting_list_total_by_ptstatus($amp_code, $p)
    {
        $rs = $this->db
            ->where('e0_sso IS NULL')
            ->where('amp_code', $amp_code)
            ->where('result', $p)
            ->count_all_results('epe0');

        return $rs ? $rs : 0;
    }

    public function do_approve($id, $e0, $e1)
    {
        $rs = $this->db
            ->where('id', $id)
            ->set('e0_sso', $e0)
            ->set('e1_sso', $e1)
            ->update('epe0');

        return $rs;
    }

    public function get_e0_sso($amp_code){
        $rs = $this->db
            ->select_max('e0_sso','e0_sso_max')
            ->where('amp_code', $amp_code)
            ->get('epe0')
            ->row();
        return $rs->e0_sso_max;
    }

    public function get_e1_sso($amp_code, $code506){
        $rs = $this->db
            ->select_max('e1_sso',' e1_sso_max')
            ->where('amp_code',$amp_code)
            ->where('disease',$code506)
            ->get('epe0')
            ->row();
        return $rs->e1_sso_max;
    }

}