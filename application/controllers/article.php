
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	
    class Article extends CI_Controller {


        public function index()
        {
           $this->load->helper('form');
           $this->load->helper('url');
           $this->lister();
        }
        
        public function lister(){
            
            $this->load->model('M_Article');
            $dataList['articles'] = $this->M_Article->lister();
            
            $dataLayout['vue'] = $this->load->view('lister',$dataList,true);
            $this->load->view('layout',$dataLayout);
            
            
	}
       
        public function entrerURL(){
            
            $this->load->helper('form');
            $url = $this->input->post('url');
            
            /*$this->load->model('M_Article');
            $verif = $this->M_Article->verifier($url);*/
            
            if (preg_match('`^https://|http://`i', $url)){
               $this->cURL($url);
            }
            else{
               $url = 'http://'.$url;
               $this->cURL($url);
            }
        }
       
        public function cURL($url){
            
            $curl = curl_init();
            $timeout = 10;
            
            curl_setopt($curl,CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_FRESH_CONNECT, true); 
            curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
            
            if (preg_match('`^https://`i', $url))
            {
             // Ne pas vérifier la validité du certificat SSL
             curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
             curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            } 
            
            // Suivre les redirections [facultatif]
            // www.oseox.fr redirige par exemple automatiquement vers oseox.fr
            // Le code de retour serait ici 301 si l'on ne suivait pas les redirections
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); 
            
            // Récupération du contenu retourné par la requête
            // sous forme de chaîne de caractères via curl_exec()
            // (directement affiché au navigateur client sinon) 
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            
            
            curl_setopt($curl, CURLOPT_COOKIESESSION, true);
           
            $resultat = curl_exec($curl);
            
            // Récupération du code HTTP retourné par la requête
            //$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE); 
            
            curl_close($curl);
            
            //$this->analyser($resultat,$url);
           if(!$resultat==false)
           { 
                $data["correct"] = true;
                $dom = new DOMDocument();
                @$dom->loadHTML($resultat);
                $data["val"] = 2;
                $data["url"] = $url;
                $data["title"] = "Ce site n'a communiqué aucun nom";
                $data["h1"] = "Ce site n'a communiqué aucun titre général";
                $data["meta"]= "Ce site n'a communiqué aucune description";
                
                $nodes = $dom->getElementsByTagName('title');
                $data["title"] = utf8_decode($nodes->item(0)->nodeValue);

                $nodes = $dom->getElementsByTagName('meta');
                foreach($nodes as $node){
                    if($node->getAttribute("name")==="description"){
                        $data["meta"] =utf8_decode($node->getAttribute("content")); 
                    }
                }
                
                $nodes = $dom->getElementsByTagName('h1');
                foreach($nodes as $node){
                    if(isset($node))
                    {
                        $data["h1"] = utf8_decode($nodes->item(0)->nodeValue);
                    }
                 }
                 
                $data["image"][] = base_url()."/web/images/visuel-non-disponible.png";
                
                $nodes = $dom->getElementsByTagName('img');
                
                if(count($nodes))
                {
                   foreach($nodes as $node)
                   {
                      $image = $node->getAttribute("src");
                      $url_image = $this->rel2abs($image, $url);
                      $taille = getimagesize($url_image);
                      if($taille[0]>70){
                         $data["image"][] = $url_image;
                      }
                   }
                   if( count( $data["image"] ) > 1 )
                   {
                      array_shift($data["image"]);
                   }
                }
           }
           else
           {
               $data["correct"] = false;
               $data["url"] = $url;
           }
           $this->afficher($data);
        }
        
        /*public function analyser($resultat,$url){
                   
           $data["url"] = $url;
                     
           if(preg_match("#<title>(.+)<\/title>#i",$resultat)){
               preg_match("#<title>(.+)<\/title>#i",$resultat,$title);
               $data["title"] = $title[1];
           }
           else{
               echo("pas de title");
           }
           
           if(preg_match("#<meta.*(name=['|\"]?description['|\"]?.*content=['|\"]?(.*)['|\"]?)|(content=['|\"]?(.*)['|\"]?.*name=\"description['|\"]?)#i",$resultat)){
               preg_match("#<meta.*(?:name=['|\"]?description['|\"]?.*content=['|\"](.*)['|\"])|(?:content=['|\"]?(.*)['|\"]?.*name=\"description['|\"]?)#i",$resultat,$meta);
               var_dump($meta);
               $data["meta"] = $meta[1];
           }
           else{
               echo("pas de meta");
                $data["meta"] = "Pas de description disponible";
           }
           
           
           
           if(preg_match("#<h1>(.+)<\/h1>#i",$resultat)){
               preg_match("#<h1>(.+)<\/h1>#i",$resultat,$h1);
               $data["h1"] = $h1[1];
           }
           else{
               echo("pas de h1");
           }
           
           if(preg_match("#<img(.+)\/>#i",$resultat)){
               preg_match_all("#<img[^>]*src=['|\"](.*)['|\"]#isU",$resultat,$image);
               $data["image"] = $image[1];
           }
           else{
               echo("pas d'image");
           }
         
           
           $this->afficher($data);
           
        }
       */
        public function afficher($data){
            $this->load->model('M_Article');
            $dataList['articles'] = $this->M_Article->lister();
            $dataLayout['vue'] = $this->load->view('lister',$dataList,true);
            $dataLayout['vue'] = $this->load->view('lister',$data,true);
            $this->load->view('layout',$dataLayout);
        }
        
        public function enregistrer(){
                      
            $this->load->model('M_Article');
            $data['ajout_url'] = $this->input->post('url');
            $data['ajout_title'] = $this->input->post('title');
            $data['ajout_meta'] = $this->input->post('meta');
            $data['ajout_h1'] = $this->input->post('h1');
            $data['ajout_image'] = $this->input->post('image');
            $this->M_Article->enregistrer($data);
            redirect(site_url()); 
        }
        
        public function delete(){
             $this->load->model('M_Article');
             $id = $this->uri->segment(3);
             $this->M_Article->delete($id);
            if($this->input->is_ajax_request()){
                echo "lien supprimé !";
            }
            else{
                $data['vue'] ="ok";
                $this->load->view("ok");
            }
       }
       
       public function rel2abs($rel, $base)
       {
            $path=null;
            /* return if already absolute URL */
            if (parse_url($rel, PHP_URL_SCHEME) != '') return $rel;

            /* queries and anchors */
            if ($rel[0]=='#' || $rel[0]=='?') return $base.$rel;

            /* parse base URL and convert to local variables:
            $scheme, $host, $path */
            extract(parse_url($base));

            /* remove non-directory element from path */
            $path = preg_replace('#/[^/]*$#', '', $path);

            /* destroy path if relative url points to root */
            if ($rel[0] == '/') $path = '';

            /* dirty absolute URL */
            $abs = "$host$path/$rel";

            /* replace '//' or '/./' or '/foo/../' with '/' */
            $re = array('#(/\.?/)#', '#/(?!\.\.)[^/]+/\.\./#');
            for($n=1; $n>0; $abs=preg_replace($re, '/', $abs, -1, $n)) {}

            /* absolute URL is ready! */
            return $scheme.'://'.$abs;
       }
}