


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
                    
        $(".add").on("click",function(event){
            //event.preventDefault();
            
        });      
               
        
        
        
        
	//trombinoscope
	var $figs = $('#resultat #resul_image');
	
	$figs.not(":first").hide();
        //$figs.hide();
        //$("#resultat:nth-child(1)").show();
        
	//setInterval(changementImg,3000);
	
	function changementImg(){
		
		var $nextImg = $figs.filter(":visible").next();
		
		if( $nextImg.size() == 0){
			$nextImg = $figs.first();
		}
		$figs.filter(":visible").fadeOut("fast",function(){
                                                                $nextImg.fadeIn("fast"); 
								});
	}
	
	
});



