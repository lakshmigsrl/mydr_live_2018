<div id="grade-template" style='display: none;'>
    <div id="slideDiv_x_">
        <h3>Slide_heading <a href="#" class="removeSlide"
           onclick="$('#slideDiv_x_').remove(); ctrSlide = $('#ctrSlide').val(); ctrSlide--; $('#ctrSlide').val(ctrSlide); return false;" style='font-size: 14px; font-weight: normal;'>Remove</a></h3>
          <label>title</label>
          <input type="text" name="section_slides[_x_][title]" class="slide-title linoclass form-control" required="required" value="">
          <label>url</label>
          <input type="text" name="section_slides[_x_][url]" class="slide-title linoclass form-control" value="">
          <label>body</label>
          <input type="text" name="section_slides[_x_][body]" class="linoclass form-control" value="">
          <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 ">
                  <label>Main Image</label>
                </div>
                <div class="col-xs-6 col-sm-4 col-md-2 ">
                  <img src="" class="slidePreview__x_" style="padding: 6px; width: 100%;">
                </div>
                <div class="col-xs-6 col-sm-8 col-md-8 ">
                  <a onclick="selectFileWithCKFinder('main_image_x_', 'slidePreview__x_');" class="button-a button-a-background">Browse Images</a>
                  <input type="text" id="main_image_x_" name="section_slides[_x_][main_image]" class="slidePreview linoclass form-control" required="required" value="">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 ">
                  <hr />
                </div>
          </div>
    </div>
</div>
