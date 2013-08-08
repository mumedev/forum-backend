<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
require(APPPATH . '/libraries/REST_Controller.php');

/**
 * The public REST API controller class.
 * 
 * Supported actions for each resource :
 * 
 * <ul>
 *  <li>
 *      GET : Used to fetch information about an existing resource. 
 *      This is used by browsers when you enter a URL and hit go, 
 *      or when you click on a link, so it perfect for fetching information
 *      on one of your REST resources (like user).
 *      <br />
 *      A GET method signature consists out of the API method followed by
 *      "_get".
 *  </li>
 *  <li>
 *      POST : Used to update an existing resource with information. 
 *      Browsers use this to submit most types of forms on the internet,
 *      although some use GET as well by submitting the form action with a
 *      query string containing the field data.
 *      <br />
 *      A POST method signature consists out of the API method followed by
 *      "_post".
 *      
 *  </li>
 * </ul>
 *
 * @author  Joris Schelfaut
 * @info    based on a tutorial by Philip Sturgeon
 */
class Api extends REST_Controller {
    
    /**
     * Default page loaded when the controller is loaded.
     */
    function index() {
        $data['page'] = 'api';
        $this->load->view('templates/default', $data);
    }
    
    ////////////////////////////////////////////////////////////////////////////
    //
    //  user methods
    //
    ////////////////////////////////////////////////////////////////////////////
    
    /**
     * Returns information on the user profile.
     * parameters:
     *      id          INT         the id of the user
     *      username    STRING      the username of the user
     * At least one of both is required.
     */
    function user_getinfo_get() {
        $this->load->model('user_model');
        $id = $this->get('id');
        $username = $this->get('username');
        if (!$id && !$username) {
            $this->response(NULL, 400);
        }
        $user = $this->user_model->select($id, $username);
        if ($user) {
            $this->response($user, 200);
        } else {
            $this->response(NULL, 404);
        }
    }
    
    /**
     * Requires authentication.
     */
    function user_updateinfo_post() {
        $data = array();
        $id = $this->post('id');
        
        if (! $this->_validate_session($this->post('id'), NULL, $this->post('session'))) {
            $this->response(array('status' => 'failed'));
            return;
        }
        
        if ($this->post('name')) $data['name'] = $this->post('name');
        if ($this->post('password')) $data['password'] = $this->post('password');
        
        $this->load->model('user_model');
        $result = $this->user_model->update($id, $data);

        if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        } else {
            $this->response(array('status' => 'success'));
        }
    }
    
    function user_getquestions_get() {
        $this->load->model('user_model');
        $id = $this->get('id');
        $username = $this->get('username');
        if (!$id && !$username) {
            $this->response(NULL, 400);
        }
        $user = $this->user_model->select($id, $username);
        if ($user) {
            $this->response($user, 200);
        } else {
            $this->response(NULL, 404);
        }
    }
    
    function user_register_post() {
        
    }
    
    function user_delete_post() {
        if (! $this->_validate_session($this->post('id'), NULL, $this->post('session'))) {
            $this->response(array('status' => 'failed'));
            return;
        }
    }
    
    function user_search_get() {}
    
    function user_getskills_get() {}
    
    function user_getanswers_get() {}
    
    
    ////////////////////////////////////////////////////////////////////////////
    //
    //  skill methods
    //
    ////////////////////////////////////////////////////////////////////////////
    
    function skill_search_get() {}
    
    function skill_create_post() {
        if (! $this->_validate_session($this->post('id'), NULL, $this->post('session'))) {
            $this->response(array('status' => 'failed'));
            return;
        }
    }
    
    function skill_getquestions_get() {}
    
    
    ////////////////////////////////////////////////////////////////////////////
    //
    //  question methods
    //
    ////////////////////////////////////////////////////////////////////////////
    
    function question_search_get() {}
    
    function question_getanswers_get() {}
    
    function question_getskills_get() {}
    
    function question_create_post() {
        if (! $this->_validate_session($this->post('id'), NULL, $this->post('session'))) {
            $this->response(array('status' => 'failed'));
            return;
        }
    }
    
    function question_getinfo_get() {}
    
    function question_delete_post() {
        if (! $this->_validate_session($this->post('id'), NULL, $this->post('session'))) {
            $this->response(array('status' => 'failed'));
            return;
        }
    }
    
    
    ////////////////////////////////////////////////////////////////////////////
    //
    //  answer methods
    //
    ////////////////////////////////////////////////////////////////////////////
    
    function answer_search_get() {
        
        $this->load->model('answer_model');
        //$this->answer_model->();
        
    }
    
    function answer_getquestion_get() {
        $id = $this->post('id');
        $this->load->model('answer_model');
        $question = $this->answer_model->getquestion($id);
        if ($question) {
            $this->response($question, 200);
        } else {
            $this->response(NULL, 404);
        }
    }
    
    function answer_create_post() {
        if (! $this->_validate_session($this->post('id'), NULL, $this->post('session'))) {
            $this->response(array('status' => 'failed'));
            return;
        }
    }
    
    ////////////////////////////////////////////////////////////////////////////
    //
    //  authentication methods
    //
    ////////////////////////////////////////////////////////////////////////////
    
    /**
     * Start a new session for the given user.
     */
    function authentication_startsession_get() {
        $this->load->model('user_model');
        $key = $this->user_model->create_session($this->get('id'), $this->get('username'), $this->get('password'));
        if ($key) {
            $this->response($key, 200);
        } else {
            $this->response(NULL, 404);
        }
    }
    
    /**
     * End the session for the given user.
     */
    function authentication_endsession_get() {
        $this->load->model('user_model');
        $this->user_model->delete_session($this->get('id'), $this->get('username'), $this->get('session'));
    }
    
    /**
     * Verifies if the given $session_id corresponds to the stored session
     * id for the user.
     * @param   String $session_id
     * @return  boolean
     */
    function _validate_session($id, $username, $session_id) {
        $this->load->model('user_model');
        return $this->user_model->validate_session($session_id, id);
    }
    
}

?>
