<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ampur extends CI_Controller
{
    public $hospcode;

    public function __construct()
    {
        parent::__construct();

        if(!$this->session->userdata('username'))
            redirect(site_url('users/login'));

        $this->layout->setLayout('ampur_layout');

        $this->hospcode     = $this->session->userdata('hospcode');
        $this->hserv        = $this->session->userdata('hserv');
        $this->amp_code     = $this->session->userdata('amp_code');
        $this->user_level   = $this->session->userdata('user_level');

        if($this->user_level == '3')
            redirect(site_url());

        if($this->user_level == '1')
            redirect(site_url('admin'));

        $this->load->model('Ampur_model', 'ampur');
        $this->load->model('Basic_model', 'basic');
    }

    public function index()
    {
        $data['comp']           = $this->basic->get_complication_list();
        //$data['org'] = $this->basic->get_ogranism_list();
        $data['code506']        = $this->basic->get_code506_list();
        $data['chw']            = $this->basic->get_changwat_list();
        $data['occpuation']     = $this->basic->get_occupation_list();
        $data['nation']         = $this->basic->get_nation_list();
        $data['hospital_type']  = $this->basic->get_hospital_type_list();

        $this->layout->view('ampur/index_view', $data);
    }

    public function get_list()
    {
        $start = $this->input->post('start');
        $stop = $this->input->post('stop');

        $start = empty($start) ? 0 : $start;
        $stop = empty($stop) ? 25 : $stop;

        $limit = (int) $stop - (int) $start;

        $rs = $this->ampur->get_list($this->amp_code, $start, $limit);

        if($rs)
        {
            $arr_result = array();

            foreach($rs as $r)
            {
                $obj = new stdClass();

                $obj->e0        = $r->e0_sso;
                $obj->e1        = $r->e1_sso;

                $obj->id        = $r->id;
                $obj->cid       = $r->cid;
                $obj->name      = $r->name;
                $obj->datesick  = to_thai_date($r->datesick);
                $obj->address   = $r->address . ' ' . get_address($r->addrcode);
                $obj->diag      = $r->icd10 . ' ' . $this->basic->get_diagname($r->icd10);
                $obj->code506   = $r->disease . ' ' . $this->basic->get_code506name($r->disease);
                $obj->age       = count_age($r->birth);
                $obj->birth     = to_thai_date($r->birth);
                $obj->ptstatus  = $r->result;
                $obj->hospcode  = $r->hospcode;
                $obj->hospname  = get_hospital_name($r->hospcode);

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

    public function get_list_total()
    {
        $total = $this->ampur->get_list_total($this->amp_code);

        $json = '{"success": true, "total": '.$total.'}';
        render_json($json);
    }

    public function get_detail()
    {
        if($this->input->is_ajax_request())
        {
            $id = $this->input->post('id');
            if(!empty($id))
            {
                $rs = $this->ampur->get_detail($id);
                if($rs)
                {
                    $obj = new stdClass();

                    $obj->id            = $rs->id;
                    $obj->disease       = $rs->disease;
                    $obj->name          = $rs->name;
                    $obj->birth         = to_thai_date($rs->birth);
                    $obj->age           = get_current_age($rs->birth);
                    $obj->sex           = $rs->sex;
                    $obj->cid           = $rs->cid;
                    $obj->hn            = $rs->hn;
                    $obj->mstatus       = $rs->marietal;
                    $obj->nation        = $rs->nation;
                    $obj->nmepat       = $rs->nmepat;
                    $obj->occupation    = $rs->occupat;
                    $obj->date_serv     = to_thai_date($rs->datesick);
                    $obj->ptstatus      = $rs->result;
                    $obj->date_death    = to_thai_date($rs->datedeath);
                    $obj->ptstatus_code = $rs->result;
                    $obj->illdate       = to_thai_date($rs->datedefine);
                    $obj->patient_type  = $rs->type;
                    $obj->service_place = $rs->hospital;
                    $obj->school        = $rs->school;
                    $obj->school_class  = $rs->class;
                    $obj->address_type  = $rs->metropol;

                    $obj->chw = substr($rs->addrcode, 0, 2);
                    $obj->amp = substr($rs->addrcode, 2, 2);
                    $obj->tmb = substr($rs->addrcode, 4, 2);
                    $obj->moo = substr($rs->addrcode, 6, 2);

                    $obj->address   = $rs->address;
                    $obj->soi       = $rs->soi;
                    $obj->road      = $rs->road;

                    $obj->code506       = $rs->disease;
                    $obj->diagname      = $this->basic->get_diagname($rs->icd10);
                    $obj->diagcode      = $rs->icd10;
                    $obj->office_id     =$rs->office_id;
                    $obj->complication  = $rs->complica;
                    $obj->organism      = $rs->organism;
                    $obj->date_report   = to_thai_date($rs->datereach);
                    $obj->date_record   = to_thai_date($rs->daterecord);

                    $json = $rs ? '{"success": "true", "rows": ' . json_encode($obj) . '}' : '{"success": false, "msg": "ไม่พบข้อมูล"}';
                }
                else
                {
                    $json = '{"success": false, "msg": "ไม่พบข้อมูล"}';
                }
            }
            else
            {
                $json = '{"success": false, "msg": "ไม่พบรายการ"}';
            }

            render_json($json);
        }
        else
        {
            show_error('Not ajax.', 404);
        }
    }

    public function get_waiting_list_total()
    {
        $rs = $this->ampur->get_waiting_list_total($this->amp_code);

        $json = '{"success": true, "total": ' . $rs . '}';
        render_json($json);
    }

    public function get_waiting_list()
    {
        $start = $this->input->post('start');
        $stop = $this->input->post('stop');

        $start = empty($start) ? 0 : $start;
        $stop = empty($stop) ? 25 : $stop;

        $limit = (int) $stop - (int) $start;

        $rs = $this->ampur->get_waiting_list($this->amp_code, $start, $limit);

        if($rs)
        {
            $arr_result = array();

            foreach($rs as $r)
            {
                $obj = new stdClass();

                $obj->id        =$r->id;
                $obj->name      = $r->name;
                $obj->hn        = $r->hn;
                $obj->cid       = $r->cid;
                $obj->sex       = $r->sex;
                $obj->birth     = to_thai_date($r->birth);
                $obj->age       = count_age($r->birth);
                $obj->datesick  = to_thai_date($r->datesick);
                $obj->ptstatus  = $r->result;
                //$obj->address   = $r->address . ' ' . get_address($r->addrcode);
                $obj->diag      = $r->icd10 . ' ' . $this->basic->get_diagname($r->icd10);
                $obj->code506   = $r->disease;
                $obj->code506_name = $this->basic->get_code506name($r->disease);
                $obj->hospcode  = $r->hospcode;
                $obj->hospname  = get_hospital_name($r->hospcode);

                $arr_result[] = $obj;
            }

            $rows = json_encode($arr_result);
            $json = '{"success": true, "rows": '.$rows.'}';
        }
        else
        {
            $json = '{"success": false, "msg": "ไม่พบข้อมูล"}';
        }

        //$json = $rs ? '{"success": true, "rows": ' . json_encode($rs) . '}' : '{"success": false, "msg": "ไม่พบรายการ"}';
        render_json($json);
    }

    public function do_approve()
    {
        $id = $this->input->post('id');
        $code506 = $this->input->post('code506');

        if(empty($id) || empty($code506))
        {
            $json = '{"success": false, "msg": "ข้อมูลไม่สมบูรณ์ กรุณาตรวจสอบ"}';
        }
        else
        {
            $e0 = ($this->ampur->get_e0_sso($this->amp_code)) + 1;
            $e1 = ($this->ampur->get_e1_sso($this->amp_code, $code506)) + 1;

            $rs = $this->ampur->do_approve($id, $e0, $e1);

            $json = $rs ? '{"success": true}' : '{"success": false, "msg": "ไม่สามารถบันทึกรายการได้"}';
        }

        render_json($json);
    }

}