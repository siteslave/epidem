<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Basic model
 *
 * @author  Mr.Satit Rianpit <rianpit@yahoo.com>
 * @copyright   MKHO <http://mkho.moph.go.th>
 *
 */

class Security_model extends CI_Model
{
    public function encode($txt){
        $en=base64_encode(md5(md5($txt).'84c9aef34f7bc237'));
        return $en;
    }
}
