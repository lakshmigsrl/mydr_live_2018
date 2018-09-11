// /**
//  * Created by ayumi on 10/05/2016.
//  */
// var editor = CKEDITOR.replace( 'blurb' );
// CKFinder.setupCKEditor( editor );

CKEDITOR.replace( 'abstract', {
    // filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
    // filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    filebrowserWindowWidth: '1000',
    filebrowserWindowHeight: '700',
    customConfig: '/ckeditor/config_abstract.js'

} );
CKEDITOR.replace( 'body', {
    filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
    filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    filebrowserWindowWidth: '1000',
    filebrowserWindowHeight: '700'
} );


var button1 = document.getElementById( 'ckfinder-modal-1' );
var button2 = document.getElementById( 'ckfinder-modal-2' );

button1.onclick = function() {
    selectFileWithCKFinder( 'main_image' );
};
button2.onclick = function() {
    selectFileWithCKFinder( 'page_image' );
};

function selectFileWithCKFinder( elementId ) {
    CKFinder.modal( {
        chooseFiles: true,
        width: 800,
        height: 600,
        onInit: function( finder ) {
            finder.on( 'files:choose', function( evt ) {
                var file = evt.data.files.first();
                var output = document.getElementById( elementId );
                output.value = file.getUrl();
            } );

            finder.on( 'file:choose:resizedImage', function( evt ) {
                var output = document.getElementById( elementId );
                output.value = evt.data.resizedUrl;
            } );
        }
    } );
    return false;
}


function ajax_add_to_homeslide(article_id, title, body, target){
      $.ajax({
          type:'POST',
          url:'/admin/articles/add_to_home_slide',
          data:'article_id='+article_id+'&title='+title+'&body='+body,
          success:function(msg){
              if(msg == 'err'){
                  alert('Some problem occured, please try again.');
              }else{
                  $('#'+target).html(msg);
              }
          }
      });
}

$(document).ready(function() {

    $('.button-checkbox').each(function () {

            // Settings
            var $widget = $(this),
                $button = $widget.find('button'),
                $checkbox = $widget.find('input:checkbox'),
                color = $button.data('color'),
                settings = {
                    on: {
                        icon: 'glyphicon glyphicon-check'
                    },
                    off: {
                        icon: 'glyphicon glyphicon-unchecked'
                    }
                };

            // Event Handlers
            $button.on('click', function () {
                $checkbox.prop('checked', !$checkbox.is(':checked'));
                $checkbox.triggerHandler('change');
                updateDisplay();
            });
            $checkbox.on('change', function () {
                updateDisplay();
            });

            // Actions
            function updateDisplay() {
                var isChecked = $checkbox.is(':checked');

                // Set the button's state
                $button.data('state', (isChecked) ? "on" : "off");

                // Set the button's icon
                $button.find('.state-icon')
                    .removeClass()
                    .addClass('state-icon ' + settings[$button.data('state')].icon);

                // Update the button's color
                if (isChecked) {
                    $button
                        .removeClass('btn-default')
                        .addClass('btn-' + color + ' active');
                }
                else {
                    $button
                        .removeClass('btn-' + color + ' active')
                        .addClass('btn-default');
                }
            }

            // Initialization
            function init() {

                updateDisplay();

                // Inject the icon if applicable
                if ($button.find('.state-icon').length == 0) {
                    $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
                }
            }
            init();
        });

});
