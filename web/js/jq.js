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
        
        
        $('#formulaire input:submit').on('click',function(){
          $('#chargement').css("display","block");
          if('#resultat'){
             $('#resultat').hide(); 
          }
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
            
            
            
            
                 
                
                var $url_image = $nextImg.children("img").eq(0).attr('src');
                
                
                console.log($url_image);
                //$input.val("$image["+$valeur+"]");
                $input.val($url_image);
                console.log($input.val());
        
    
        });
        
        $("#precedent").on("click",function(){
                var $prevImg = $figs.filter(":visible").prev();
                if( $prevImg.size() == 0){
			$prevImg = $figs.last();
		}
                $figs.filter(":visible").fadeOut("fast",function(){
                                                                $prevImg.fadeIn("fast"); 
								});
                
        });

        
});



