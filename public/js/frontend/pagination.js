$(window).on('hashchange', function() {
    if (window.location.hash) {
        var page = window.location.hash.replace('#', '');
        if (page == Number.NaN || page <= 0) {
            return false;
        } else {
            getreviewInformation(page);
        }
    }
});

function getreviewInformation(paramPage) {
    $.ajax({
        data: {page: paramPage},
    }).done(function(data) {
        $('#product-reviews').html(data);
        $('.detail-rating').rating({step: 1, stars: 5, showCaption:false, showClear:false});
        $('.rating-loading').rating({step: 1, stars: 5, showCaption:false, showClear:false});
        $('#frontend-review-indicator').addClass('hide');
    }).fail(function() {
        $('#frontend-review-indicator').addClass('hide');
        alert('Posts could not be loaded.');
    });
}

$(document).ready(function() {
    $(document).on('click', '#frontend-review-paginate .pagination a', function(e) {
        getreviewInformation(this.text);
        $('#frontend-review-paginate .pagination').find('li').removeClass('active');
        $(this).parent().addClass('active');
        $('#frontend-review-indicator').removeClass('hide');
        e.preventDefault();
    });
    // Show form review
    $(document).on('click', '.rating-button', function(){
        $(".wrap-form-rating-review").show(300);
        $(".rating-button").hide();
    });

    $('#star-main').rating({ step: 1, stars: 5, displayOnly: true});
    $('#star-main2').rating({ step: 1, stars: 5, showCaption: false, showClear: false});
    $('.wrap-form-rating-review .form-reviews .caption').addClass('hide');
    $('.wrap-form-rating-review .form-reviews .clear-rating').addClass('hide');

    $(document).on('change', '#star-main2', function(){
        $(".rating-star-hint").css({
            display: 'none'
        });
        $("div").removeClass("div-overlap-active");
    });

    $(document).on('click', '.rating-send-form', function(e){
        var medicine_id = $(this).attr('data-medicine-id');
        var param_star_main = $('.wrap-form-rating-review #star-main2').val();
        var param_review_title = $('.wrap-form-rating-review #review-title').val();
        var param_review_content = $('.wrap-form-rating-review #review-content').val();

        if (!param_star_main || !param_review_content || !param_review_title) {
            var errorTitle = '';
            if (!param_star_main) errorTitle += 'You have not selected stars!\n';
            if (!param_review_title) errorTitle += 'You have not entered title!\n';
            if (!param_review_content) errorTitle += 'You have not entered content!\n';
            swal('Error!', errorTitle, 'error');

            return;
        }

        var alertText = 'You have rated this medicine as ' + param_star_main + ' stars.\n';
        alertText += 'Title: " ' + param_review_title + ' "\n';
        alertText += 'Content: " ' + param_review_content + ' "\n';

        swal({
            title: 'Here is your review!',
            text: alertText,
            type: 'info',
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, function () {
            var paramUrl = '/detail/' + medicine_id + '/review';

            var tokenParam = $('meta[name=_token]').attr('content');
            $.ajaxSetup({
               headers: { 'X-CSRF-Token' : tokenParam }
            });
            var params = {
                star_main: param_star_main,
                review_title: param_review_title,
                review_content: param_review_content
            };
            
            var request = $.ajax({method: 'POST', url: paramUrl, data: params});
            request.done(function(data){
                $('#product-reviews').html(data);
                $('.detail-rating').rating({step: 1, stars: 5, showCaption:false, showClear:false});
                $('.rating-loading').rating({step: 1, stars: 5, showCaption:false, showClear:false});
                swal('Successfully!', 'Thank you for submitting a medicine review!', 'success');
            });
            request.fail(function(jqXHR, textStatus){
                swal('Error!', 'You can not submit this review!', 'error');
            });
        });
    });
});
