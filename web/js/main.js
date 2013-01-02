$(function(){
    //--------------PLUGINS----------------------------------
    // Avoid `console` errors in browsers that lack a console.
    if (!(window.console && console.log)) {
        (function() {
            var noop = function() {};
            var methods = ['assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error', 'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log', 'markTimeline', 'profile', 'profileEnd', 'markTimeline', 'table', 'time', 'timeEnd', 'timeStamp', 'trace', 'warn'];
            var length = methods.length;
            var console = window.console = {};
            while (length--) {
                console[methods[length]] = noop;
            }
        }());
    }
    //--------------------------------------------------------------------
    // __________________________________________________________________
        
        
    //suppression d'un article     
    $(".delete").on("click",function(event){
        event.preventDefault();
        var href = $(this).attr("href");
        var $this = $(this);
        $this.parent().parent().next().remove();
        $.ajax({
            url:href,
            success:function(data){                    
                $this.parent().parent().text(data).fadeOut(4000); 
            }
        });
    });

    // afficher resultat ou erreur apres recherche
    $('#recherche :submit').on('click',function(){
      $('#chargement').css("display","block");
      if('#resultat'||'#erreur'){
         $('#resultat').hide();
         $('#erreur').hide();
      }
    });
    //aller a l'article si recherche article deja existante
    $('#erreur .bouton').on('click',function(){
        var sHref = $(this).find('a').attr("href");
        sHref = sHref.replace("#","");
        $('.article_texte').slideUp("normal");
        $("#"+sHref).next().slideDown("normal");
    });
    
    //developpement article de la liste
    $('.article_texte').hide();
    $('.icone_article').on('click',function(){
        var $article = $(this).parent().parent().next();
        
        if($(this).parent().parent().next(':visible').length != 0){
            $article.slideUp("normal");
        }
        else{
            $('.article_texte').slideUp("normal");
            $article.slideDown("normal");
        }
    });
    
    //Galerie choix image
    var $figs = $('#resultat .resul_image');
    $figs.not(":first").hide();

    var $input =$('#ajout_image');

    $("#suivant").on("click",function(){
            var $nextImg = $figs.filter(":visible").next();

            if( $nextImg.size() == 0){
                $nextImg = $figs.first();
            }

            $figs.filter(":visible").fadeOut("fast",function(){
                                                            $nextImg.fadeIn("fast"); 
                                                         });

            var $url_image = $nextImg.attr('src');               
            $input.val($url_image);


    });

    $("#precedent").on("click",function(){
            var $prevImg = $figs.filter(":visible").prev();
            if( $prevImg.size() == 0){
                    $prevImg = $figs.last();
            }
            $figs.filter(":visible").fadeOut("fast",function(){
                                                            $prevImg.fadeIn("fast"); 
                                                            });
            var $url_image = $prevImg.attr('src');               
            $input.val($url_image);
    });

    // modifier info resultat
    $("#modifier").on("click",function(){
            $(".input_texte").css("display","block");
            $("#resultat label").css("display","block");
            $(".resul_cache").css("display","none");

    });

        
});



