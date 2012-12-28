<header id="header">
    <h1>MyList</h1>
</header>
<section id="member" class="block">
    <h1 class="entete">Connexion à votre compte</h1>
    <?php if(isset($connexion)){ ?>
        <h3><?php echo $connexion ?></h3>
        <?php }
        echo form_open('member/login',array('method'=>'post'));
        echo form_label('Adresse email','email');
        $emailInput = array('name'=>'email','id'=>'email');
        
        echo form_input($emailInput);
        echo '<br />';
        echo form_label('Mot de passe','mdp');
        $mdpInput = array('name'=>'mdp','id'=>'mdp');
        echo form_password($mdpInput);
        echo '<br />';
        echo form_submit('check" class="connex','Connexion');
        echo form_close();
    ?>
        <p><a class="inscription" href="<?php echo site_url(); ?>inscription">Inscription</a></p>
              
</section>