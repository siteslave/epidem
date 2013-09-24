<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Exports model
 *
 * @author  Mr.Satit Rianpit <rianpit@yahoo.com>
 * @copyright   MKHO <http://mkho.moph.go.th>
 *
 */

class Exports_model extends CI_Model {

    public $hserv;
    public $hospcode;

    public function get_list($s, $e, $start, $limit)
    {
        $result = $this->db
            ->where(array(
                'hospcode' => $this->hospcode,
                'datesick >=' => $s,
                'datesick <=' => $e
            ))
            ->limit($limit, $start)
            ->get('epe0')
            ->result();
        return $result;
    }

    public function get_total($s, $e){
        $rs = $this->db
            ->where(array(
                'hospcode' => $this->hospcode,
                'datesick >=' => $s,
                'datesick <=' => $e
            ))
            ->count_all_results('epe0');
        return $rs;
    }

}