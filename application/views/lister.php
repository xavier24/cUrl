<div id="formulaire"> 
    <?php 
        echo form_open('article/entrerURL',array('method'=>'post'));
        echo form_label("Entrez l'adresse du site",'url');
        ?><p>http://</p><?php
        $urlInput = array('name'=>'url','id'=>'url');
        
        echo form_input($urlInput);
        echo form_submit('check','Analyser');
        echo form_close();
     ?>
</div>
<div id="chargement">
    <p>Recherche en cours</p><img src="<?php echo site_url(); ?>web/images/loading.gif" />
</div>
<?php if(isset($url)){?>
    <div id="resultat">
        <?php if($correct==true){?>
            <div class="image">
                <div>
                    <?php for($i=0;$i<count($image);$i++){ ?>
                        <p class="resul_image" id="<?php echo $i; ?>"><img src="<?php echo $image[$i]; ?>" width="250"   /></p>
                    <?php }?>
                </div>
                <a id="precedent" href="#">Précedent</a><a id="suivant" href="#">Suivant</a>
            </div>

            <div class="texte">
                <h2><?php echo $url; ?></h2>
                <p id="resul_titre" class="resul_texte" ><a href="<?php echo $url; ?>" title="Aller sur <?php echo $url; ?>"><?php echo $title; ?></a></p>
                <p id="resul_h1" class="resul_texte" ><?php echo $h1; ?></p>
                <p id="resul_meta" class="resul_texte" ><?php echo $meta; ?></p>
                <p id="modifier" class="resul_texte"><a href="#">Modifier</a></p>
                <?php 
                    echo form_open('article/enregistrer',array('method'=>'post'));
                    echo form_label("Adresse du site",'url');
                    $ajout_url= array('value'=>$url,'class'=>'input_texte', 'name'=>'url','id'=>'ajout_url');
                    echo form_input($ajout_url);
                    
                    echo form_label("Nom du site",'title');
                    $ajout_title= array('value'=>$title,'class'=>'input_texte', 'name'=>'title','id'=>'ajout_title');
                    echo form_input($ajout_title);
                    
                    echo form_label("Titre de la page",'h1');
                    $ajout_h1= array('value'=>$h1,'class'=>'input_texte','name'=>'h1','id'=>'ajout_h1');
                    echo form_input($ajout_h1);
                    
                    echo form_label("Description de la page",'meta');
                    $ajout_meta= array('value'=>$meta,'class'=>'input_texte', 'name'=>'meta','id'=>'ajout_meta');
                    echo form_textarea($ajout_meta);
                    
                    echo form_label("Entrez l'adresse de l'image que vous desirez",'image');
                    $ajout_image=array('value'=> $image[0] ,'class'=>'input_texte', 'name'=>'image','id'=>'ajout_image');
                    echo form_input($ajout_image);


                    echo form_submit('check" class="add','Ajouter');
                    echo form_close();
                ?>
            </div>
        <?php } 
        else{?>
        <div id="erreur"><p>L'adresse "<?php echo $url; ?> " n'existe pas</p></div>
        <?php } ?>
    </div>
<?php } ?>
<div id="articles">
    <h2>Articles</h2>
    <?php if(count($articles)){ ?>
        <?php foreach(array_reverse($articles) as $article):?>
           <div class="article">
              <p><a class="delete" href="<?php echo site_url(); ?>article/delete/<?php echo $article->article_id ?>">supprimer</a></p>
              <div class="image">
                  <img src="<?php echo $article->url_image; ?>" width="250"/>
              </div>
              <div class="texte">
                  <h3><a href="<?php echo $article->url; ?>"><?php echo $article->title; ?></a></h3>
                  <p><?php echo $article->h1; ?></p>
                  <p><?php echo $article->texte; ?></p>
                  
                 <!--<p class="auteur">Posté par : <a>--><?php /*echo $article->nom; */?><!--</a></p>-->
                  
              </div>
           </div>
        <?php endforeach; ?>
    <?php }
    else{ ?>
        <p>il n'y a pas d'article</p>
   <?php }
?>
</div>
<script src="<?php echo base_url();?>web/js/jquery.js"></script>
<script src="<?php echo base_url();?>web/js/jq.js"></script>
		 