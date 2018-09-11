

$(document).ready(function() {

      var $inputAj = $('#ajaxSearchCmisBox');
      $inputAj.typeahead({
            autoSelect: true,
            minLength: 1,
            // delay: 200,
            source: function(query, process) {
                        $.ajax({
                            type: 'POST',
                            url: '/cmi_products/ajax_get_cmis',
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
                  $("#relatedCmisUl")
                      .append("<li id='li2_relArt_"+current.id+"'>"
                                +"<input type='hidden' value='"+current.name+"' name='dummy_related_cmis["+current.id+"]' />"
                                    +"<a target='blank' href='/"+current.section_url+"/"+current.url+"'>"+current.name+"</a>"
                                    +"<a href='#relatedCmisUl' onclick=\"$('#li2_relArt_"+current.id+"').remove();\" style='color: #990000;'><i> [delete] </i></a>"
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
