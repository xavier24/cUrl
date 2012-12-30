<header id="header">
    <h1>MyList</h1>
    <div id="connecte" class="mobile_cache">
        <p>Bonjour <?php echo $nom_membre; ?></p>
    </div>
    <h2 class="deconnex bouton_header">
       <?php echo anchor( 'member/deconnecter',"Se déconnecter",array('title'=>'Pour se déconnecter', 'hreflang'=>'fr' ,'class'=>'icon-off')); ?>
    </h2>
    <div id="navigation" class="bouton_header">
        <img src="<?php echo site_url(); ?>web/images/menu.png" />
        <ul>
            <li></li>
        </ul>
    </div>
</header>
<section id="recherche" class="block">
    <h1 class="entete mobile_cache">Entrez l'adresse du site</h1> 
    <?php 
    echo form_open('article/entrerURL',array('method'=>'post'));
    echo form_label("http://",'url');
    $urlInput = array('name'=>'url','id'=>'url','class'=>'url');
    echo form_input($urlInput);
    $data = array(
    'name' => 'check',
    'id' => 'button',
    'class'=> 'analyse icon-search',
    'value' => 'true',
    'type' => 'submit',
    'content' => ' Analyser'
    );
    echo form_button($data);
    echo form_close(); ?> 
</section>
<div id="chargement" class="block">
    <p>Recherche en cours...</p><img src="<?php echo site_url(); ?>web/images/ajax-loader.gif" />
</div>
<?php if(isset($url)){?>
    <?php if($correct==true){?>
        <section id="resultat" class="block">
            <h1 class="cache">Résultat de la recherche</h1>
            <div id="afficher_images">
                <div id="images">
                    <div>
                    <?php for($i=0;$i<count($image);$i++){ ?>
                        <img class="resul_image" id="<?php echo $i; ?>" src="<?php echo $image[$i]; ?>"   />
                    <?php }?>
                    </div>
                </div>
                <a id="precedent" href="#" class="icon-left-open" title="image précédente"></a>
                <a id="suivant" href="#" ><span class="icon-right-open-1" title="image suivante"></span></a>
            </div>

            <div id="afficher_texte">
                <h1 class="titre resul_cache"><?php echo $url; ?></h1>
                <h2 id="resul_titre" class="bouton resul_cache" ><a href="<?php echo $url; ?>"class="bouton" title="Aller sur <?php echo $url; ?>"><?php echo $title; ?></a></h2>
                <p id="resul_h1" class="resul_texte resul_cache" ><?php echo $h1; ?></p>
                <p id="resul_meta" class="resul_texte resul_cache" ><?php echo $meta; ?></p>
                <button id="modifier" class="resul_action resul_cache icon-pencil">Modifier</button>
                <?php 
                    echo form_open('article/enregistrer',array('method'=>'post'));
                    //echo form_label("Adresse du site",'url');
                    $ajout_url= array('value'=>$url,'class'=>'input_texte input_titre', 'name'=>'url','id'=>'ajout_url');
                    echo form_input($ajout_url);

                    //echo form_label("Nom du site",'title');
                    $ajout_title= array('value'=>$title,'class'=>'input_texte input_result_titre', 'name'=>'title','id'=>'ajout_title');
                    echo form_input($ajout_title);

                    //echo form_label("Titre de la page",'h1');
                    $ajout_h1= array('value'=>$h1,'class'=>'input_texte input_result_texte','name'=>'h1','id'=>'ajout_h1');
                    echo form_input($ajout_h1);

                    //echo form_label("Description de la page",'meta');
                    $ajout_meta= array('value'=>$meta,'class'=>'input_texte input_result_texte', 'name'=>'meta','id'=>'ajout_meta');
                    echo form_textarea($ajout_meta);

                    //echo form_label("Entrez l'adresse de l'image que vous desirez",'image');
                    $ajout_image=array('value'=> $image[0] ,'class'=>'input_texte', 'name'=>'image','id'=>'ajout_image');
                    echo form_input($ajout_image);
                    
                    $data = array(
                        'name' => 'check',
                        'id' => 'ajouter',
                        'class'=> 'resul_action icon-floppy',
                        'value' => 'true',
                        'type' => 'submit',
                        'content' => ' Ajouter'
                    );
                    echo form_button($data);
                    echo form_close();
                ?>
            </div>
            <hr />
        </section>
    <?php } 
    else{?>
        <section id="erreur">
            <p>L'adresse "<?php echo $url; ?>"<?php echo $message; ?></p>
            <?php if(isset($modifier)){ ?>
            <p class="bouton"><a href="#article_<?php echo $url; ?>" >Aller à cet article ?</a></p>
            <?php } ?>
        </section>
    <?php } ?>
<?php } ?>
<aside id="sidebar" class="block">
    <h1 class="entete">Mes liens</h1>
    <?php if(count($articles)){ ?>
        <ul>
            <?php foreach(array_reverse($articles) as $article):?>
                <li class="icon-right-circle">
                    <a href="<?php echo $article->url; ?>"><?php echo $article->title; ?></a>
                    <a href="#article_<?php echo $article->url; ?>"><img src="<?php echo base_url();?>web/images/liste.png" /></a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php }
    else{ ?>
        <p>il n'y a pas d'article</p>
    <?php }?>
    <p class="icon-down-open"></p>
</aside>
<section id="corps">
    
    <section id="articles" class="block">
        <h1 class="entete">Articles</h1>
        <?php if(count($articles)){ ?>
            <?php foreach(array_reverse($articles) as $article):?>
            <article id="article_<?php echo $article->url; ?>">
                <p><a class="delete" href="<?php echo site_url(); ?>article/delete/<?php echo $article->article_id ?>">supprimer</a></p>
                <figure class="image">
                    <img src="<?php echo $article->url_image; ?>" />
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
	 