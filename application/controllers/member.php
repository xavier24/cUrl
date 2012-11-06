<?php

class member extends CI_Controller {
    
    public function index(){
        $this->load->helper('form');
        $data['main_title'] = 'CURL - connexion';
        $data['vue'] = $this->load->view('member',$data,TRUE);
        $this->load->view('layout',$data);
    }
    
    public function login(){
        $this->load->model('M_Member');
        $data['mdp'] = $this->input->post('mdp');
        $data['email'] = $this->input->post('email');
        
        if($this->M_Member->verifier($data)){
            
            $info_membre = $this->M_Member->getIdMembre($data['email']);
            //$nom_membre = $this->M_Member->getNameMembre($data);
            $this->session->set_userdata('logged_in',$info_membre);
            redirect('article');
        }
        else{
            $connexion = "Identifiant ou mot de passe incorrect";
            redirect('member');
        }
        
    }
    
    public function deconnecter(){
        $this->session->unset_userdata('logged_in');
        redirect('member');
    }
}