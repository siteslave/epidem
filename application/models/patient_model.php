<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Patient model
 *
 * @author  Mr.Satit Rianpit <rianpit@yahoo.com>
 * @copyright   MKHO <http://mkho.moph.go.th>
 *
*/
class Patient_model extends CI_Model {

    public $hospcode;
    public $hserv;

    public function get_list_ssj($start, $limit)
    {
        $result = $this->db
            ->where('e0 IS NOT NULL')
            ->order_by('e0')
            ->limit($limit, $start)
            ->get('epe0')
            ->result();
        return $result;
    }

    public function get_list($hospcode,$start, $limit)
    {
        $result = $this->db
            ->where('hospcode',$hospcode)
            ->limit($limit, $start)
            ->get('epe0')
            ->result();
        return $result;
    }

    public function get_list_total($hospcode){
        $rs = $this->db
            ->where('hospcode',$hospcode)
            ->count_all_results('epe0');
        return $rs;
    }

    public function get_list_filter($hospcode, $s, $e, $start, $limit)
    {
        $result = $this->db
            ->where('hospcode',$hospcode)
            ->where('datesick >=', $s)
            ->where('datesick <=', $e)
            ->limit($limit, $start)
            ->get('epe0')
            ->result();
        return $result;
    }

    public function get_list_total_filter($hospcode, $s, $e){
        $rs = $this->db
            ->where('hospcode',$hospcode)
            ->where('datesick >=', $s)
            ->where('datesick <=', $e)
            ->count_all_results('epe0');
        return $rs;
    }

    public function get_list_total_ssj(){
        $rs = $this->db
            ->where('e0 IS NOT NULL')
            ->count_all_results('epe0');
        return $rs;
    }

    public function check_duplicate_tmp($diagcode, $cid, $date_serv)
    {
        $rs = $this->db
            ->where(array(
                'hospcode' => $this->hospcode,
                'diagcode' => $diagcode,
                'cid' => $cid,
                'date_serv' => $date_serv
            ))
            //->or_where('RECORD_STATUS', '1')
            ->count_all_results('surveillance');

        return $rs > 0 ? TRUE : FALSE;
    }
    public function check_tmp_approve_status($diagcode, $cid, $date_serv)
    {
        $rs = $this->db
            ->where(array(
                'hospcode' => $this->hospcode,
                'diagcode' => $diagcode,
                'cid' => $cid,
                'date_serv' => $date_serv
            ))
            ->where_in('record_status', array('1', '2'))
            ->count_all_results('surveillance');

        return $rs > 0 ? TRUE : FALSE;
    }
    public function get_tmp_date_update($diagcode, $cid, $date_serv)
    {
        $rs = $this->db
            ->where(array(
                'hospcode' => $this->hospcode,
                'diagcode' => $diagcode,
                'cid' => $cid,
                'date_serv' => $date_serv
            ))
            ->limit(1)
            ->get('surveillance')
            ->row();

        return $rs ? $rs->d_update : NULL;
    }


    public function get_import($s, $e, $start, $limit)
    {
        $rs = $this->db
            ->select(array('s.*', 'i.desc_r as diagname'))
            ->where(array(
                'date_serv >=' => $s,
                'date_serv <=' => $e,
                'hospcode' => $this->hospcode
            ))
            ->where_not_in('record_status', array('2', '3'))
            ->join('ref_icd10 i', 'i.code=s.diagcode', 'left')
            ->limit($limit, $start)
            ->get('surveillance s')
            ->result();

        return $rs;
    }

    public function get_import_total($s, $e)
    {
        $rs = $this->db
           ->where(array(
                'date_serv >=' => $s,
                'date_serv <=' => $e,
                'hospcode' => $this->hospcode
            ))
            //->where('date_serv BETWEEN ',$s.' AND '.$e,false)
            ->where_not_in('record_status', array('2', '3'))
            ->count_all_results('surveillance');

        return $rs;
    }

    public function get_tmp_detail($id)
    {
        $rs = $this->db
            ->where(array('id' => $id))
            ->get('surveillance')
            ->result();

        return count($rs) > 0 ? $rs[0] : NULL;
    }
    public function get_e0_detail($id)
    {
        $rs = $this->db
            ->where(array('id' => $id))
            ->get('epe0')
            ->result();

        return count($rs) > 0 ? $rs[0] : NULL;
    }

