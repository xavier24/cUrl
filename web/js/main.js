$(function(){
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
	
        //developpement article de la liste
        $('.article_texte').hide();
        $('.icone_article').on('click',function(){
            var $article = $(this).parent().parent().next();
            
            if($(this).hasClass('ouvert')){
                $article.hide();
                $(this).removeClass('ouvert');
            }
            else{
                $article.show();
                $(this).addClass('ouvert');
            }
            //$('#sidebar p').removeClass("icon-down-open").addClass("icon-up-open"); 
        });
        $('#sidebar .icon-down-open').on('click',function(){
           $('#sidebar ul').css("display","none");
           $('#sidebar p').removeClass("icon-up-open").addClass("icon-down-open");
          
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



