jQuery(document).ready(function ($) {
   let mediaUploader;

   $('#upload-button').on('click',function (e) {
       e.preventDefault();
       if (mediaUploader){
           mediaUploader.open();
           return;
       }
       mediaUploader = wp.media.frames.file_frame = wp.media({
            title : 'Choose a Profile Picture',
           button:{
                text:'Choose Picture'
           },
           multiple:false
       });

       mediaUploader.on('select',function () {
           attachment = mediaUploader.state().get('selection').first().toJSON();
           $('#profile-picture').val(attachment.url);
           $('#profile-picture-preview').css('background-image','url(' + attachment.url + ')');
       });

       mediaUploader.open();
   });
   
   $('#remove-picture').on('click',function (e) {
       e.preventDefault();
       let answer = confirm('Are U sure to remove your Profile Picture?');

       if (answer == true){
           $('#profile-picture').val('');
           $('.sunset-general-form').submit();
       }
        return;
   });
});