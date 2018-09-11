var jQ = jQuery.noConflict();

jQ(function(){

  //for Tabs
  jQ('.tabLink').click(function(e){
    jQ('.tabLink').removeClass('selected');
    jQ(this).addClass('selected');
    e.preventDefault();
    jQ('.tabContent').removeClass('selected');
    jQ(jQ(this).attr('href')).addClass('selected');
  });

  jQ('.tabExpand').click(function(){
      if(jQ(this).html()=="Expand listing"){
        jQ('.tabWrapper').attr('style', 'height: auto;');
        jQ(".tabExpand").html("Compress listing");
      }else{
        jQ('.tabWrapper').attr('style', 'height: 320px;');
        jQ(".tabExpand").html("Expand listing");
      }
  });
})
