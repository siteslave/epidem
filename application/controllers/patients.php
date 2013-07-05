<?php

class Patients extends CI_Controller
{

    public $pcucode;

    public function __construct()
    {
        parent::__construct();

        //load model
        $this->load->model('Patient_model', 'patient');
    }
 
    public function imports()
    {
        $this->layout->view('patients/import_view');
    }

    public function do_import()
    {
        
    }

    public function get_import_list()
    {
        if($this->input->is_ajax())
        {
            $result = $this->patient->get_import_list($s, $e);

            if($result)
            {
                $rows = json_encode($result);
                $json = '{"success": true, "rows": '.$rows.'}';
            }
            else
            {
                $json = '{"success": false, "msg": "ไม่พบข้อมูล."}';
            }

            render_json($json);
        }
        else
        {
            echo 'Not ajax.';
        }
    }

}