<?php

    class M_Member extends CI_Model
    {
        public function verifier($data)
	{
           $query = $this->db->get_where('membres',
                                            array('email'=>$data['email'],
                                                    'mdp'=>$data['mdp']));
           
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
