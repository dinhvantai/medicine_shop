function showTinyWithFileManager(paramSelector)
{
    tinymce.init({
        theme: "modern",
        selector: paramSelector,
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking spellchecker",
            "table contextmenu directionality emoticons paste textcolor"
        ],
        relative_urls: false,

        filemanager_title:"Responsive Filemanager",
        external_filemanager_path:"/bower_components/responsive-filemanager/filemanager/",
        external_plugins: { "filemanager" : "/bower_components/responsive-filemanager/filemanager/plugin.min.js"},

        image_advtab: true,
        toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
        toolbar2: " | image | media | link unlink anchor | print preview"
    });
}

function showSimpleTinyWithFileManager(paramSelector)
{
    tinymce.init({
        theme: "modern",
        selector: paramSelector,
        plugins: [
            "advlist autolink link image lists charmap preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking spellchecker",
            "table contextmenu directionality emoticons paste textcolor"
        ],
        relative_urls: false,

        filemanager_title:"Responsive Filemanager",
        external_filemanager_path:"/bower_components/responsive-filemanager/filemanager/",
        external_plugins: { "filemanager" : "/bower_components/responsive-filemanager/filemanager/plugin.min.js"},
    });
}

function confirmButtonBeforeSubmit(element)
{
    swal({
        title: $(element).attr('data-text'),
        type: 'info',
        showCancelButton: true,
        confirmButtonClass: 'btn-danger',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
    },
    function(isConfirm) {
        if (!isConfirm) return false;
        $(element).parent().submit();
    });
}

function confirmBeforeSubmit(selectorID, element)
{
    swal({
        title: $(element).attr('data-text'),
        type: 'info',
        showCancelButton: true,
        confirmButtonClass: 'btn-danger',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
    },
    function(isConfirm) {
        if (!isConfirm) return false; 
        $(selectorID).submit();
    });
}

function resendEmailOrder(paramOrderId, element)
{
    swal({
        title: $(element).attr('data-text'),
        type: "info",
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true
    }, function () {
        var paramUrl = '/order/resend/email';

        var tokenParam = $('meta[name=_token]').attr('content');
        $.ajaxSetup({
           headers: { 'X-CSRF-Token' : tokenParam }
        });
        var params = {order_id: paramOrderId};
        
        var request = $.ajax({method: 'POST', url: paramUrl, data: params});
        request.done(function(data){
            if (data.status) {
                swal('Successfully!', data.message, 'success');
            } else {
                swal('Error!', data.message, 'error');
            }
        });
    });
}
