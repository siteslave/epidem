<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: spiderman
 * Date: 30/5/2556
 * Time: 13:52 น.
 * To change this template use File | Settings | File Templates.
 */
class Reports extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        $this->layout->setLayout('reports_layout');

        //load model
        $this->load->model('Reports_model', 'report');
        $this->load->model('Basic_model', 'besic');

    }
    public function index()
    {
        $this->layout->view('reports/index_view');
    }
    public function e0()
    {
        $this->layout->view('reports/e0_view');
    }
    public function e1()
    {
        $this->layout->view('reports/e1_view');
    }
}
