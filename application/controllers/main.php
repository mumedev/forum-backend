<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Main is the controller that is loaded automatically,
 * when launching this Codeigniter application.
 *
 * @author Joris Schelfaut
 */
class Main extends CI_Controller {
    
    /**
     * Default page that is presented when this controller is loaded.
     */
    function index() {
        $data['page'] = 'api';
        $this->load->view('templates/default', $data);
    }
}

?>
