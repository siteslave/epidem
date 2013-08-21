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
        $this->load->model('User_model', 'users');
    }

    //index action
    public function index()
    {
        $this->login();
    }
    public function login(){
        if($this->session->userdata('username'))
        {
            redirect(site_url(), 'refresh');
        }
        else
        {
            $this->layout->view('users/login_view');
        }
    }

    public function do_login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $users = $this->users->do_auth($username, $password);
        if($users)
        {
            $data = array(
                'username'      => $users->username,
                'user_id'       => $users->id,
                'hospcode'      => $users->hospcode,
                'hospname'      => $users->hospname,
                'user_level'    => $users->user_level,
                'user_type'     => $users->user_type,
                'fullname'      => $users->name,
                'hserv'         => $this->get_hserv($users->hospcode),
                'amp_code'      => $this->get_amp_code($users->hospcode)
            );

            $this->session->set_userdata($data);

            if($users->user_level == 1)
                redirect(site_url('admin'));
            else if($users->user_level == 2)
                redirect(site_url('ampur'));
            else redirect(site_url());
        }
        else
        {
            $data = array('error' => 1);
            $this->layout->view('users/login_view', $data);
        }
    }

    /*public function user_session(){
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
        }*/
    public function user_profile()
    {
        #$this->layout->setLayout('default_layout');
        #$this->layout->view('users/user_profile_view',$data);
    }
    public function get_hserv ($hospcode){
        //echo $off_id;
        $rs=$this->users->get_hserv($hospcode);
        return $rs->hserv;
        }
    public function get_amp_code ($hospcode){
        //echo $off_id;
        $rs=$this->users->get_amp_code($hospcode);
        return $rs->amp_code;
        }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect(site_url(),'refresh');
    }
    public function access_denied(){
        $json = '{"success": false, "msg": "Access denied, please login."}';

        render_json($json);
    }



}