<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

	/**
     * Index controller
	 */
	public function index()
	{
		$this->layout->view('pages/index_view');
	}

    public function about()
    {
        $this->layout->view('pages/about_view');
    }
}

/* End of file pages.php */
/* Location: ./application/controllers/pages.php */