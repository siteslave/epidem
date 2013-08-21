<?php
if ( ! function_exists('render_json'))
{
    function render_json($json)
    {
        ini_set('display_errors', 0);
        //header('Content-Type: application/json');
        echo $json;
    }

}
/**
* Get current date
*
* @return   string  
**/
if ( ! function_exists('get_current_thai_date'))
{
    function get_current_thai_date()
    {
        $d = explode('/', date('d/m/Y'));
        $day = $d[0];
        $month = $d[1];
        $year = (int) $d[2] + 543;

        $current_thai_date = $day . '/' . $month . '/' . $year;

        return $current_thai_date;

    }

}

/**
 * Generate serial
 *
 * @param   string  $t Type of serial
 * @return  string
 */
if ( ! function_exists('generate_e0'))
{
    function generate_e0($hospcode='')
    {
        $ci =& get_instance();
        $ci->load->model('Serial_model', 'serial');

        $ci->serial->hospcode = $hospcode;

        //check serial exist
        $serial_exist = $ci->serial->serial_exist_e0();

        if(!$serial_exist)
        {
            //create serial
            $ci->serial->create_serial_e0();
        }

        //get current serial
        $current_number = $ci->serial->get_serial_e0();

        //update serial
        $ci->serial->update_serial_e0();

        return $current_number;
    }
}

if ( ! function_exists('generate_e1'))
{
    function generate_e1($hospcode='', $code506='')
    {
        $ci =& get_instance();
        $ci->load->model('Serial_model', 'serial');

        $ci->serial->hospcode = $hospcode;

        //check serial exist
        $serial_exist = $ci->serial->serial_exist_e1($code506);

        if(!$serial_exist)
        {
            //create serial
            $ci->serial->create_serial_e1($code506);
        }

        //get current serial
        $current_number = $ci->serial->get_serial_e1($code506);

        //update serial
        $ci->serial->update_serial_e1($code506);

        return $current_number;
    }
}

if(!function_exists('to_thai_date'))
{
    function to_thai_date($eng_date)
    {
        if(strlen($eng_date) != 10)
        {
            return null;
        }
        else
        {
            $new_date = explode('-', $eng_date);

            $new_y = (int) $new_date[0] + 543;
            $new_m = $new_date[1];
            $new_d = $new_date[2];

            $thai_date = $new_d . '/' . $new_m . '/' . $new_y;

            return $thai_date;
        }
    }
}

if(!function_exists('to_mysql_date'))
{
    function to_mysql_date($thai_date)
    {
        if(strlen($thai_date) != 10)
        {
            return null;
        }
        else
        {
            $new_date = explode('/', $thai_date);

            $new_y = (int)$new_date[2] - 543;
            $new_m = $new_date[1];
            $new_d = $new_date[0];

            $mysql_date = $new_y . '-' . $new_m . '-' . $new_d;

            return $mysql_date;
        }
    }
}

if(! function_exists('count_age'))
{
    function count_age($date)
    {
        $c_y = (int) date('Y');
        $o_y = explode('-', $date);
        $n_y = (int) $o_y[0];

        $age = $c_y - $n_y;

        return $age;
    }
}

if(!function_exists('to_string_date'))
{
    function to_string_date($date)
    {
        if(empty($date))
        {
            return null;
        }
        else
        {
            $d = explode('/', $date);
            // $d[0] = d, $d[1] = m, $d[2] = y
            $new_date = (int)$d[2] - 543 . $d[1] . $d[0];
            return $new_date;
        }
    }
}

if(!function_exists('get_ptstatus_name'))
{
    function get_ptstatus_name($id)
    {
        if(!empty($id))
        {
            if($id == '1') return 'หาย';
            else if($id == '2') return 'ตาย';
            else if($id == '3') return 'ยังรักษาอยู่';
            else if($id == '9') return 'ไม่ทราบ';
            else return 'ไม่ระบุ';
        }
        else
        {
            return '-';
        }
    }
}

if(!function_exists('get_address'))
{
    /**
     * @param $addr_code    Address code in ccaattmm
     *
     * @return string
     */
    function get_address($addr_code)
    {
        $ci =& get_instance();
        $ci->load->model('Basic_model', 'basic');

        $chw = substr($addr_code, 0, 2);
        $amp = substr($addr_code, 2, 2);
        $tmb = substr($addr_code, 4, 2);
        $moo = substr($addr_code, 6, 2);

        $chw_name = $ci->basic->get_province_name($chw);
        $amp_name = $ci->basic->get_ampur_name($chw, $amp);
        $tmb_name = $ci->basic->get_tmb_name($chw, $amp, $tmb);
        $moo_name = $ci->basic->get_moo_name($chw, $amp, $tmb, $moo);

        $address = 'หมู่ ' . $moo . ' '. $moo_name . ' ต.' . $tmb_name . ' อ.' . $amp_name . ' จ.' . $chw_name;

        return $address;
    }
}

if(!function_exists('get_diag_name'))
{
    function get_diag_name($code)
    {
        $ci =& get_instance();
        $rs = $ci->db
            ->where(array('code' => $code))
            ->get('ref_icd10')
            ->row();
        return $rs ? $rs->name : '-';
    }

}

if(!function_exists('get_hospital_name'))
{
    function get_hospital_name($code)
    {
        $ci =& get_instance();
        $rs = $ci->db
            ->where(array('hospcode' => $code))
            ->get('ref_hospital')
            ->row();
        return $rs ? $rs->name : '-';
    }

}
/**
* Get current age
*
* @param    date    yyyy-mm-dd
* @return   array
**/
if(!function_exists('get_current_age')) 
{
    function get_current_age($birth)
    {
        $birth = explode('-', $birth);
        $year = (int) $birth[0];
        $month = (int) $birth[1];
        $day = (int) $birth[2];

        $cyear = (int) date('Y');
        $cmonth = (int) date('m');
        $cday = (int) date('d');
        
        $age = array();

        if($cday < $day)
        {
            $cday = $cday + 30;
            $cmonth--;
            $age['day'] = $cday - $day;
        }
        else 
        {
            $age['day'] = $cday - $day;
        }
        
        if($cmonth < $month)
        {
            $cmonth = $cmonth + 12;
            $cyear--;
            $age['month'] = $cmonth - $month;
        }
        else 
        {
            $age['month'] = $cmonth - $month;
        }

        $age['year'] = $cyear - $year;


        return $age;
    } 
}

/* End of file epidem_helper.php */
/* Location: ./application/helpers/epidem_helper.php */