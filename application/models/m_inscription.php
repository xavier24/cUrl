<?php

    class M_Inscription extends CI_Model
    {
        public function inscrire($data)
	{
            $this->db->insert('membres',array('email'=>$data['email'],'nom'=>$data['pseudo'],'mdp'=>$data['mdp']));
        }
        public function verifier($data){
            $query = $this->db->get_where('membres',array('email'=>$data['email']));
            return $query->num_rows(); 
        }
        public function getIdMembre($data)
        {
            $this->db->select('*');
            $this->db->from('membres');
            $this->db->where('email',$data);
            $query = $this->db->get();
            return $query->row();
        }
        
    }
