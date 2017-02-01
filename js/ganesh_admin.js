jQuery(document).ready(function($){
	/*var mediaUploader;
	$('#upload-button').on('click', function(e){
		e.preventDefault();	

		if( mediaUploader ){
			mediaUploader.open();
			return;
		}
		mediaUploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose a Profile Picture',
			button: {
				text : 'Choose Picture'
			},
			multiple : false
		});

		mediaUploader.on('select', function() {
			attachment = mediaUploader.state().get('seletion').first().toJSON();
			$('#profile-picture').val(attachment.url);
		});

		mediaUploader.open();
	});
*/
    var custom_uploader;

    $('#upload-button').click(function(e) {
 
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#profile-picture').val(attachment.url);
            $('#profile-picture-preview').css('background-image', 'url('+attachment.url+')');
        });
 
        //Open the uploader dialog
        custom_uploader.open(); 
    });

    $('#remove-picture').on('click', function(e){
            e.preventDefault();
            var ans = confirm("Are you sure you want to delete profile picture?");
            if(ans == true){
                $('#profile-picture').val('');
                $('.ganesh-general-form').submit();
            }
            return;
    });
});