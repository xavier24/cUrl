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
<?php if(isset($url)){?>
<div id="resultat">
    <?php if($correct==true){?>
        <div id="image">
        <?php for($i=0;$i<count($image);$i++){ ?>

                <p id="resul_image" ><img src="<?php echo $image[$i]; ?>" width="250"   /></p>
        <?php }?>
        <p id="precedent">Précedent</p> | <p id="suivant">Suivant</p>
        </div>
    
        <div class="texte">
        <p id="resul_titre" ><a href="<?php echo $url; ?>" title="Aller sur <?php echo $url; ?>"><?php echo $title; ?></a></p>
        <p id="resul_h1" ><?php echo $h1; ?></p>
        <p id="resul_meta" ><?php echo $meta; ?></p>     
        <?php 
            echo form_open('article/enregistrer',array('method'=>'post'));
            $ajout_url= array('value'=>$url,'class'=>'input_texte', 'name'=>'url');
            echo form_input($ajout_url);
            $ajout_title= array('value'=>$title,'class'=>'input_texte', 'name'=>'title');
            echo form_input($ajout_title);
            $ajout_h1= array('value'=>$h1,'class'=>'input_texte','name'=>'h1');
            echo form_input($ajout_h1);
            $ajout_meta= array('value'=>$meta,'class'=>'input_texte', 'name'=>'meta');
            echo form_input($ajout_meta);
            $ajout_image=array('value'=>$image[0],'class'=>'input_texte', 'name'=>'image');
            echo form_input($ajout_image);
            echo form_submit('check" class="add','Ajouter');
            echo form_close();
        ?>
        </div>
    <?php } 
    else{?>
    <div id="erreur"><p>L'adresse n'est pas correcte</p></div>
    <?php } ?>
</div>
<?php } ?>
<div id="articles">
    <h2>Articles</h2>
    <?php if(count($articles)): ?>
      <ul>
          <?php foreach($articles as $article):?>
              <li class="article">
                  <p><a class="delete" href="<?php echo site_url(); ?>article/delete/<?php echo $article->article_id ?>">supprimer</a></p>
                  <img src="<?php echo $article->url_image; ?>"/>
                  
                  <h3><a href="<?php echo $article->url; ?>"><?php echo $article->title; ?></a></h3>
                  <p><?php echo $article->h1; ?></p>
                  <p><?php echo $article->texte; ?></p>
                  
                  <p class="auteur">Posté par : <a><?php echo $article->nom; ?></a></p>
                  
              </li>
          <?php endforeach; ?>
      </ul>
   <?php endif; ?>
</div>
<script src="<?php echo site_url();?>web/js/jquery.js"></script>
<script src="<?php echo site_url();?>web/js/jq.js"></script>
		 