// upload field
jQuery(document).ready(function () {
    var $ = jQuery;
    //var btnUpload = $('.msc-upload-btn');
    $(document).on('click', '.msc-upload-btn', function(){
        var $this = $(this);
        var input = $this.siblings('.msc-upload-input');
        var preview = $this.siblings('.media-widget-control').find('.media-widget-preview');
        var url;
        var uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
        uploader.on('select', function(){
            attachment = uploader.state().get('selection').first().toJSON();
            url = attachment.url;
            input.attr('value', url);
            preview.empty();
            preview.append('<img class="attachment-thumb" src="' + url + '" alt="" />');
        });
        uploader.open();
        return false;
    });
});