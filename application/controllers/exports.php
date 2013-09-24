<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exports extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        if(!$this->session->userdata('username'))
            redirect(site_url('users/login'));

        $this->hospcode = $this->session->userdata('hospcode');
        $this->hserv = $this->session->userdata('hserv');
        $this->amp_code = $this->session->userdata('amp_code');
        $this->user_level = $this->session->userdata('user_level');

        if($this->user_level == '3')
            $this->layout->setLayout('default_layout');

        if($this->user_level == '2')
            $this->layout->setLayout('ampur_layout');

        if($this->user_level == '1')
            redirect(site_url('admin'));

        $this->load->model('Exports_model', 'exports');
        $this->exports->hserv = $this->hserv;
        $this->exports->hospcode = $this->hospcode;

    }
    public function index()
    {
        $this->layout->view('export_view');
    }

    public function get_list()
    {
        $start = $this->input->post('start');
        $stop = $this->input->post('stop');

        $s = $this->input->post('s');
        $e = $this->input->post('e');

        $s = to_mysql_date($s);
        $e = to_mysql_date($e);

        $start = empty($start) ? 0 : $start;
        $stop = empty($stop) ? 25 : $stop;

        $limit = (int) $stop - (int) $start;

        $rs = $this->exports->get_list($s, $e, $start, $limit);

        if($rs)
        {
            $arr_result = array();

            foreach($rs as $r)
            {
                $obj = new stdClass();

                $obj->e0        = $r->e0_hosp;
                $obj->e1        = $r->e1_hosp;

                $obj->id        =$r->id;
                $obj->name      = $r->name;
                $obj->datesick  = to_thai_date($r->datesick);
                $obj->address   = $r->address . ' ' . get_address($r->addrcode);
                $obj->diag      = $r->icd10 . ' ' . $this->basic->get_diagname($r->icd10);
                $obj->code506   = $r->disease . ' ' . $this->basic->get_code506name($r->disease);
                $obj->nation    = get_nation_nhso_name($r->nation);
                $obj->ptstatus  = $r->result;

                $arr_result[] = $obj;
            }

            $rows = json_encode($arr_result);
            $json = '{"success": true, "rows": '.$rows.'}';
        }
        else
        {
            $json = '{"success": false, "msg": "No result."}';
        }

        render_json($json);
    }

    public function get_total()
    {
        $s = $this->input->post('s');
        $e = $this->input->post('e');

        $s = to_mysql_date($s);
        $e = to_mysql_date($e);

        $total = $this->exports->get_total($s, $e);

        $json = '{"success": true, "total": '.$total.'}';
        render_json($json);
    }

    public function do_export()
    {

        $this->load->dbutil();
        $this->load->helper('download');

        $s = $this->input->get('s');
        $e = $this->input->get('e');

        $s = to_mysql_date($s);
        $e = to_mysql_date($e);

        if($this->user_level == '1')
        {
            $sql = '
                select e.e0 as E0, e.e1 as E1, NULL as PE0, NULL as PE1, e.disease as DISEASE,
                e.name as NAME, e.hn as HN, e.nmepat as NMEPAT, e.sex as SEX, e.agey as AGEY,
                e.agem as AGEM, e.aged as AGED, e.marietal as MARIETAL, e.nation as RACE, e.race1 as RACE1,
                e.occupat as OCCUPAT, e.address as ADDRESS, e.addrcode as ADDRCODE, e.metropol as METROPOL,
                e.hospital as HOSPITAL, e.type as TYPE, e.result as RESULT, e.hserv as HSERV, e.class as CLASS,
                e.school as SCHOOL, date_format(e.datesick, "%d/%m/%Y %H:%i:%s") as DATESICK, date_format(e.datedefine, "%d/%m/%Y %H:%i:%s") as DATEDEFINE,
                date_format(e.datedeath, "%d/%m/%Y %H:%i:%s") as DATEDEATH, date_format(e.daterecord, "%d/%m/%Y %H:%i:%s") as DATERECORD,
                date_format(e.datereach, "%d/%m/%Y %H:%i:%s") as DATEREACH, e.intime as INTIME, e.organism as ORGANISM, e.complica as COMPLICA,
                e.cid as IDCARD, e.icd10 as ICD10, e.office_id as OFFICEID

                from epe0 e

                where e.datesick between "'. $s .'" and "'. $e .'"
                and e.hospcode="'. $this->hospcode .'"
                ';
        }
        else if($this->user_level == '2')
        {
            $sql = '
                select e.e0_sso as E0, e.e1_sso as E1, NULL as PE0, NULL as PE1, e.disease as DISEASE,
                e.name as NAME, e.hn as HN, e.nmepat as NMEPAT, e.sex as SEX, e.agey as AGEY,
                e.agem as AGEM, e.aged as AGED, e.marietal as MARIETAL, e.nation as RACE, e.race1 as RACE1,
                e.occupat as OCCUPAT, e.address as ADDRESS, e.addrcode as ADDRCODE, e.metropol as METROPOL,
                e.hospital as HOSPITAL, e.type as TYPE, e.result as RESULT, e.hserv as HSERV, e.class as CLASS,
                e.school as SCHOOL, date_format(e.datesick, "%d/%m/%Y %H:%i:%s") as DATESICK, date_format(e.datedefine, "%d/%m/%Y %H:%i:%s") as DATEDEFINE,
                date_format(e.datedeath, "%d/%m/%Y %H:%i:%s") as DATEDEATH, date_format(e.daterecord, "%d/%m/%Y %H:%i:%s") as DATERECORD,
                date_format(e.datereach, "%d/%m/%Y %H:%i:%s") as DATEREACH, e.intime as INTIME, e.organism as ORGANISM, e.complica as COMPLICA,
                e.cid as IDCARD, e.icd10 as ICD10, e.office_id as OFFICEID

                from epe0 e

                where e.datesick between "'. $s .'" and "'. $e .'"
                and e.hospcode="'. $this->hospcode .'"
                ';
        }
        else
        {
            $sql = '
                select e.e0_hosp as E0, e.e1_hosp as E1, NULL as PE0, NULL as PE1, e.disease as DISEASE,
                e.name as NAME, e.hn as HN, e.nmepat as NMEPAT, e.sex as SEX, e.agey as AGEY,
                e.agem as AGEM, e.aged as AGED, e.marietal as MARIETAL, e.nation as RACE, e.race1 as RACE1,
                e.occupat as OCCUPAT, e.address as ADDRESS, e.addrcode as ADDRCODE, e.metropol as METROPOL,
                e.hospital as HOSPITAL, e.type as TYPE, e.result as RESULT, e.hserv as HSERV, e.class as CLASS,
                e.school as SCHOOL, date_format(e.datesick, "%d/%m/%Y %H:%i:%s") as DATESICK, date_format(e.datedefine, "%d/%m/%Y %H:%i:%s") as DATEDEFINE,
                date_format(e.datedeath, "%d/%m/%Y %H:%i:%s") as DATEDEATH, date_format(e.daterecord, "%d/%m/%Y %H:%i:%s") as DATERECORD,
                date_format(e.datereach, "%d/%m/%Y %H:%i:%s") as DATEREACH, e.intime as INTIME, e.organism as ORGANISM, e.complica as COMPLICA,
                e.cid as IDCARD, e.icd10 as ICD10, e.office_id as OFFICEID

                from epe0 e

                where e.datesick between "'. $s .'" and "'. $e .'"
                and e.hospcode="'. $this->hospcode .'"
                ';
        }

        $query = $this->db->query($sql);

        $delim = ",";
        $newline = "\r\n";
        $enclosure = '"';

        $header = '';
        $data = '';
        //field name
        foreach ($query->list_fields() as $name)
        {
            $header .= $enclosure.str_replace($enclosure, $enclosure.$enclosure, $name).$enclosure.$delim;
        }
        $header = substr(rtrim($header), 0, -1);
        $header .= $newline;

        // data
        foreach ($query->result_array() as $row)
        {
            foreach ($row as $item)
            {
                $data .= $enclosure.str_replace($enclosure, $enclosure.$enclosure, $item).$enclosure.$delim;
            }

            $data = substr(rtrim($data), 0, -1);
            $data .= $newline;
        }

        $csv = $header . $data;
		$csv = iconv('UTF-8' , 'TIS-620' , $csv);
		
		$path = './exports/';
        $file_export = $path . 'EPIDEM-' . date('YmdHis') . '.txt';
		
		if($open = fopen($file_export ,"w"))
		{
			fputs($open, $csv);
			fclose($open);
		
			//load library
			$this->load->library('zip');
			//add file
			$this->zip->read_file($file_export);
			//new zip file
			$zip_file = $path . 'EPIDEM-' . date('YmdHis') . '.zip';
			//create zip file
			$this->zip->archive($zip_file); 
			//force download
			$this->zip->download($zip_file);
		}
		else 
		{
			echo 'Can\'t not export file';
		}
    }
}
