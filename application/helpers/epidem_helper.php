<?php
if ( ! function_exists('render_json'))
{
    function render_json($json)
    {
        ini_set('display_errors', 0);
        header('Content-Type: application/json');
        echo $json;
    }

}
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
 * Get user agent
 *
 * @return string User agent
 **/
if ( ! function_exists( 'get_user_agent' ) )
{
    function get_user_agent()
    {
        $ci =& get_instance();
        if ( $ci->agent->is_browser() )
        {
            $agent = $ci->agent->browser() . ' ' . $ci->agent->version() . ' ' . $ci->agent->platform();
        }
        elseif( $ci->agent->is_robot() )
        {
            $agent = $ci->agent->robot();
        }
        elseif( $ci->agent->is_mobile() )
        {
            $agent = $this->agent->mobile();
        }
        else
        {
            $agent = 'Unknow agent';
        }

        return $agent;
    }
}

/**
 * Create logging
 *
 * @param string $log_level Log level 'info', 'warning', 'error'
 * @param string $log_message
 * @param string $log_ip User ip address
 * @param string $log_agent User agent
 **/
if ( ! function_exists( 'logging' ) )
{
    function logging( $logs )
    {
        $ci =& get_instance();

        date_default_timezone_set('Asia/Bangkok');

        $logs['log_date'] = date("Y-m-d");
        $logs['log_time'] = date("H:i:s");
        $logs['log_user'] = $ci->session->userdata('user_name');

        $ci->db->insert( 'logs', $logs );
    }
}
/**
 * Generate serial
 *
 * @param   string  $sr_type Type of serial
 * @param   boolean $gen_date Add 2 digits of year to serial
 * @return  string
 */
if ( ! function_exists('generate_serial'))
{
    function generate_serial($sr_type)
    {
        $ci =& get_instance();
        $ci->load->model('Serial_model', 'serial');
        //Generate serial with year and month digit.

        $prefix = $ci->serial->get_prefix($sr_type);
        $gen_date = $ci->serial->get_gen_date($sr_type);

        //generate with year and month
        if($gen_date){
            //formatted serial
            $sr_m = $ci->serial->get_month_prefix($sr_type);
            $sr_y = $ci->serial->get_year_prefix($sr_type);

            //for month prefix
            if($sr_m != date('m')){
                //update month
                $ci->serial->update_month($sr_type, date('m'));
                //set to current month
                $sr_m = date('m');
                $ci->serial->reset_serial($sr_type);
            }

            //for year prefix
            $current_year = date('Y') + 543;
            $short_year = substr($current_year, -2) ;

            if($sr_y != $short_year){
                //update year
                $ci->serial->update_year($sr_type, $short_year);
				$ci->serial->reset_serial($sr_type);
            }

            $new_sr = $prefix.'-'.$short_year.$sr_m;

        }else{//generate without year and month
            $new_sr = $prefix;
        }

        $sn = $ci->serial->get_serial($sr_type);
        $sn = get_string_length($sn);

        $a = $new_sr. '-' .$sn;

        //Update serials
        $ci->serial->update_serial($sr_type);

        return $a;
    }
}
//private function for serial
function get_string_length($sn){

    switch(strlen($sn)){
        case 1:
            $new_sn = '00000'.$sn;
            break;
        case 2:
            $new_sn = '0000'.$sn;
            break;
        case 3:
            $new_sn = '000'.$sn;
            break;
        case 4:
            $new_sn = '00'.$sn;
            break;
        case 5:
            $new_sn = '0'.$sn;
            break;
        case 6:
            $new_sn = $sn;
            break;
        default:
            $new_sn = '000001';
    }
    return $new_sn;
}

if( !function_exists('gen_unique')){
    function gen_unique(){
        $id = uniqid(hash("sha512",rand()), TRUE);
        $code = hash("sha512", $id);
        return substr($code, 0, 32);
    }
}

if(!function_exists('to_thai_date')){
    function to_thai_date($eng_date){
        if(strlen($eng_date) != 10){
            return null;
        }else{
            $new_date = explode('-', $eng_date);

            $new_y = (int) $new_date[0] + 543;
            $new_m = $new_date[1];
            $new_d = $new_date[2];

            $thai_date = $new_d . '/' . $new_m . '/' . $new_y;

            return $thai_date;
        }
    }
}

if(!function_exists('to_mysql_date')){
    function to_mysql_date($thai_date){
        if(strlen($thai_date) != 10){
            return null;
        }else{
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
        $o_y = (int) explode('-', $date);
        $n_y = (int) $o_y[0];

        return $c_y - $n_y;
    }
}
