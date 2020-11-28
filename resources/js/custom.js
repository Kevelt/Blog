require('./glide');
import bsCustomFileInput from 'bs-custom-file-input';

$(document).ready(function(){
    bsCustomFileInput.init();

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
            if($('.form-message').length) {
                $('.form-message').text(message);
            }
            else{
                alert(message);
            }
        }
    }

    const formConfirm = (functionOnConfirm, messageConfirmBtn, messageConfirm = 'Success', messageCancelBtn = 'No, cancel!', messageCancel = '') => {
        try {
            const SwalMessage = Swal.mixin({
                customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });
            SwalMessage.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: messageConfirmBtn,
                cancelButtonText: messageCancelBtn,
                reverseButtons: true,
                showLoaderOnConfirm: true,
                preConfirm: functionOnConfirm,
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    formMessage(messageConfirm, 'success');
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    if(messageCancel !== '') {
                        formMessage(messageCancel, 'warning');
                    }
                }
            });
        } catch (error) {
            const confirmAlert = confirm("Are you sure? You won't be able to revert this!");
            if (confirmAlert == true) {
                functionOnConfirm().then((result) => {
                    if(result) {
                        formMessage(messageConfirm, 'success');
                    }
                });
            } else {
                if(messageCancel !== '') {
                    formMessage(messageCancel, 'warning');
                }
            }
        }
    }

    const deleteRegister = (actionUrl, table, row) => {
        const functionOnConfirm = async () => {
            return fetch(actionUrl)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText);
                    }
                    table.row(row).remove().draw();
                    return response.json();
                })
                .catch(error => {
                    formMessage(error, 'error');
                })
        }
        formConfirm(functionOnConfirm, 'Yes, delete it!', 'Deleted! Your file has been deleted.');
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

        const files = form.find('.custom-file-input--img');
        for (const file of files) {
            data[file.name] = await arrayImgConvert(file.files);
        }

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: data,
            success: function(response){
                if(response) {
                    if(response.success && (form.attr('noreset') !== 'true')) {
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

    $( ".customform" ).on("submit", function( event ) {
        event.preventDefault();
        $('.invalid-feedback').text('');
        $('.form-message').text('');
        $('.is-invalid').removeClass('is-invalid');
        formSendAjax($(this));
    });

    $( ".delete-ajax" ).on("click", function( event ) {
        event.preventDefault();
        deleteRegister(this.href, $(this).parents('table').DataTable(), $(this).parents('tr'));
    });

    try {
        if (!$.fn.DataTable.isDataTable( '.datatable' )) {
            $('.datatable').DataTable({
                dom: 'lBfrtip',
                buttons: [
                    'copy', 'excel', 'pdf'
                ]
            });
        }
    } catch (error) {}

    const imgNone = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAg0AAAGlCAIAAAD23VLdAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNS1jMDIxIDc5LjE1NTc3MiwgMjAxNC8wMS8xMy0xOTo0NDowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTQgKFdpbmRvd3MpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOkUxQTQyRkMyRkNCMjExRTM5NTU4OTZEQkJFNzU1OEY1IiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOkUxQTQyRkMzRkNCMjExRTM5NTU4OTZEQkJFNzU1OEY1Ij4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6RTFBNDJGQzBGQ0IyMTFFMzk1NTg5NkRCQkU3NTU4RjUiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6RTFBNDJGQzFGQ0IyMTFFMzk1NTg5NkRCQkU3NTU4RjUiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz7hkGSKAAAPo0lEQVR42uzd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';
    document.querySelectorAll('img').forEach((img) => {
        img.onerror = function() {
            this.src = imgNone;
        }
        if(!img.src) {
            img.src = imgNone;
        }
    });

    async function previewImg(img, name) {
        var imgTemp = await arrayImgConvert(img);
        $('#'+name).attr('src', imgTemp[0]);
    }
    $( ".custom-file-input--img-preview" ).on("change", function() {
        previewImg(this.files, this.name + '_img');
    });
});
