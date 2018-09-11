
function toggleAbstract(strID){
    if(jQ(strID).is(":visible")){
        jQ(strID).slideUp('slow');
    }else{
        jQ(strID).slideDown('slow');
        jQ(this).html("close abstract");
    }
}