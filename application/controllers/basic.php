<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Basic Controller
 *
 * @author  Mr.Satit Rianpit <rianpit@yahoo.com>
 * @copyright   MKHO <http://mkho.moph.go.th>
 *
 */
class Basic extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Basic_model', 'basic');
    }

    public function get_ampur_list()
    {
        $chw = $this->input->post('chw');

        $rs = $this->basic->get_ampur_list($chw);
        $rows = json_encode($rs);

        $json = '{"success": true, "rows": '.$rows.'}';
        render_json($json);
    }

    public function get_tambon_list()
    {
        $chw = $this->input->post('chw');
        $amp = $this->input->post('amp');

        $rs = $this->basic->get_tambon_list($chw, $amp);
        $rows = json_encode($rs);

        $json = '{"success": true, "rows": '.$rows.'}';
        render_json($json);
    }
    
    public function get_moo_list()
    {
        $chw = $this->input->post('chw');
        $amp = $this->input->post('amp');
        $tmb = $this->input->post('tmb');

        $rs = $this->basic->get_moo_list($chw, $amp, $tmb);
        $rows = json_encode($rs);

        $json = '{"success": true, "rows": '.$rows.'}';
        render_json($json);
    }
    public function get_organism_list()
    {
        $code506 = $this->input->post('code506');
        $rs = $this->basic->get_ogranism_list($code506);
        $json = '{"success": true, "rows": '.json_encode($rs).'}';

        render_json($json);
    }

    public function search_icd_ajax()
    {
        $q = $this->input->post('query');
        $rs = $this->basic->search_icd_ajax($q);

        $arr_result = array();
        foreach($rs as $r)
        {
            $obj = new stdClass();
            $obj->name = $r->desc_r;
            $arr_result[] = $obj;
        }

        $rows = json_encode($arr_result);
        $json = '{"success": true, "rows": '.$rows.'}';

        render_json($json);
    }
}

/* End of file basic.php */
/* Location: ./application/controlers/basic.php */