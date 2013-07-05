<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Patient model
 *
 * @author  Mr.Satit Rianpit <rianpit@yahoo.com>
 * @copyright   MKHO <http://mkho.moph.go.th>
 *
*/
class Patient_model extends CI_Model {

    public $pcucode;

    public function get_import_list($s, $e)
    {
        $rs = $this->db->where('DATE_SERV >=', to_mysql_date($s))
            ->where('DATE_SERV <=', to_mysql_date($e))
            ->where('PCUCODE', (string) $this->pcucode)
            ->get('surveillance')
            ->result();

        return $rs;
    }
}

/* End of file patient_model.php */
/* Location: ./application/models/patient_model.php */