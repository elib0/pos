<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Loader extends CI_Loader{

    public function layout($template_name, $vars = array(), $jsLibraries = array())
    {    
        //_imprimir($vars);
        
        //Settings
        $ci = get_instance();
        $vars['config'] = $ci->config->item('websarrollo');
        
        //language
        $ci->session->set_userdata('ws-language', get_language());
        $ci->lang->load('general', $ci->session->userdata('ws-language'));
        $vars['language'] = $ci->lang; 

        //Models
        $ci->load->model('ModelContents');
        $ci->load->model('Company');

        //Data
        $vars['firstMenuSideBar'] = $ci->ModelContents->getRows(" WHERE id_type = '1' ");
        $vars['secondMenuSideBar'] = $ci->ModelContents->getRows(" WHERE id_type = '2' AND id_status='1'");

        if (isset($vars['wp_user']) && count($vars['wp_user']) > 1) {
            $vars['wpanelMenu'] = $ci->ModelContents->getRows(" WHERE id_type = '5' AND id NOT IN ('14',15) ");
        }

        $vars['companyInfo'] = $ci->Company->getRow();

        //Body
        $content  = $this->view('partial/header', $vars);
        $content .= $this->view($template_name, $vars);
        $content .= $this->view('partial/sideBar', $vars);

        if (count($jsLibraries)>0)
            $vars['jsLibraries'] = $jsLibraries;

        $content .= $this->view('partial/footer', $vars);
    }
}
?>