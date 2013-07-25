<?php

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
        $data['rows'] = $this->test_model->get_all();
        // Load the view with the variables.
        $this->load->view('test', $data);
    }
    
}

?>
