<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Serial model
 *
 * @author  Mr.Satit Rianpit <rianpit@yahoo.com>
 * @copyright   MKHO <http://mkho.moph.go.th>
 *
 */
class Serial_model extends CI_Model {

    public $hospcode;

    /**
    * Get serial current serial number.
    *
    **/
    public function get_serial_e0()
    {
        $rs = $this->db
            ->select('serial_no')
            ->where(array(
                'name' => 'E0',
                'hospcode' => $this->hospcode
            ))
            ->get('sys_serials')
            ->row();

        return $rs->serial_no ? $rs->serial_no : 0;
    }

    public function serial_exist_e0()
    {
        $rs = $this->db
            ->where(array(
                'name' => 'E0',
                'hospcode' => $this->hospcode
            ))
            ->count_all_results('sys_serials');

        return $rs > 0 ? TRUE : FALSE;
    }

    public function create_serial_e0()
    {
        $rs = $this->db
            ->set('name', 'E0')
            ->set('hospcode', $this->hospcode)
            ->set('serial_no', 1)
            ->insert('sys_serials');

        return $rs;
    }

    public function update_serial_e0()
    {
        $sql = 'UPDATE sys_serials SET serial_no = serial_no + 1
                WHERE name="E0" AND hospcode="'.$this->hospcode.'"
        ';
        $rs = $this->db->query($sql);

        return $rs;
    }

    public function get_serial_e1($code506)
    {
        $rs = $this->db
            ->select('serial_no')
            ->where(array(
                'name' => 'E1',
                'code506' => $code506,
                'hospcode' => $this->hospcode
            ))
            ->get('sys_serials')
            ->row();

        return $rs->serial_no ? $rs->serial_no : 0;
    }

    public function serial_exist_e1($code506)
    {
        $rs = $this->db
            ->where(array(
                'name' => 'E1',
                'code506' => $code506,
                'hospcode' => $this->hospcode
            ))
            ->count_all_results('sys_serials');

        return $rs > 0 ? TRUE : FALSE;
    }

    public function create_serial_e1($code506)
    {
        $rs = $this->db
            ->set('name', 'E1')
            ->set('code506', $code506)
            ->set('hospcode', $this->hospcode)
            ->set('serial_no', 1)
            ->insert('sys_serials');

        return $rs;
    }

    public function update_serial_e1($code506)
    {
        $sql = 'UPDATE sys_serials SET serial_no = serial_no + 1
                WHERE name="E1" AND code506="'.$code506.'" AND hospcode="'.$this->hospcode.'"
        ';
        $rs = $this->db->query($sql);

        return $rs;
    }
}

/* End of file serial_model.php */
/* Location: ./application/models/serial_model.php */