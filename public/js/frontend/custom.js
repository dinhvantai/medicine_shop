function clickLogoutForm(selectorID, textCormfirm) {
    swal({
        title: textCormfirm,
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

function str_slug(str)
{
    str = str.toLowerCase();     
 
    // xóa dấu
    str = str.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, 'a');
    str = str.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, 'e');
    str = str.replace(/(ì|í|ị|ỉ|ĩ)/g, 'i');
    str = str.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, 'o');
    str = str.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, 'u');
    str = str.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, 'y');
    str = str.replace(/(đ)/g, 'd');
 
    // Xóa ký tự đặc biệt
    str = str.replace(/([^0-9a-z-\s])/g, '');
 
    // Xóa khoảng trắng thay bằng ký tự -
    str = str.replace(/(\s+)/g, '-');
 
    // xóa phần dự - ở đầu
    str = str.replace(/^-+/g, '');
 
    // xóa phần dư - ở cuối
    str = str.replace(/-+$/g, '');
 
    // return
    return str;
}

var SearchMedicineViewModel = function()
{
    var self = this;

    self.urlSearch = '/search/json';
    self.searchItems = ko.observableArray([]);
   
    self.searchHeaderMedicine = function(object, event)
    {
        var paramKeyword = event.target.value;

        var params = {keyword: paramKeyword};
        var request = $.ajax({method: "GET", url: self.urlSearch, data: params});

        request.done(function(data){
            self.searchItems(data);
        });

        $('#over-header-full-screen').removeClass('hide');
        $('#search-header-medicine-result').removeClass('hide');
    }

    self.closeHeaderMedicineResult = function(data, event)
    {
    	$('#search-header-medicine-result').addClass('hide');
    	$('#over-header-full-screen').addClass('hide');
    }
}

ko.applyBindings(
    new SearchMedicineViewModel(),
    document.getElementById('area-search-header-form-id')
);

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

function confirmBeforeSubmit(selectorID, element) {
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
        request.fail(function(jqXHR, textStatus){
            swal('Error!', 'You can not resend email for this order!', 'error');
        });
    });
}
