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

class Users extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->layout->setLayout('login_layout');

        //load model
        $this->load->model('User_model', 'user');
        $this->load->model('Security_model', 'ss');

    }

    //index action
    public function index()
    {
        $this->login();
    }
    public function login(){
        if($this->session->userdata('status')){
            redirect('/', 'refresh');
        }else{
        $this->layout->view('users/login_view');
        }
    }
    public function user_session(){
        $json=$this->input->get('datajson');
        $data = array(
            'username' => $json['rows']['username'],
            'status' => 'online',
            'user_id' => $json['rows']['id'],
            'off_id' => $json['rows']['office'],
            'user_level' => $json['rows']['user_level'],
            'user_type' => $json['rows']['user_type'],
            'user_name' => $json['rows']['name'],
            'off_name' => $json['rows']['off_name'],
            'hserv' => $this->get_hserv($json['rows']['office']),
            'amp_code' => $this->get_amp_code($json['rows']['office'])
        );
        $this->session->set_userdata($data);
        $json = '{"success": true}';
        render_json($json);
        }
    public function user_profile()
    {
       $data['user']= $this->ss->encode('admin');
       $data['pass']= $this->ss->encode('1234');

        $this->layout->setLayout('default_layout');
        $this->layout->view('users/user_profile_view',$data);
    }
    public function get_hserv ($off_id){
        //echo $off_id;
        $rs=$this->user->get_hserv($off_id);
        return $rs->hserv;
        }
    public function get_amp_code ($off_id){
        //echo $off_id;
        $rs=$this->user->get_amp_code($off_id);
        return $rs->amp_code;
        }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/','refresh');
    }
    public function access_denied(){
        $json = '{"success": false, "msg": "Access denied, please login."}';

        render_json($json);
    }



}