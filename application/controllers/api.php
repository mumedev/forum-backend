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
    
    
}

?>
