<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
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
 *  </li>
 *  <li>
 *      POST : Used to update an existing resource with information. 
 *      Browsers use this to submit most types of forms on the internet,
 *      although some use GET as well by submitting the form action with a
 *      query string containing the field data.
 *  </li>
 * </ul>
 *
 * @author  Joris Schelfaut
 * @info    based on a tutorial by Philip Sturgeon
 * @url     http://net.tutsplus.com/tutorials/php/working-with-restful-services-in-codeigniter-2/
 */
class Api extends REST_Controller {
    
    ////////////////////////////////////////////////////////////////////////////
    //
    //  user methods
    //
    ////////////////////////////////////////////////////////////////////////////

    /**
     * Implements the HTTP GET method for the users resource.
     */
    function users_get() {

        $this->load->model('user_model');
        $users = $this->user_model->select_all();

        if ($users) {
            /*
             * $this->response() sends data to the browser in whichever data format
             * has been requested, or defaults to XML. You can optionally pass a 
             * HTTP status code to show it has worked or failed. E.g if the ID 
             * provided was not in the database, you could use:
             *      
             *      $this->response(array(‘error’ => ‘User not found.’), 404);
             * 
             */
            $this->response($users, 200);
        } else {
            //echo 'nobody found';
            $this->response(NULL, 404);
        }
    }

    /**
     * Respond with information about a user
     */
    function user_get() {
        $this->load->model('user_model');
        /*
         * $this->get() is used to return GET variables from either
         * a query string like this:
         * 
         *      index.php/example_api/user?id=1
         * 
         * or can be set in the more CodeIgniter'esque way with:
         *      
         *      index.php/example_api/user/id/1
         * 
         */
        if (!$this->get('id')) {
            $this->response(NULL, 400);
        }
        $user = $this->user_model->get($this->get('id'));
        if ($user) {
            $this->response($user, 200);
        } else {
            $this->response(NULL, 404);
        }
    }
    
    /**
     * Update an existing user and respond with a status/errors.
     */
    function user_post() {
        $this->load->model('user_model');
        $result = $this->user_model->update($this->post('id'), array(
            'name' => $this->post('name'),
            'password' => $this->post('password')
        ));

        if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        } else {
            $this->response(array('status' => 'success'));
        }
    }

    ////////////////////////////////////////////////////////////////////////////
    //
    //  question methods
    //
    ////////////////////////////////////////////////////////////////////////////
    
    /**
     * Respond with information about questions.
     */
    function questions_get() {
        $this->load->model('question_model');
        $questions= $this->question_model->select_all();

        if ($questions) {
            $this->response($questions, 200);
        } else {
            $this->response(NULL, 404);
        }
    }
    
    /**
     * Respond with information about a question.
     */
    function question_get() {
        $this->load->model('question_model');
        if (!$this->get('id')) {
            $this->response(NULL, 400);
        }
        $question = $this->question_model->get($this->get('id'));
        if ($question) {
            $this->response($question, 200);
        } else {
            $this->response(NULL, 404);
        }
    }
    
    /**
     * Update an existing question and respond with a status/errors.
     */
    function question_post() {
        $this->load->model('question_model');
        $result = $this->question_model->update($this->post('id'), array(
            'text' => $this->post('text')
        ));

        if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        } else {
            $this->response(array('status' => 'success'));
        }
    }

    ////////////////////////////////////////////////////////////////////////////
    //
    //  answer methods
    //
    ////////////////////////////////////////////////////////////////////////////
    
    /**
     * Respond with information about answers.
     */
    function answers_get() {
        $this->load->model('answer_model');
        $answers = $this->answer_model->select_all();

        if ($answers) {
            $this->response($answers, 200);
        } else {
            $this->response(NULL, 404);
        }
    }
    
    /**
     * Respond with information about an answer.
     */
    function answer_get() {
        $this->load->model('answer_model');
        if (!$this->get('id')) {
            $this->response(NULL, 400);
        }
        $answer = $this->answer_model->get($this->get('id'));
        if ($answer) {
            $this->response($answer, 200);
        } else {
            $this->response(NULL, 404);
        }
    }
    
    /**
     * Update an existing answer and respond with a status/errors.
     */
    function answer_post() {
        $this->load->model('answer_model');
        $result = $this->answer_model->update($this->post('id'), array(
            'name' => $this->post('name'),
            'password' => $this->post('password')
        ));

        if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        } else {
            $this->response(array('status' => 'success'));
        }
    }

    ////////////////////////////////////////////////////////////////////////////
    //
    //  skill methods
    //
    ////////////////////////////////////////////////////////////////////////////

    /**
     * Respond with information about skills.
     */
    function skills_get() {
        $this->load->model('skill_model');
        $skills = $this->skill_model->select_all();

        if ($skills) {
            $this->response($skills, 200);
        } else {
            $this->response(NULL, 404);
        }
    }
    
    /**
     * Respond with information about a skill.
     */
    function skill_get() {
        $this->load->model('skill_model');
        if (!$this->get('id')) {
            $this->response(NULL, 400);
        }
        $skill = $this->skill_model->get($this->get('id'));
        if ($skill) {
            $this->response($skill, 200);
        } else {
            $this->response(NULL, 404);
        }
    }
    
    /**
     * Update an existing skill and respond with a status/errors.
     */
    function skill_post() {
        $this->load->model('skill_model');
        $result = $this->skill_model->update($this->post('id'), array(
            'name' => $this->post('name')
        ));

        if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        } else {
            $this->response(array('status' => 'success'));
        }
    }

}

?>
