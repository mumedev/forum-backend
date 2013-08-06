<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * <p>
 * The Test_controller uses the model classes to load data from the database.
 * This data is subsequently shown in the view, loaded from the controller.
 * </p>
 *
 * @author Joris Schelfaut
 */
class Test_controller extends CI_Controller {
    
    /**
     * <p>
     * Default method that is called when loading this controller.
     * Loads the test view with data from the Test_model class.
     * </p>
     */
    function index() {
        // Load the model class.
        $this->load->model('test_model');
        // Store the records obtained from the model table in a variable.
        // This is the name of the variable that will be accessible in the view.
        if (! $data['rows'] = $this->test_model->get_all()) {
            $data['rows'] = array();
        }
        // Load the view with the variables.
        $this->load->view('test/crud_view', $data);
    }
    
    /**
     * <p>
     * Sends an e-mail to the mumedev gmail account with default text. For
     * more info see:
     * http://net.tutsplus.com/tutorials/php/codeigniter-from-scratch-day-3/
     * and:
     * http://net.tutsplus.com/tutorials/php/codeigniter-from-scratch-day-4-newsletter-signup/
     * </p>
     */
    function _send_email() {
        /*
         * These settings are stored in the config/email.php file and are now
         * automatically loaded.
         */
        /*
        $config = array(
            'protocol'      => 'SMTP',
            'smtp_host'     => 'ssl://smtp.googlemail.com/',
            'smtp_port'     => 465,
            'smtp_user'     => '',
            'smtp_pass'     => ''
        );
        $this->load->library('email', $config);
        */
        $this->load->library('email');
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
        if (! $this->form_validation->run()) {
            $this->load->view('test/email_view');
        } else {
            // Validation has passed. Continue...
            $name   = $this->input->post('name');
            $email  = $this->input->post('email');
            
            $this->email->set_newline('\r\n');
            $this->email->from('noreply@test.com', 'TEST');
            $this->email->to('mumedev@gmail.com');
            $this->email->subject('Testing e-mail in CodeIgniter.');
            $this->email->message('Congratulations, the e-mail was successfully sent.');

            if ($this->email->send()) {
                echo 'SUCCESSFULLY SENT E-MAIL.';
            } else {
                show_error($this->email->print_debugger());
            }
        }
    }
    
    
    
    function create_test() {
        $this->load->model('test_model');
        $data = array(
            'name' => $this->input->post('name')
        );
        $this->test_model->create($data);
    }
    
    function update_test($data) {
        
    }
    
    function delete_test() {
        
    }
}

?>
