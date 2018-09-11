// /**
//  * Created by ayumi on 10/05/2016.
//  */
// var editor = CKEDITOR.replace( 'blurb' );
// CKFinder.setupCKEditor( editor );
CKEDITOR.replace( 'profile', {
    filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
    filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    filebrowserWindowWidth: '1000',
    filebrowserWindowHeight: '700'
} );


var button1 = document.getElementById( 'ckfinder-modal-1' );

button1.onclick = function() {
    selectFileWithCKFinder( 'main_image' );
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