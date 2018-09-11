var jQ = jQuery.noConflict();
jQ(document).ready(function(){
   
});

    function GetCompetitionEntries(compID){
        //alert(jQ('#maintab').attr('class'));
        jQ.ajax({
            url: "/competition_entries/index/"+compID,
            cache: false,
            success: function(html){
              jQ("#allEntries").html(html);
            }
          });
    } 
