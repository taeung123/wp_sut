import Sortable from 'sortablejs';
import 'bootstrap';
import {
    notify
}
from 'vicoders/services';

(function($) {
    if ($('.all-inp').length > 0) {
        $('.all-inp').click(function(){
            var checked_all = $('.all-inp:checked').length;
            var checkbox = $('input[name*="id_contact_row"]');
            checkbox.each(function(index, element){
                if(checked_all) {
                    $(element).prop('checked', true);
                } else {
                    $(element).prop('checked', false);
                }
            });
        });
    }
    function toggle(source) {
    }
    if ($('body').hasClass('wp-admin')) {
        let IMAGE_UPLOAD_BTN_CLASSNAME = 'nto-image-upload-btn';
        let IMAGE_REMOVE_ITEM_CLASSNAME = 'nto-image-remove';
        let GALLERY_UPLOAD_BTN_CLASSNAME = 'nto-gallery-upload-btn';
        let GALLERY_SORTABLE_CLASSNAME = 'nto-items';
        let GALLERY_REMOVE_ITEM_CLASSNAME = 'nto-gallery-remove';

        $(document).on('click', `.${IMAGE_UPLOAD_BTN_CLASSNAME}`, function(event) {
            var input = $(event.target);
            var url;
            var uploader = wp.media.frames.file_frame = wp.media({
                title: 'Choose Image',
                button: {
                    text: 'Choose Image'
                },
                multiple: false
            });
            uploader.on('select', function() {
                uploader.state().get('selection').models.forEach(function(item) {
                    let attachment = item.toJSON();
                    input.parent().parent().find('.card-img-top').attr('src', attachment.url);
                    input.parent().parent().find(`[name="${input.attr('data-input')}"]`).val(attachment.url);
                });
            });
            uploader.open();
            return false;
        });

        $(document).on('click', `.${GALLERY_UPLOAD_BTN_CLASSNAME}`, function(event) {
            var input = $(event.target);
            var url;
            var uploader = wp.media.frames.file_frame = wp.media({
                title: 'Choose Image',
                button: {
                    text: 'Choose Image'
                },
                multiple: true
            });
            uploader.on('select', function() {
                input.parent().parent().find('.nto-gallery-item').remove();
                let defaultImg = input.parent().parent().find('.nto-items').attr('data-img');
                let items = [];
                uploader.state().get('selection').models.forEach(function(item) {
                    let attachment = item.toJSON();
                    items.push({
                        url: attachment.url,
                    });
                    let img = document.createElement('li');
                    img.className = 'nto-gallery-item';
                    img.innerHTML = `<img src="${defaultImg}" style="background-image: url('${attachment.url}')" data-src="${attachment.url}">`;
                    input.parent().parent().find('.nto-items').append(img);
                    input.parent().parent().find('.input-value').val(JSON.stringify(items));
                });
            });
            uploader.open();
            return false;
        });

        $(document).on('click', `.meta-data`, function() {
            let target = $(event.target);
            let el = target.parent().parent().parent().parent().find('.meta-data-modal');
            el.modal('show');
            el.on('shown.bs.modal', function() {
                let url = target.prev().attr('data-src');
                el.attr('data-url', url);
                let value = JSON.parse(target.parent().parent().parent().find('.input-value').val());
                if (value !== undefined) {
                    let item = value.find(i => i.url == url);
                    el.find('.meta').val('');
                    if (item.meta !== undefined) {
                        for (let k in item.meta) {
                            el.find(`[name="${k}"]`).val(item.meta[k]);
                        }
                    }
                }
            });
        });

        $(document).on('click', `.nto-save-meta`, function() {
            let target = $(event.target);
            let el = target.parent().parent().parent().parent();
            let url = el.attr('data-url');
            let value = JSON.parse(el.parent().find('.input-value').val());
            if (value !== undefined) {
                let item = value.find(i => i.url == url);
                if (item !== undefined) {
                    el.find('.meta').each(function(k, i) {
                        if (item.meta === undefined) {
                            item.meta = {};
                        }
                        item.meta[$(i).attr('name')] = $(i).val();
                    });
                }
            }
            el.parent().find('.input-value').val(JSON.stringify(value));
            el.modal('hide');

        });

        $(document).on('click', `.${IMAGE_REMOVE_ITEM_CLASSNAME}`, remove);
        $(document).on('click', `.${GALLERY_REMOVE_ITEM_CLASSNAME}`, remove);

        function remove(event) {
            var input = $(event.target);
            let cf = confirm('Are you sure you want to delete all items');
            if (cf !== false) {
                var url = new URL(document.location.href);
                var tab = url.searchParams.get('tab');
                var data = {
                    'action': 'nto_remove',
                    'field': input.attr('data-input'),
                    'page': tab
                };
                $.post(ajaxurl, data, function(response) {
                    document.location.href = response.redirect_url;
                });
            }
            return false;
        };

        $(`.${GALLERY_SORTABLE_CLASSNAME}`).each(function(key, item) {
            var gallery_sortable = new Sortable(item, {
                animation: 150,
                onUpdate: function(evt) {
                    let items = [];
                    $(evt.srcElement).find('.nto-gallery-item').each(function(k, i) {
                        items.push({
                            url: $(i).find('img').attr('data-src'),
                        });
                        $(evt.srcElement).parent().find('input').val(JSON.stringify(items))
                    });
                }
            });
        });

        $(document).on('change', `.custom-select`, function() {
            var attr_id = $(this).attr('attr-id');
            var status = $(this).val();
            $.ajax({
                    method: 'POST',
                    url: ajax_obj.ajax_url,
                    data: {
                        action: 'change_status_record_contact',
                        id: attr_id,
                        status: status
                    },
                })
                .done((response) => {
                    notify.show('success', response.data.message, 5000)
                })
                .fail(() => {
                    notify.show('warning', response.data.message, 5001);
                });
        });
        $(document).on('click', `.delete-item`, function() {
            var confirm_t = confirm("Bạn có chắc muốn xóa bản ghi này!");
            if (confirm_t == true) {
                var id = $(this).attr('id');
                $.ajax({
                        method: 'POST',
                        url: ajax_obj.ajax_url,
                        data: {
                            action: 'delete_record_contact',
                            id: id
                        },
                    })
                    .done((response) => {
                        if (response.data.status == 1) {
                            notify.show('success', response.data.message, 5000);
                            self.location.reload();
                        } else {
                            notify.show('warning', response.data.message, 5000);
                        }
                    })
                    .fail(() => {
                        notify.show('warning', response.data.message, 5000);
                    });
            }
        });
        $(document).on('click', `.export-btn`, function() {
            var confirm_t = confirm("Are you sure export all records to csv file !");
            if (confirm_t == true) {
                var page = $(this).attr('data-page');
                var name = $(this).attr('data-name');
                $.ajax({
                        method: 'POST',
                        url: ajax_obj.ajax_url,
                        data: {
                            action: 'export_record_contact',
                            page: page,
                            name: name
                        },
                    })
                    .done((response) => {
                        if (response.data.status == 1) {
                            notify.show('success', response.data.message, 5000);
                        } else {
                            notify.show('warning', response.data.message, 5000);
                        }
                        if (response.data.status == 1 && response.data != null) {
                            window.location.replace(response.data.path);
                        }
                    })
                    .fail(() => {
                        notify.show('warning', response.data.message, 5000);
                    });
            }
        });

        $(document).on('click', `.send_email_single`, function() {
            var email_template = $('.html_template_inp').val();
            var subject = $('.subject-inp').val();
            var ids_ct_form = [];
            var page = $(this).attr('data-page');
            var name = $(this).attr('data-name');
            if (email_template === '' || subject === '') {
                alert('Please, choose email template and fill email subject input !');
                return false;
            }
            if ($('input[name="id_contact_row[]"]:checked').length > 0) {
                $('input[name="id_contact_row[]"]:checked').each(function(index, ele) {
                    ids_ct_form.push($(ele).attr('data-id'));
                });
            }
            if (ids_ct_form.length <= 0) {
                alert('No row selected!');
                return false;
            }
            $.ajax({
                    method: 'POST',
                    url: ajax_obj.ajax_url,
                    data: {
                        action: 'send_bulk_email',
                        ids: ids_ct_form,
                        page: page,
                        name: name,
                        email_template: email_template,
                        subject: subject
                    },
                })
                .done((response) => {
                    if (response.data.status == 1) {
                        notify.show('success', response.data.message, 5000);
                    } else {
                        notify.show('warning', response.data.message, 5000);
                    }
                })
                .fail(() => {
                    notify.show('warning', response.data.message, 5000);
                });
        });
        $(document).on('click', `.send_email_all`, function() {
            var email_template = $('.html_template_inp').val();
            var subject = $('.subject-inp').val();
            var ids_ct_form = [];
            var page = $(this).attr('data-page');
            var name = $(this).attr('data-name');
            if (email_template === '' || subject === '') {
                alert('Please, choose email template and fill email subject input !');
                return false;
            }
            $.ajax({
                    method: 'POST',
                    url: ajax_obj.ajax_url,
                    data: {
                        action: 'send_all_email',
                        page: page,
                        name: name,
                        email_template: email_template,
                        subject: subject
                    },
                })
                .done((response) => {
                    if (response.data.status == 1) {
                        notify.show('success', response.data.message, 5000);
                    } else {
                        notify.show('warning', response.data.message, 5000);
                    }
                })
                .fail(() => {
                    notify.show('warning', response.data.message, 5000);
                });
        });
    }
})(jQuery)