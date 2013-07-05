<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Patient model
 *
 * @author  Mr.Satit Rianpit <rianpit@yahoo.com>
 * @copyright   MKHO <http://mkho.moph.go.th>
 *
 */
class Serial_model extends CI_Model {

    public $pcucode;

    public function get_serial($t)
    {
        $rs = $this->db
            ->where('name', $t)
            ->where('pcucode', $this->pcucode)
            ->get('sys_serials')
            ->row();

        return $rs->serial_no ? $rs->serial_no : 0;
    }
    public function serial_exist($t)
    {
        $rs = $this->db
            ->where('name', $t)
            ->where('pcucode', $this->pcucode)
            ->count_all_results('sys_serials');

        return $rs > 0 ? TRUE : FALSE;
    }

    public function create_serial($t)
    {
        $rs = $this->db
            ->set('name', $t)
            ->set('pcucode', $this->pcucode)
            ->insert('sys_serials');

        return $rs;
    }

    public function update_serial($t)
    {
        $sql = 'UPDATE sys_serials SET serial_no = serial_no + 1
                WHERE name="'.$t.'" AND pcucode="'.$this->pcucode.'"
        ';
        $rs = $this->db->query($sql);

        return $rs;
    }

}

/* End of file serial_model.php */
/* Location: ./application/models/serial_model.php */