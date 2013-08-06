<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require(APPPATH . '/libraries/REST_Controller.php');

/**
 * The public REST API controller class.
 *
 * @author Joris Schelfaut
 */
class Api extends REST_Controller {
    
    /**
     * Implements the HTTP GET method for the users resource.
     */
    function users_get() {
        
        $this->load->model('user_model');
        $users = $this->user_model->get_all();

        if ($users) {
            $this->response($users, 200);
        } else {
            $this->response(NULL, 404);
        }
    }
    
    function questions_get() {
        
        $this->load->model('question_model');
        $users = $this->user_model->get_all();

        if ($users) {
            $this->response($users, 200);
        } else {
            $this->response(NULL, 404);
        }
    }
    
}

?>
