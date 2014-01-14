<?php
class ChangeDb extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function index(){
        $_SESSION['dblocation'] = $this->input->post('locationbd'); //Para la db locations
        redirect('login');
    }
} ?>