    public function insert_tmp($data)
    {
        $rs = $this->db
            ->set('an', $data->AN)
            ->set('birth', $data->BIRTH)
            ->set('cid', $data->CID)
            ->set('code506', $data->CODE506)
            ->set('code506last', $data->CODE506LAST)
            ->set('complication', $data->COMPLICATION)
            ->set('datetime_admit', $data->DATETIME_ADMIT)
            ->set('date_death', $data->DATE_DEATH)
            ->set('date_serv', $data->DATE_SERV)
            ->set('diagcode', $data->DIAGCODE)
            ->set('diagcodelast', $data->DIAGCODELAST)
            ->set('d_update', $data->D_UPDATE)
            ->set('hn', $data->HN)
            ->set('hospcode', $data->HOSPCODE)
            ->set('illampur', $data->ILLAMPUR)
            ->set('illchangwat', $data->ILLCHANGWAT)
            ->set('illdate', $data->ILLDATE)
            ->set('illhouse', $data->ILLHOUSE)
            ->set('illtambon', $data->ILLTAMBON)
            ->set('illvillage', $data->ILLVILLAGE)
            ->set('latitude', $data->LATITUDE)
            ->set('lname', $data->LNAME)
            ->set('longitude', $data->LONGITUDE)
            ->set('mom_name', $data->MOM_NAME)
            ->set('mstatus', $data->MSTATUS)
            ->set('name', $data->NAME)
            ->set('nation', $data->NATION)
            ->set('occupation_new', $data->OCCUPATION_NEW)
            ->set('organism', $data->ORGANISM)
            ->set('provider', $data->PROVIDER)
            ->set('ptstatus', $data->PTSTATUS)
            ->set('sex', $data->SEX)
            ->set('syndrome', $data->SYNDROME)
            ->set('year', $data->YEAR)
            ->set('record_status', '1')
            ->insert('surveillance');

        return $rs;
    }
    public function update_tmp($data)
    {
        $rs = $this->db
            ->where(array(
                'hospcode' => $this->hospcode,
                'diagcode' => $data->DIAGCODE,
                'cid' => $data->CID,
                'date_serv' => $data->DATE_SERV
            ))
            ->set('an', $data->AN)
            ->set('birth', $data->BIRTH)
            //->set('CID', $data->CID)
            ->set('code506', $data->CODE506)
            ->set('code506last', $data->CODE506LAST)
            ->set('complication', $data->COMPLICATION)
            ->set('datetime_admit', $data->DATETIME_ADMIT)
            ->set('date_death', $data->DATE_DEATH)
            //->set('DATE_SERV', $data->DATE_SERV)
            //->set('DIAGCODE', $data->DIAGCODE)
            ->set('diagcodelast', $data->DIAGCODELAST)
            ->set('d_update', $data->D_UPDATE)
            ->set('hn', $data->HN)
            //->set('HOSPCODE', $data->HOSPCODE)
            ->set('illampur', $data->ILLAMPUR)
            ->set('illchangwat', $data->ILLCHANGWAT)
            ->set('illdate', $data->ILLDATE)
            ->set('illhouse', $data->ILLHOUSE)
            ->set('illtambon', $data->ILLTAMBON)
            ->set('illvillage', $data->ILLVILLAGE)
            ->set('latitude', $data->LATITUDE)
            ->set('lname', $data->LNAME)
            ->set('longitude', $data->LONGITUDE)
            ->set('mom_name', $data->MOM_NAME)
            ->set('mstatus', $data->MSTATUS)
            ->set('name', $data->NAME)
            ->set('nation', $data->NATION)
            ->set('occupation_new', $data->OCCUPATION_NEW)
            ->set('organism', $data->ORGANISM)
            ->set('provider', $data->PROVIDER)
            ->set('ptstatus', $data->PTSTATUS)
            ->set('sex', $data->SEX)
            ->set('syndrome', $data->SYNDROME)
            ->set('year', $data->YEAR)
            ->update('surveillance');

        return $rs;
    }

    public function remove_tmp($id)
    {
        $rs = $this->db
            ->set('record_status', '3')
            ->where(array('id' => $id))
            ->update('surveillance');
        return $rs;
    }
    public function update_tmp_record_status($id)
    {
        $rs = $this->db
            ->set('record_status', '1')
            ->where(array('id' => $id))
            ->update('surveillance');

        return $rs;
    }

    public function get_waiting_list_ssj($start, $limit)
    {
        $rs = $this->db
            ->select(array('s.*', 'i.desc_r as diagname','d506.name as dname506'))

            ->where('e0 IS NULL')
            ->where('e0_sso IS NOT NULL')
            ->join('ref_icd10 i', 'i.code=s.icd10', 'left')
            ->join('ref_code506 d506', 'd506.code=s.disease', 'left')
            ->limit($limit, $start)
            ->order_by('datesick')
            ->get('epe0 s')
            ->result();

        return $rs;
    }

    public function get_waiting_list($hospcode,$start, $limit)
    {
        $rs = $this->db
            ->select(array('s.*', 'i.desc_r as diagname','d506.name as dname506'))
            ->where(array(
                's.record_status' => '1',
                's.hospcode' => $hospcode))
            ->join('ref_icd10 i', 'i.code=s.diagcode', 'left')
            ->join('ref_code506 d506', 'd506.code=s.code506', 'left')
            ->limit($limit, $start)
            ->order_by('date_serv')
            ->get('surveillance s')
            ->result();

        return $rs;
    }
    public function get_waiting_list_total($hospcode)
    {
        $rs = $this->db
            ->where(array(
                'record_status' => '1', 
                'hospcode' => $hospcode,
            ))
            ->count_all_results('surveillance');

        return $rs ? $rs : 0;
    }

