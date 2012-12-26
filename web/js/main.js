$(function(){
	      
        $(".delete").on("click",function(event){
            event.preventDefault();
            var href = $(this).attr("href");
            var $this = $(this);
            console.log(href);
            $.ajax({
                url:href,
                success:function(data){
                    //console.log(data);
                    $this.parent().parent().text(data).fadeOut(5000); 
                }
            });
        });
        
        
        $('#formulaire :submit').on('click',function(){
          $('#chargement').css("display","block");
          if('#resultat'){
             $('#resultat').hide(); 
          }
        });
	
        $('#sidebar h1').on('click',function(){
           $('#sidebar ul').css("display","block");
           $('#sidebar p').removeClass("icon-down-open").addClass("icon-up-open"); 
        });
        $('#sidebar .icon-down-open').on('click',function(){
           $('#sidebar ul').css("display","none");
           $('#sidebar p').removeClass("icon-up-open").addClass("icon-down-open");
          
        });
        
        
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
        
        $("#modifier").on("click",function(){
                console.log('jglkg');
                $(".input_texte").css("display","block");
                $("#resultat label").css("display","block");
                $(".resul_texte").css("display","none");
            
        });

        
});



