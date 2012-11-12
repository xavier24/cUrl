<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="fr-BE"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Curl</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        
        <!-- CSS Fontello -->
        
        <link rel="stylesheet" href="<?php echo base_url(); ?>web/css/fontello-ie7.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>web/css/fontello.css">
        
        <link rel="stylesheet" href="<?php echo base_url(); ?>web/css/normalize.css">
        <!--<link rel="stylesheet" type="text/css" href=" <?php //echo base_url(); ?>web/css/reset.css" media="screen" />-->
        <link rel="stylesheet" type="text/css" href=" <?php echo base_url().DIR_CSS; ?>" media="screen" />
        <script src="<?php echo base_url(); ?>web/js/modernizr-2.6.1.min.js"></script>
    </head>        
    <body>

        <?php echo $vue ?>
        
        
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo base_url(); ?>web/js/jquery-1.8.2.min.js"><\/script>')</script>
        <script src="<?php echo base_url(); ?>web/js/plugins.js"></script>
        <script src="<?php echo base_url(); ?>web/js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>

    </body>
</html>