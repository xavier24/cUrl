<section id="inscription" class="block">
    <h1 class="entete">Créer mon compte</h1>
    
    <?php
        echo form_open('inscription/inscrire',array('method'=>'post'));
        
        echo form_label('Entrez votre adresse email','email');
        $emailInput = array('name'=>'email','id'=>'email');
        echo form_input($emailInput);
        echo '<br />';
        echo form_label('Entrez votre nom','pseudo');
        $speudoInput = array('name'=>'pseudo','id'=>'pseudo');
        echo form_input($speudoInput);
        echo '<br />';
        echo form_label('Entrez votre mot de passe','mdp');
        $mdpInput = array('name'=>'mdp','id'=>'pass');
        echo form_password($mdpInput);
        echo '<br />';
        echo form_label('Entrez à nouveau votre mot de passe','mdp2');
        $mdp2Input = array('name'=>'mdp2','id'=>'pass2');
        echo form_password($mdp2Input);
        echo '<br />'; 
        if($message){?>
            <p class="erreur_inscription"><?php echo $message ?></p>
        <?php }
        echo form_submit('check" class="connex','Je m\'inscrire');
        echo form_close();
    ?>
        <p><a class="inscription" href="<?php echo site_url(); ?>member">Annuler</a></p>
              
</section>