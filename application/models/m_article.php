<?php

    class M_Article extends CI_Model
    {
        public function lister()
	{
            $this->db->select('articles.*, membres.*');
            $this->db->from('articles');
            $this->db->join('membres','articles.membre_id = membres.membre_id');
           
            $query = $this->db->get();
            return $query->result();
                    
	}
        
        public function enregistrer($data){
            $this->db->insert('articles',array('membre_id'=>'1','url'=>$data['ajout_url'],'title'=>$data['ajout_title'],'texte'=>$data['ajout_meta'],'h1'=>$data['ajout_h1'],'url_image'=>$data['ajout_image']));
        }
        
        public function delete($id){
            
        
            $this->db->delete('articles',array('article_id'=>$id));
            
            
            
        }
    }
