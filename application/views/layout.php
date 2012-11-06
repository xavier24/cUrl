<!DOCTYPE html>
<html lang="fr-BE">
<head>
	<meta charset="utf-8">
	<title>Curl</title>
        <link rel="stylesheet" type="text/css" href=" <?php echo base_url(); ?>web/css/reset.css" media="screen" />
        <link rel="stylesheet" type="text/css" href=" <?php echo base_url().DIR_CSS; ?>" media="screen" />
</head>        
<body>
    
    <?php if($this->session->userdata('logged_in'))
        {?>
    <h4><?php echo anchor( 'member/deconnecter',"Se déconnecter",array('title'=>'Pour se déconnecter', 'hreflang'=>'fr' ));
        ?></h4><?php } ?>
    <?php echo $vue ?>

</body>
</html>