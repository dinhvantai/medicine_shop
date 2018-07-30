$(document).ready(function(){
    $('.carousel-product').slick({
        variableWidth: true,
        infinite:true,
        slidesToShow: 4,
        autoplay: true,
        autoplaySpeed: 1200,
    });
    $("header").sticky({
        zIndex:1
    });

    $('#input-reliable').on('rating.change', function(event, value, caption) {
        $('#hidden-reliable').val(value);
    });

    $('#input-quality').on('rating.change', function(event, value, caption) {        // return $medicine_name->name
        $('#hidden-quality').val(value);
    });

    $('#attachfile').click(function () {
        $("#edit_photo").trigger('click'); // or triggerHandler or click()
    });
    
    //Show form contact
    $(".send-email-circle").click(function(){
        $(".contact-content").show().animate({
            display: 'block',
            top:'-100px',
            opacity:'1',
        },'slow');
    });
    // preview images
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();            
            reader.onload = function (e) {
                $('#image_target').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#edit_photo").change(function(){
        readURL(this);
    });

    $('.home-rating-star').rating({step: 1, stars: 5, showCaption:false, showClear:false});
});

$(document).on('click', '.add-to-box2', function(){
    $.ajax({
        url : window.location.origin + '/detail/add-to-box',
        type : 'get',
        dateType: 'text',
        context: this,
        data : {
            medicine_id: $(this).attr('medicine_id'),
            user_id: $(this).attr('user_id')
        },
        success : function (result){
            $('.modal-body p').text(result);
        }
    });
});
$(document).on('click', '.detail-link', function(){
    $.ajax({
        url : window.location.origin + '/detail/add-to-box',
        type : 'get',
        dateType: 'text',
        context: this,
        data : {
            medicine_id: $(this).attr('medicine_id'),
            user_id: $(this).attr('user_id')
        },
        success : function (result){
            $('.modal-body p').text(result);
        }
    });
});
$(document).on('click', '.user-change-password', function(){
    var emptyNoti = function() {
        $('.noti-old-password').text('');
        $('.noti-new-password').text('');
        $('.noti-confirm-password').text('');
    }

    $('#change-password-indicator').removeClass('hide');
    $('.change-password-notification').text('');
    $('.change-password-notification').removeClass('alert alert-success alert-dismissible');
    emptyNoti();
    
    var dataParam = {};
    dataParam.old_password = $('.data-old-password').val();
    dataParam.new_password = $('.data-new-password').val();
    dataParam.confirm_password = $('.data-confirm-password').val();

    var tokenParam = $('meta[name=_token]').attr('content');
    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : tokenParam }
    });
    $.ajax({
        url : window.location.origin + '/user/change-password',
        type : 'post',
        data: dataParam,
        success : function (result){
            if (result.error.status) {
                $('.noti-old-password').text(result.error.old_password);
                $('.noti-new-password').text(result.error.new_password);
                $('.noti-confirm-password').text(result.error.confirm_password);
            } else {
               emptyNoti();
                $('.change-password-notification').addClass('alert alert-success alert-dismissible')
                $('.change-password-notification').text(result.message);
            }
            $('#change-password-indicator').addClass('hide');
        },
        error : function (result){
            var errors = result.responseJSON;
            $('#change-password-indicator').addClass('hide');
        }

    });
});
// slide product
$(document).ready(function() {
    $('#Carousel').carousel({
        interval: 4000
    })
});

$(document).on('click', '.add-medicine-to-box', function(){
    $.ajax({
        url : window.location.origin + '/detail/add-to-box',
        type : 'get',
        dateType: 'text',
        context: this,
        data : {
            medicine_id: $(this).attr('medicine_id')
        },
        success : function (result){
            $(".span-heart").html(result);
        }
    });
});