 public function get_waiting_list_total_ssj()
    {
        $rs = $this->db
            ->where('e0_sso IS NOT NULL')
            ->where('e0 IS  NULL')
            ->count_all_results('epe0');

        return $rs ? $rs : 0;

        return $rs ? $rs : 0;
    }

    public function get_waiting_detail($id)
    {
        $rs = $this->db
            ->where(array('id' => $id))
            ->get('surveillance')
            ->result();

        return $rs;
    }

    public function updat_waiting_status($id, $status)
    {
        $rs = $this->db
            ->where(array('id' => $id))
            ->set('record_status', '2')
            ->update('surveillance');

        return $rs;
    }

    public function check_e0_exist($hospcode,$hn,$date_serv, $diagcode)
    {
        $rs = $this->db
            ->where(array(
                'hospcode' => $hospcode,
                'hn'=>$hn,
                'datesick' => $date_serv,
                'icd10' => $diagcode

            ))
            ->count_all_results('epe0');

        return $rs > 0 ? TRUE : FALSE;
    }

    public function save($data)
    {
        $rs = $this->db
        //->set('year', $data['year'])
            ->set('hospcode', $this->hospcode)
        //->set('e0', $data['e0'])
        //->set('e1', $data['e1'])
        //->set('e0_sso', $data['e0_sso'])
        //->set('e1_sso', $data['e1_sso'])
            ->set('e0_hosp', $data['e0_hosp'])
            ->set('e1_hosp', $data['e1_hosp'])
            ->set('cid', $data['cid'])
            ->set('amp_code', $data['amp_code'])
            ->set('disease', $data['code506'])
            ->set('birth', to_mysql_date($data['birth']))
            ->set('name', $data['name'] . ' ' . $data['lname'])
            ->set('hn', $data['hn'])
            ->set('nation', $data['nation'])
            ->set('nmepat', $data['nmepat'])
            ->set('sex', $data['sex'])
            ->set('agey', $data['agey'])
            ->set('agem', $data['agem'])
            ->set('aged', $data['aged'])
            ->set('marietal', $data['mstatus'])
        //->set('race', $data[''])
        //->set('race1', $data['year'])
            ->set('occupat', $data['occupation'])
            ->set('address', $data['address'])
            ->set('soi', $data['soi'])
            ->set('road', $data['road'])
            ->set('addrcode', $data['addrcode'])
            ->set('metropol', $data['address_type'])
            ->set('hospital', $data['service_place'])
            ->set('type', $data['patient_type'])
            ->set('result', $data['ptstatus'])
            ->set('hserv', $data['hserv'])
            ->set('class', $data['school_class'])
            ->set('school', $data['school'])
            ->set('datesick', to_mysql_date($data['illdate']))
            ->set('datedefine', to_mysql_date($data['date_serv']))
            ->set('datedeath', to_mysql_date($data['date_death']))
            ->set('daterecord', to_mysql_date($data['date_record']))
            ->set('datereach', to_mysql_date($data['date_report']))
        //->set('intime', $data['year'])
            ->set('organism', $data['ogranism'])
            ->set('complica', $data['complication'])
        //->set('idrecord', $data['year'])
            ->set('icd10', $data['diagcode'])
        //->set('office_id', $data['year'])
        //->set('confirm', $data['year'])
            ->set('last_update', date('Y-m-d H:i:s'))
            ->insert('epe0');

        return $rs;
    }

    public function save_e0($data)
    {
        if($this->session->userdata('user_level')==1){
        $rs = $this->db
            ->where('id',$data['id'])
            ->set('e0', $data['e0'])
            ->set('e1', $data['e1'])
            ->update('epe0');
        }elseif($this->session->userdata('user_level')==2){
            $rs = $this->db
                ->where('id',$data['id'])
                ->set('e0_sso', $data['e0_sso'])
                ->set('e1_sso', $data['e1_sso'])
                ->update('epe0');
        }
        return $rs;
    }

    public function get_e0(){
        $rs = $this->db
            ->select_max('e0' ,'e0_max')
            ->get('epe0')
            ->row();
        return $rs;
    }

    public function get_e1($code506){
        $rs = $this->db
            ->select_max('e1',' e1_max')
            ->where('disease',$code506)
            ->where('e1 IS NOT NULL')
            ->get('epe0')
            ->row();
        return $rs;
    }

    public function get_e0_hosp($hospcode){
        $rs = $this->db
            ->select_max('e0_hosp','e0_hosp_max')
            ->where('hospcode',$hospcode)
            ->get('epe0')
            ->row();
        return $rs;
    }

    public function get_e1_hosp($hospcode,$code506){
        $rs = $this->db
            ->select_max('e1_hosp','e1_hosp_max')
            ->where('hospcode',$hospcode)
            ->where('disease',$code506)
            ->get('epe0')
            ->row();
        return $rs;
    }
}

/* End of file patient_model.php */
/* Location: ./application/models/patient_model.php */