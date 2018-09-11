
// function call_ajax_getarticle(article_title, target){
//     $.ajax({
//         type:'POST',
//         url: '/admin/articles/type_ahead_articles',
//         data:'article_title='+article_title,
//         success:function(msg){
//             if(msg == 'err'){
//                 alert('Some problem occured, please try again.');
//             }else{
//                 $(target).html(msg);
//             }
//         }
//     });
// }


$(document).ready(function() {

      // $('#ajaxSearchButton').click(function(){
      //       call_ajax_getarticles($('#ajaxSearchBox').val(), '#searchResBox');
      // });
      // $('#AddSelected').click(function(){
      //     //alert($('#searchResBox option:selected').text());
      //     $("#relatedArticlesUl").append("<li>"+$('#searchResBox option:selected').text()+"</li>");
      //
      // });

      var $inputAj = $('#ajaxSearchArticlesBox');
      $inputAj.typeahead({
            autoSelect: true,
            minLength: 1,
            // delay: 200,
            source: function(query, process) {
                        $.ajax({
                            type: 'POST',
                            url: '/articles/ajax_get_articles',
                            dataType: 'json',
                            data: {q: query},
                        }).done(function(response) {
                              //console.log(response.dataRet);
                              return process(response.dataRet);
                        });
            },
      });
      $inputAj.change(function() {
          var current = $inputAj.typeahead("getActive");
          //console.log(current);
          if (current) {
              // Some item from your model is active!
              if (current.name == $inputAj.val()) {
                  // This means the exact match is found. Use toLowerCase() if you want case insensitive match.
                  $("#relatedArticlesUl")
                      .html("<li id='li2_relArt_"+current.id+"'>"
                                +"<input type='hidden' value='"+current.id+"' name='article_id' />"
                                    +"<img src='"+current.main_image+"' style='width: 100px;' /> "
                                    +"<a target='blank' href='/"+current.section_url+"/"+current.url+"'>"+current.name+"</a>"
                              +"</li>");
                  $inputAj.val('');
              } else {
                  // This means it is only a partial match, you can either add a new item
                  // or take the active if you don't want new items
              }
          } else {
              // Nothing is active so it is a new value (or maybe empty value)
          }
      });


});
