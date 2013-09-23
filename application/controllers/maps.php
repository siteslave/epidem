<?php
class Maps extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->layout->setLayout('maps_layout');

        $this->load->model('Basic_model', 'basic');
        $this->load->model('Map_model', 'maps');
        $this->load->model('Ampur_model', 'ampur');
    }

    public function index()
    {
        $data['code506'] = $this->basic->get_code506_list();
        $data['nation']  = $this->basic->get_nation_list();

        $this->layout->view('maps_view', $data);
    }

    public function get_map()
    {
        $s = $this->input->post('s');
        $e = $this->input->post('e');

        $s = to_mysql_date($s);
        $e = to_mysql_date($e);

        $a = $this->input->post('a');
        $c = $this->input->post('c');
        $p = $this->input->post('p');
        $n = $this->input->post('n');

        $by_date = !empty($s) && !empty($e);

        if($by_date)
        {
            if(!empty($a) && empty($c) && empty($p) && empty($n))
            {
                $rs = $this->maps->get_by_ampur($a, $s, $e);
            }
            else if(!empty($a) && !empty($c) && empty($p) && empty($n))
            {
                $rs = $this->maps->get_by_ampur_code506($a, $c, $s, $e);
            }
            else if(!empty($a) && !empty($c) && !empty($p) && empty($n))
            {
                $rs = $this->maps->get_by_ampur_code506_ptstatus($a, $c, $p, $s, $e);
            }
            else if(!empty($a) && !empty($c) && empty($p) && !empty($n))
            {
                $rs = $this->maps->get_by_ampur_code506_nation($a, $c, $p, $s, $e);
            }
            else if(!empty($a) && !empty($c) && !empty($p) && !empty($n))
            {
                $rs = $this->maps->get_by_ampur_code506_ptstatus_nation($a, $c, $p, $n, $s, $e);
            }
            else if(!empty($a) && empty($c) && !empty($p) && empty($n))
            {
                $rs = $this->maps->get_by_ampur_ptstatus($a, $p, $s, $e);
            }
            else if(!empty($a) && empty($c) && !empty($p) && !empty($n))
            {
                $rs = $this->maps->get_by_ampur_ptstatus_nation($a, $p, $n, $s, $e);
            }
            else if(!empty($a) && empty($c) && empty($p) && !empty($n))
            {
                $rs = $this->maps->get_by_ampur_nation($a, $n, $s, $e);
            }

            //code 506

            else if(empty($a) && !empty($c) && empty($p) && empty($n))
            {
                $rs = $this->maps->get_by_code506($c, $s, $e);
            }
            else if(empty($a) && !empty($c) && !empty($p) && empty($n))
            {
                $rs = $this->maps->get_by_code506_ptstatus($c, $p, $s, $e);
            }
            else if(empty($a) && !empty($c) && empty($p) && !empty($n))
            {
                $rs = $this->maps->get_by_code506_nation($c, $n, $s, $e);
            }
            else if(empty($a) && !empty($c) && !empty($p) && !empty($n))
            {
                $rs = $this->maps->get_by_code506_ptstatus_nation($c, $p, $n, $s, $e);
            }

            //ptstatus

            else if(empty($a) && empty($c) && !empty($p) && empty($n))
            {
                $rs = $this->maps->get_by_ptstatus($p, $s, $e);
            }
            else if(empty($a) && empty($c) && !empty($p) && !empty($n))
            {
                $rs = $this->maps->get_by_ptstatus_nation($p, $n, $s, $e);
            }

            //nation
            else if(empty($a) && empty($c) && empty($p) && !empty($n))
            {
                $rs = $this->maps->get_by_nation($n, $s, $e);
            }

            //get all

            else
            {
                $rs = $this->maps->get_all($s, $e);
            }

            if($rs)
            {
                $rows = array();

                foreach($rs as $r)
                {
                    $obj = new stdClass();
                    $obj->name = $r->name;
                    $obj->birth = to_thai_date($r->birth);
                    $obj->age = count_age($r->birth);
                    $obj->lat = empty($r->latitude) ? null : (float) $r->latitude;
                    $obj->lng = empty($r->longtitude) ? null : (float) $r->longtitude;
                    $obj->nation = get_nation_nhso_name($r->nation);

                    array_push($rows, $obj);

                }
                $json = '{"success": true, "rows": '. json_encode($rows) .'}';
            }
            else
            {
                $json = '{"success": false, "msg": "ไม่พบข้อมูล"}';
            }
        }
        else
        {
            $json = '{"success": false, "msg": "กรุณาระบุวันที่"}';
        }

        render_json($json);
    }

    public function set_map($id)
    {
        $rs = $this->maps->get_person_detail($id);

        if($rs)
        {
            $data = array(
                'id'        => $id,
                'fullname'  => $rs->name,
                'cid'       => $rs->cid,
                'lat'       => $rs->latitude,
                'lng'       => $rs->longtitude
            );

            $this->layout->view('set_map_view', $data);
        }
        else
        {
            show_404();
        }

    }

    public function show_map($id)
    {
        $rs = $this->maps->get_person_detail($id);

        /*
         * $obj->address   = $r->address . ' ' . get_address($r->addrcode);
                $obj->diag      = $r->icd10 . ' ' . $this->basic->get_diagname($r->icd10);
                $obj->code506   = $r->disease . ' ' . $this->basic->get_code506name($r->disease);
         */
        if($rs)
        {
            $data = array(
                'id'            => $id,
                'fullname'      => $rs->name,
                'cid'           => $rs->cid,
                'lat'           => $rs->latitude,
                'lng'           => $rs->longtitude,
                'code506'       => $rs->disease . ' ' . $this->basic->get_code506name($rs->disease),
                'address'       => $rs->address . ' ' . get_address($rs->addrcode),
                'comp'          => $this->basic->get_complication_list(),
                'code506'       => $this->basic->get_code506_list(),
                'chw'           => $this->basic->get_changwat_list(),
                'occupation'    => $this->basic->get_occupation_list(),
                'nation'        => $this->basic->get_nation_list(),
                'hospital_type' => $this->basic->get_hospital_type_list()
            );

            $this->layout->view('show_map_view', $data);
        }
        else
        {
            show_404();
        }

    }

    public function save_map()
    {
        $id = $this->input->post('id');
        $lat = $this->input->post('lat');
        $lng = $this->input->post('lng');

        if(!empty($id) && !empty($lat) && !empty($lng))
        {
            $rs = $this->maps->save_map($id, $lat, $lng);

            if($rs)
            {
                $json = '{"success": true}';
            }
            else
            {
                $json = '{"success": false, "msg": "ไม่สามารถระบุพิกัดได้"}';
            }
        }
        else
        {
            $json = '{"success": false, "msg": "กรุณาระบุพิกัด"}';
        }

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

}