<?php

    class M_Article extends CI_Model
    {
        public function lister($id_membre)
	{
            $this->db->select('articles.*, membres.*');
            $this->db->from('articles');
            $this->db->join('membres','articles.membre_id = membres.membre_id');
            $this->db->where('membres.membre_id',$id_membre);
            $query = $this->db->get();
            return $query->result();
                    
	}
        public function verifier($url,$id_membre){
            $query = $this->db->get_where('articles',
                                            array('membre_id'=>$id_membre,
                                                    'url'=>$url));
           
            return $query->num_rows();           
        }
        public function enregistrer($data){
            $this->db->insert('articles',array('membre_id'=>$data['membre_id'],'url'=>$data['ajout_url'],'title'=>$data['ajout_title'],'texte'=>$data['ajout_meta'],'h1'=>$data['ajout_h1'],'url_image'=>$data['ajout_image'],'date'=>$data['date']));
        }
        
        public function delete($id){
            $this->db->delete('articles',array('article_id'=>$id));
        }
    }
