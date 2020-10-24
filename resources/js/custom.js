$(document).ready(function(){

    const formMessage = (message, type = 'info') => {
        try {
            const SwalMessage = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            SwalMessage.fire({
                icon: type,
                title: message
            });
        } catch (error) {
            if($('.form-message')) {
                $('.form-message').text(message);
            }
        }
    }

    const toBase64 = file => new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
    });

    async function imgToBase64(file) {
        const result = await toBase64(file).catch(e => Error(e));
        if(result instanceof Error) {
            console.log('Error: ', result.message);
            return;
        }
        return result;
    }

    var resizeImage = function (settings) {
        var file = settings.file;
        var maxSize = settings.maxSize;
        var reader = new FileReader();
        var image = new Image();
        var canvas = document.createElement('canvas');
        var dataURItoBlob = function (dataURI) {
            var bytes = dataURI.split(',')[0].indexOf('base64') >= 0 ?
                atob(dataURI.split(',')[1]) :
                unescape(dataURI.split(',')[1]);
            var mime = dataURI.split(',')[0].split(':')[1].split(';')[0];
            var max = bytes.length;
            var ia = new Uint8Array(max);
            for (var i = 0; i < max; i++)
                ia[i] = bytes.charCodeAt(i);
            return new Blob([ia], { type: mime });
        };
        var resize = function () {
            var width = image.width;
            var height = image.height;
            if (width > height) {
                if (width > maxSize) {
                    height *= maxSize / width;
                    width = maxSize;
                }
            } else {
                if (height > maxSize) {
                    width *= maxSize / height;
                    height = maxSize;
                }
            }
            canvas.width = width;
            canvas.height = height;
            canvas.getContext('2d').drawImage(image, 0, 0, width, height);
            var dataUrl = canvas.toDataURL('image/jpeg');
            return dataUrl;//dataURItoBlob(dataUrl);
        };
        return new Promise(function (ok, no) {
            if (!file.type.match(/image.*/)) {
                no(new Error("Not an image"));
                return;
            }
            reader.onload = function (readerEvent) {
                image.onload = function () { return ok(resize()); };
                image.src = readerEvent.target.result;
            };
            reader.readAsDataURL(file);
        });
    };

    async function arrayImgConvert(arrayImg) {
        let arrayResult = [];
        for (const file of arrayImg) {
            const config = {
                file: file,
                maxSize: 450
            };
            const resizedImage = await resizeImage(config);
            arrayResult.push(resizedImage);
        }
        return arrayResult;
    }

    async function formSendAjax(form) {
        var data = {};
        $.each(form.serializeArray(), function(i, v) {
            data[v.name] = v.value;
        });

        const files = form.find('.custom-file-input');
        for (const file of files) {
            data[file.name] = await arrayImgConvert(file.files);
        }

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: data,
            success: function(response){
                if(response) {
                    if(response.success) {
                        form[0].reset();
                    }
                    formMessage(response.message, response.success ? 'success' : 'warning');
                }
            },
            error: function (data) {
                var response = $.parseJSON(data.responseText);
                if (response.errors) {
                    $.each(response.errors, function (key, value) {
                        $('#' + key).addClass('is-invalid').next().html("<strong>" + value.join("<br />") + "</strong>");
                    });
                    formMessage(response.message, 'warning');
                } else {
                    formMessage('Error', 'error');
                }
            }
        });
    }

    $('.customform').submit(function( event ) {
        event.preventDefault();
        $('.invalid-feedback').text('');
        $('.form-message').text('');
        $('.is-invalid').removeClass('is-invalid');
        formSendAjax($(this));
    });

    if (!$.fn.DataTable.isDataTable( '.datatable' )) {
        $('.datatable').DataTable({
            dom: 'lBfrtip',
            buttons: [
                'copy', 'excel', 'pdf'
            ]
        });
    }
});
