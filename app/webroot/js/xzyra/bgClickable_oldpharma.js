var jQ = jQuery.noConflict();
jQ(document).ready(function(){
                jQ(document).click(function(e){
                        mainP = jQ('#BodyContent').position();
                        clickT = jQ('#BodyContent').attr('title');
                        
                        if(mainP.left > e.pageX || (mainP.left+980) < e.pageX){
                                        window.location.href=clickT;
                        }else{
                                if(e.pageY < 20){
                                                window.location.href=clickT;
                                }else{
                                        //alert('inside');
                                }
                        }
                });
                
                jQ(document).mousemove(function(e){
                        //alert(e.pageX+', '+e.pageY);
                        mainP = jQ('#BodyContent').position();
                        
                        if(mainP.left > e.pageX || (mainP.left+980) < e.pageX ){
                                //alert('outside');
                                jQ("body").css('cursor','pointer');
                                //window.location.href="http://www.epharmacy.com.au/product.asp?id=59256&pname=Compeed+Cold+Sore+Patch";
                        }else{
                                if(e.pageY < 20){
                                        //alert('outside < 110');
                                        jQ("body").css('cursor','pointer');
                                }else{
                                        //alert('inside');
                                        jQ("body").css('cursor','default');
                                }
                        }
                });
});
