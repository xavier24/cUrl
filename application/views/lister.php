<header id="formulaire" class="block"> 
    <section id="recherche">
        <?php 
        echo form_open('article/entrerURL',array('method'=>'post'));
        echo form_label("Entrez l'adresse du site",'url" class="entete"');
        ?><p>http://</p><?php
        $urlInput = array('name'=>'url','id'=>'url','class'=>'url');
        
        echo form_input($urlInput);
        echo form_submit('check" class="analyse','Analyser');
        echo form_close();
     ?>
    </section>
     <section id="connexion">
         <p>Bonjour <?php echo $nom_membre; ?></p>
        <h1 class="deconnex">
            <?php echo anchor( 'member/deconnecter',"Se déconnecter",array('title'=>'Pour se déconnecter', 'hreflang'=>'fr' ,'class'=>'icon-off')); ?>
        </h1>
    </section>
</header>
<section id="corps">
    <section id="chargement" class="block">
        <p>Recherche en cours...</p><img src="<?php echo site_url(); ?>web/images/ajax-loader.gif" />
    </section>
    <?php if(isset($url)){?>
        <section id="resultat" class="block">
            <?php if($correct==true){?>
                <section class="image">
                    <figure>
                        <?php for($i=0;$i<count($image);$i++){ ?>
                            <img class="resul_image" id="<?php echo $i; ?>" src="<?php echo $image[$i]; ?>" width="250"   />
                        <?php }?>
                    </figure>
                    <a id="precedent" href="#" class="icon-left-open">Précedent</a><a id="suivant" href="#" >Suivant<span class="icon-right-open"></span></a>
                </section>

                <section class="texte">
                    <h1 class="titre"><?php echo $url; ?></h1>
                    <h2 id="resul_titre" class="resul_texte bouton" ><a href="<?php echo $url; ?>" title="Aller sur <?php echo $url; ?>"><?php echo $title; ?></a></h2>
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
                </section>
            <?php } 
            else{?>
                <section id="erreur">
                    <p>L'adresse "<?php echo $url; ?>"<?php echo $message; ?></p>
                    <?php if(isset($modifier)){ ?>
                    <p class="bouton"><a href="#article_<?php echo $url; ?>" >L'afficher pour le modifier ?</a></p>
                    <?php } ?>
                </section>
            <?php } ?>
        </section>
    <?php } ?>
    <section id="articles" class="block">
        <h1 class="entete">Articles</h1>
        <?php if(count($articles)){ ?>
            <?php foreach(array_reverse($articles) as $article):?>
            <article id="article_<?php echo $article->url; ?>">
                <p><a class="delete" href="<?php echo site_url(); ?>article/delete/<?php echo $article->article_id ?>">supprimer</a></p>
                <figure class="image">
                    <img src="<?php echo $article->url_image; ?>" width="250"/>
                </figure>
                <section class="texte">
                    <h1 ><a class="titre_article" href="<?php echo $article->url; ?>"><?php echo $article->title; ?></a></h1>
                    <h2><?php echo $article->h1; ?></h2>
                    <p><?php echo $article->texte; ?></p>
                </section>
            </article>
            <?php endforeach; ?>
        <?php }
        else{ ?>
            <p>il n'y a pas d'article</p>
    <?php }
    ?>
    </section>
</section>
<aside id="sidebar" class="block">
    <h1 class="entete">Mes liens</h1>
    <?php if(count($articles)){ ?>
        <ul class="icon-right-circle">
            <?php foreach(array_reverse($articles) as $article):?>
                <li >
                    <a href="<?php echo $article->url; ?>"><?php echo $article->title; ?></a>
                    <a href="#article_<?php echo $article->url; ?>"><img src="<?php echo base_url();?>web/images/liste.png" /></a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php }
    else{ ?>
        <p>il n'y a pas d'article</p>
    <?php }?>
</aside>	 