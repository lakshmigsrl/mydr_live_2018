$(document).ready(function() {

  /* CKeditor functions */
        CKEDITOR.replace( 'body', {
            filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
            filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserWindowWidth: '1000',
            filebrowserWindowHeight: '700'
        } );

        $('#ckfinder-modal-0').click(function(){
          selectFileWithCKFinder( "lino0" );
        });
  /* END CKeditor functions */


  /* jQuery Style dynamic slide edit*/
      function addSlideRow(){
        ctrSlide = $('#ctrSlide').val();
        ctrContSlide = $('#ctrContSlide').val();
        if(ctrSlide>2){
          alert("You can only add up to 3 slides per section.");
          return;
        }
        var widgetVar = $('#grade-template').html();

        widgetVar = widgetVar.replace(/_x_/g, ctrContSlide);
        widgetVar = widgetVar.replace(/Slide_heading/g, "Slide <span style='display: none;'>"+ctrContSlide+"</span>");
        $('#grade-fields').append(widgetVar);
        ctrSlide++;
        ctrContSlide++;
        $('#ctrSlide').val(ctrSlide);
        $('#ctrContSlide').val(ctrContSlide);
        loadImageChangeEvent();
      }

      $('.added').click(function(){
          addSlideRow();
      });
      $('.removeSlide').click(function(){
          parentDiv = $(this).closest("div");
          parentDiv.children("input.slide-title").val("delete-me");
          parentDiv.hide();
          ctrSlide = $('#ctrSlide').val();
          ctrSlide--;
          $('#ctrSlide').val(ctrSlide);
      });
      loadImageChangeEvent();


  /* END jQuery Style dynamic slide edit*/
});

function loadImagePreview(elementId){
  var strTemp = $(elementId).attr('id');
  strImgNum = strTemp.replace(/main_image/g, "");

  strImgName = "slidePreview_"+strImgNum;
  $("."+strImgName).attr('src', $(elementId).val());
}

function loadImageChangeEvent(){
  $('.slidePreview').change(function(){
      loadImagePreview("#"+$(this).attr('id'));
  });
}
