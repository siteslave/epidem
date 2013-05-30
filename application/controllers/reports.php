<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: spiderman
 * Date: 30/5/2556
 * Time: 13:52 น.
 * To change this template use File | Settings | File Templates.
 */
class Reports extends CI_Controller {

    public function index()
    {
        $this->layout->view('reports/index_view');
    }

}
