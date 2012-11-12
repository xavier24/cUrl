<?php

class inscription extends CI_Controller {
    
    public function index(){
        $this->load->helper('form');
        $data['message'] = $this->session->flashdata('item');
        $data['main_title'] = 'CURL - connexion';
        $data['vue'] = $this->load->view('inscription',$data,TRUE);
        var_dump($data['message']);
        $this->load->view('layout',$data);
    }
    
    public function inscrire(){
        $this->load->model('M_Inscription');
        $data['email'] = $this->input->post('email');
        $data['pseudo'] = $this->input->post('pseudo');
        $data['mdp'] = $this->input->post('mdp');
        $data['mdp2'] = $this->input->post('mdp2');
        
        if($this->M_Inscription->verifier($data)){
            $this->session->set_flashdata('L\'adresse Email "'.$data['email'].'" est déjà associée à un compte !');
            var_dump('email');
            $this->index();
            return;
            
        }
        elseif( strlen($data['mdp'])<5 ){
            $this->session->set_flashdata('Veuillez choisir un mot de pass d\'au moins 5 caractères.');
            var_dump('5caractere');
            $this->index();
            return;
        }
        elseif($data['mdp']===$data['mdp2']){
            $this->M_Inscription->inscrire($data);
            $info_membre = $this->M_Inscription->getIdMembre($data['email']);
            $this->session->set_userdata('logged_in',$info_membre);
            redirect(site_url().'article');
        }
        else{
            $this->session->set_flashdata('item', 'Veuillez entrer le même mot de passe !');
            var_dump('mdp');
            $this->index();
            return;
        }
    }
}

?>
