<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of forum_controller
 *
 * @author JORIS
 */
class Forum_controller extends CI_Controller {
    
    /**
     * Default page that is presented when this controller is loaded.
     */
    function index() {
        $this->load->view('home');
    }
    
    /**
     * Area only accessible after login.
     */
    function member() {
        $this->_is_logged_in();
        $this->load->view('home');
    }
    
    function _is_logged_in() {
        $this->load->library('session');
        $logged_in = $this->session->user_data('is_logged_in');
        
        if (!isset($logged_in) || $logged_in != true) {
            // show error
            return false;
        } else {
            return true;
        }
    }
    
}

?>
