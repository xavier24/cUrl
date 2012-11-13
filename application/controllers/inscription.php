<?php

class inscription extends CI_Controller {
    
    public function index(){
        $this->load->helper('form');
        $data['message'] = $this->session->flashdata('item');
        $data['main_title'] = 'CURL - connexion';
        $data['vue'] = $this->load->view('inscription',$data,TRUE);
        $this->load->view('layout',$data);
    }
    
    public function inscrire(){
        $this->load->library('form_validation');
        $this->load->model('M_Inscription');
        $data['email'] = $this->input->post('email');
        $data['pseudo'] = $this->input->post('pseudo');
        $data['mdp'] = $this->input->post('mdp');
        $data['mdp2'] = $this->input->post('mdp2');
        
        $this->form_validation->set_rules('email', 'Entrez votre adresse email', 'required|valid_email');
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('item','Veuillez entrer une mail valide !');
            redirect('inscription');
        }        
        elseif($this->M_Inscription->verifier($data)){
            $this->session->set_flashdata('item','L\'adresse Email "'.$data['email'].'" est déjà associée à un compte !');
            redirect('inscription');
        }
        elseif(strlen($data['pseudo'])<2){
            $this->session->set_flashdata('item','Veuillez entrer un nom d\'au moins 2 caractères !');
            redirect('inscription');
        }
        elseif( strlen($data['mdp'])<5 ){
            $this->session->set_flashdata('item','Veuillez choisir un mot de pass d\'au moins 5 caractères !');
            redirect('inscription');
        }
        elseif($data['mdp']===$data['mdp2']){
            $this->M_Inscription->inscrire($data);
            $info_membre = $this->M_Inscription->getIdMembre($data['email']);
            $this->session->set_userdata('logged_in',$info_membre);
            redirect(site_url().'article');
        }
        else{
            $this->session->set_flashdata('item', 'Veuillez entrer le même mot de passe !');
            redirect('inscription');
        }
    }
}


