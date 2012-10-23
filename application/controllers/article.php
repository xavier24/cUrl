
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
            
           var_dump($resultat);
            //$this->analyser($resultat,$url);
           if(!$resultat==false)
           { 
                
                $data["correct"] = true;
                $dom = new DOMDocument();
                @$dom->loadHTML($resultat);
                
                $data["url"] = $url;

                $nodes = $dom->getElementsByTagName('title');
                $data["title"] = $nodes->item(0)->nodeValue;

                $nodes = $dom->getElementsByTagName('meta');
                foreach($nodes as $node){
                    if($node->getAttribute("name")==="description"){
                        $data["meta"] = $node->getAttribute("content");
                    }
                    else{$data["meta"]= "pas de description disponible";}
                }
                $nodes = $dom->getElementsByTagName('h1');
                if(isset($nodes))
                {
                    $data["h1"] = $nodes->item(0)->nodeValue;
                }
                else
                {
                    $data["h1"] = "pas de h1";
                }

                $nodes = $dom->getElementsByTagName('img');
                $data["image"] = array();


                foreach($nodes as $node){

                    $image = $node->getAttribute("src");
                    $taille = getimagesize($image);
                    if($taille[0]>70){
                        array_push($data["image"],$node->getAttribute("src"));
                    }
                }
           
                
            }
            else
            {
                $data["correct"] = false;
            }
            var_dump($data["correct"]);
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
            //var_dump($data);
           
            $this->load->model('M_Article');
            $dataList['articles'] = $this->M_Article->lister();
            $dataLayout['vue'] = $this->load->view('lister',$dataList,true);
            $dataLayout['vue'] = $this->load->view('lister',$data,true);
            
           
            $this->load->view('layout',$dataLayout);
            
        }
        
        public function enregistrer(){
            //$this->load->helper('form');
            //$this->load->helper('url');
            /*define('DIR_CSS', 'web/css/style.css');*/
            
            $this->load->model('M_Article');
            //$dataList['articles'] = $this->M_Article->lister();
            
            //$dataLayout['vue'] = $this->load->view('lister',$dataList,true);
            //$this->load->view('layout',$dataLayout);
            
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
}