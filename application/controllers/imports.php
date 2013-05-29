<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Imports controller
 *
 * Import file (epimain.dbf) to server
 *
 * @author  Mr.Satit Rianpit <rianpit@yahoo.com>
 * @copyright   MKHO <http://mkho.moph.go.th>
 *
 */
class Imports extends CI_Controller {

	/**
     * Index controller
	 */
	public function index()
	{
		$this->layout->view('imports/index_view');
	}

    /**
     * Upload view
     */
    public function upload()
    {
        $this->layout->view('imports/upload_view');
    }
    /**
     * Do upload file
     */
    public function do_upload()
    {

    }
}

/* End of file imports.php */
/* Location: ./application/controllers/imports.php */