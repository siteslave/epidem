<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Report model
 *
 * @author  Mr.Satit Rianpit <rianpit@yahoo.com>
 * @copyright   MKHO <http://mkho.moph.go.th>
 *
 */

class Reports_model extends CI_Model
{
    public function get_changwat_list()
    {
        $sql = 'select code, name, left(code, 2) as chw
            from ref_catms c
            where substr(code, 3, 6)="000000"
            order by name';

        $rs = $this->db->query($sql)->result();

        return $rs;
    }

}

/* End of file basic_model.php */
/* Location: ./application/models/basic_model.php */