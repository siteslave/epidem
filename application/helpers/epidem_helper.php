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
 * Generate serial
 *
 * @param   string  $t Type of serial
 * @return  string
 */
if ( ! function_exists('generate_serial'))
{
    function generate_serial($t, $pcucode)
    {
        $ci =& get_instance();
        $ci->load->model('Serial_model', 'serial');

        $ci->serial->pcucode = $pcucode;

        //check serial exist
        $serial_exist = $ci->serial->serial_exist($t);

        if(!$serial_exist)
        {
            //create serial
            $ci->serial->create_serial($t);
        }

        //get current serial
        $current_number = $ci->serial->get_serial($t);
        $serial_number = $current_number;

        //update serial
        $ci->serial->update_serial($t);

        return $serial_number;
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
