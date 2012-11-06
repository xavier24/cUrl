<?php

class inscription extends CI_Controller {
    
    public function index(){
        $this->load->helper('form');
        $data['main_title'] = 'CURL - connexion';
        $data['vue'] = $this->load->view('inscription',$data,TRUE);
        $this->load->view('layout',$data);
    }
    
    public function inscrire(){
        $this->load->model('M_Inscription');
        $data['email'] = $this->input->post('email');
        $data['pseudo'] = $this->input->post('pseudo');
        $data['mdp'] = $this->input->post('mdp');
        $data['mdp2'] = $this->input->post('mdp2');
        
        if($this->M_Inscription->verifier($data)){
            var_dump('L\'adresse Email "'.$data['email'].'" est deja associer a un compte');
        }
        elseif($data['mdp']===$data['mdp2']){
            $this->M_Inscription->inscrire($data);
            $info_membre = $this->M_Inscription->getIdMembre($data['email']);
            $this->session->set_userdata('logged_in',$info_membre);
            redirect(site_url().'article');
        }
        else{
            var_dump("entrez le meme mot de passe");
            //redirect(site_url().'inscription');
        }
    }
}

?>
