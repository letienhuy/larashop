/*
 * Created on Sun Nov 26 2017
 * Copyright (c) 2017 Huy Le Tien
 * Version 1.0.0
 */

var baseUrl = $('head base').attr('href');
$('.product-tab-rate').ready(function() {
    var productId = $('.product-tab-rate').data('id');
    var rateSkip = 0;
    var rateTake = 10;
    loadRate(productId, rateSkip, rateTake);
    $('#load-more-rate').click(function() {
        var total = $(this).data('total');
        var element = this;
        rateSkip += rateTake;
        total -= commentSkip;
        $('<div/>').addClass('loading').appendTo(element);
        $('#load-more-rate button').remove();
        loadRate(productId, rateSkip, rateTake);
        if (total > 0)
            $('<button/>').html('Xem thêm ' + total + ' đánh giá...').appendTo(element);
    });
});
$('.product-tab-comment').ready(function() {
    var productId = $('.product-tab-comment').data('id');
    var commentSkip = 0;
    var commentTake = 5;
    loadComment(productId, commentSkip, commentTake);
    $('#load-more-comment').click(function() {
        var total = $(this).data('total');
        var element = this;
        commentSkip += commentTake;
        total -= commentSkip;
        $('<div/>').addClass('loading').appendTo(element);
        $('#load-more-comment button').remove();
        loadComment(productId, commentSkip, commentTake);
        if (total > 0)
            $('<button/>').html('Xem thêm ' + total + ' bình luận...').appendTo(element);
    });

    $(document).on('click', '.product-tab-comment__content-reply [id]', function(event) {
        if ($(event.target).is("button")) {
            var commentId = $(this).attr('id').split('-').pop();
            var replySkip = $('#reply-comment-' + commentId + ' .product-tab-comment__content-reply__list').length;
            var replyTake = 5;
            var total = $(this).data('total') - replySkip;
            console.log();
            $('<div/>').addClass('loading').appendTo(this);
            $('#load-more-reply-' + commentId + ' button').remove();
            loadReplyComment(commentId, replySkip, replyTake);
            if (total > 0)
                $('<button/>').html('Xem thêm ' + total + ' trả lời...').appendTo(this);
        }
    });

});

$(document).on('submit', function(event) {
    event.preventDefault();
    var _this = $(event.target);
    var token = _this.children('input').val();
    var comment = _this.children('textarea').val();
    var commentId = _this.attr('id').split('-')[3]; //form-reply-comment-(num)
    var productId = _this.data('id');
    var url = baseUrl + '/product/' + productId + '/comments/add';
    if (_this.attr('id') === 'edit-comment') {
        url = baseUrl + '/comment/' + productId + '/edit';
    }
    if ($.isNumeric(commentId)) {
        url = baseUrl + '/product/' + productId + '/comments/' + commentId + '/replies/add';
    }
    if (comment === "") {
        _this.children('.validation').text('Vui lòng nhập nội dung!').addClass('validation-error').show().fadeOut(3000);
        return;
    }
    $.ajax({
        url: url,
        type: "POST",
        data: { '_token': token, 'comment': comment },
        success: function(result) {
            _this.children('textarea').val("");
            location.reload();
        },
        error: function() {
            _this.children('.validation').text('Lỗi không thể đăng bình luận!').addClass('validation-error').show().fadeOut(3000);
            return;
        }
    });
});

function openReply(id) {
    var reply = 'reply-' + id.split('-')[1];
    $('#' + reply).toggle("blind");
}

function loadComment(productId, skip, take) {
    $.ajax({
        url: baseUrl + '/product/' + productId + '/comments/' + skip + '/' + take,
        dataType: "JSON",
        type: "GET",
        success: function(result) {
            $('#product-tab-comment').append(result["html"]);
            $('.loading').remove();
            $(result["html"]).find('.product-tab-comment__content-reply').each(function() {
                var commentId = $(this).attr('id').split('-')[1];
                loadReplyComment(commentId, 0, 5);
            });
        }
    });
}

function loadReplyComment(commentId, skip, take) {
    $.ajax({
        url: baseUrl + '/comment/' + commentId + '/replies/' + skip + '/' + take,
        dataType: "JSON",
        type: "GET",
        success: function(result) {
            $('#reply-comment-' + commentId).append(result["html"]);
            $('.loading').remove();
        }
    });
}

function loadRate(productId, skip, take) {
    $.ajax({
        url: baseUrl + '/product/' + productId + '/rates/' + skip + '/' + take,
        dataType: "JSON",
        type: "GET",
        success: function(result) {
            $('#product-tab-rate').append(result["html"]);
            $('.loading').remove();
        }
    });
}

function removeComment(commentId) {
    if (confirm('Bạn có chắc muốn xóa comment này?') == true) {
        $.ajax({
            url: baseUrl + '/comment/' + commentId + '/remove',
            type: "GET",
            success: function(result) {
                location.reload();
            }
        });
    }
}

function editComment(commentId) {
    $(document).on('click', function(event) {
        if ($(event.target).is('a#edit')) {
            var elemnt = $(event.target).parent().parent().children(':first');
            var comment = elemnt.text();
            var html = '<form id="edit-comment" data-id="' + commentId + '"><textarea>' + comment + '</textarea><input type="submit" class="btn-green" value="Lưu thay đổi"></form>';
            elemnt.html(html);
        }
    });
}