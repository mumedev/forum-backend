<?php

/**
 * Description of login_controller
 * 
 * Based on a tutorial by Jeffrey Way. Source:
 * http://net.tutsplus.com/tutorials/php/codeigniter-from-scratch-day-6-login/
 *
 * @author Joris Schelfaut
 */
class Login_controller extends CI_Controller {
    
    /**
     * The default page when loading the controller.
     */
    function index() {
        // This key will be accessible through a variable in the view, i.e.
        // $main_content
        $data['main_content'] = 'login_form';
        $this->load->view('includes/template', $data);
    }
    
    /**
     * Validates the login credentials and creates a session for the user
     * if they are valid.
     */
    function validate_credentials() {
        $this->load->model('user_model');
        $query = $this->user_model->validate_credentials();
        if ($query) {
            $data = array(
                'username' => $this->input->post('username'),
                'valid_login' => true
            );
            
            $this->load->library('session');
            $this->session->set_userdata($data);
            redirect('forum_controller/member/');
        } else {
            $this->index();
        }
        
    }
    
    /**
     * Loads the signup form.
     */
    function signup() {
        $data['main_content'] = 'signup_form';
        $this->load->view('includes/template', $data);
    }
    
    /**
     * Receives input from the signup form. If the form entries are valid,
     * the new user is added to the database. The user will be redirected
     * to the relevant feedback page.
     */
    function create_member() {
        $this->load->library('form_validation');
        //set_rules('username', 'error msg', 'validation_rules');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
        if (! $this->form_validation->run()) {
            //$this->load->view('signup_form');
            $this->signup();
        } else {
            $this->load->model('user_model');
            
            $user_data = array(
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password'))
            );
            
            if ($this->user_model->insert($user_data)) {
                $data['main_content'] = 'signup_success';
                $this->load->view('includes/template', $data);
            } else {
                $this->signup();
            }
        }
    }
    
    /**
     * Log the user out by destroying the session. Redirect him/her to the
     * login page.
     */
    function logout() {  
        $this->session->sess_destroy();
        $this->index();
    }
}

?>
