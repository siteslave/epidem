<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Controller
 *
 * Controller information information
 *
 * @package     Controller
 * @author      Satit Rianpit <rianpit@gmail.com>
 * @since       Version 1.0.0
 * @copyright   Copyright 2013 Data center of Maha Sarakham Hospital
 * @license     http://his.mhkdc.com/licenses
 */

class Curl_user extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->layout->setLayout('login_layout');

        //load model
        $this->load->model('User_model', 'user');

    }

    //index action
    public function index()
    {

    }
}
?>