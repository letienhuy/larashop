/*
 * Created on Sun Nov 26 2017
 * Copyright (c) 2017 Huy Le Tien
 * Version 1.0.0
 */

var baseUrl = $('head base').attr('href');
$('#open-cart').click(function() {
    $('.cart-menu').toggle("blind");
});

var buttonRotate = false;
$('.list-menu button').click(function() {
    var ul = $('.list-menu ul:first');
    ul.toggle('slide');
    if (!buttonRotate) {
        $('.list-menu button').addClass('button-toggle');
        buttonRotate = true;
    } else {
        $('.list-menu button').removeClass('button-toggle');
        buttonRotate = false;
    }
});
$(document).on('click', '.dropdown', function() {
    var toggle = $(this).data('toggle');
    $(toggle).toggle('blind');
});

$('.product-tab-container__header li').click(function() {
    var active = $('.product-tab-container__header li.active');
    var array = ['.product-tab-description', '.product-tab-rate', '.product-tab-comment'];
    active.removeClass('active');
    $(array[active.index()]).hide();
    $(array[$(this).index()]).show();
    $(this).addClass('active');
});

$(window).resize(function() {
    var width = $(window).width();
    var height = $(window).height();
    if (width <= 768) {
        $('.dropdown-menu').css({
            'width': width - 50
        });
        $('.cart-menu').css({
            'width': width - 40
        });
    } else {
        $('.dropdown-menu').css({
            'width': ''
        });
    }
});
$(document).ready(function() {
    var width = $(window).width();
    var height = $(window).height();
    if (width <= 768) {
        $('.dropdown-menu').css({
            'width': width - 50
        });
        $('.cart-menu').css({
            'width': width - 40
        });
    }
    $('.dropdown-menu').css({
        'max-height': height - 50
    });
    initSlideShow();
    $(this).scroll(function() {
        if ($(this).scrollTop() > 200) {
            $('#up-top').fadeIn();
        } else {
            $('#up-top').fadeOut();
        }
    });
    $('#up-top').click(function() {
        $(window).scrollTop(0);
    });
    $('#show-cat').click(function() {
        $('.category').toggle('blind');
    });
});

//Slide image
function initSlideShow() {
    $(".slide ul:first li:first").addClass('active');
    $(".slide-gallery .slide-gallery-dot:first").addClass('active');
    $(".small-image ul li:first").addClass('active');
    window.myTime = setInterval(slideNextImage, 6000);
}

function restartSlideShow() {
    clearInterval(window.myTime);
    window.myTime = setInterval(slideNextImage, 6000);
}

function slideNextImage() {
    var active = $(".slide ul:first li.active");
    var dot = $(".slide .slide-gallery span.active");
    var img = $(".small-image ul li.active");
    if (active.next().length == 0) {
        active.removeClass('active');
        dot.removeClass('active');
        img.removeClass('active');
        $(".slide ul:first li:first").addClass('active');
        $(".slide-gallery .slide-gallery-dot:first").addClass('active');
        $(".small-image ul li:first").addClass('active');
        return;
    }
    active.removeClass('active');
    dot.removeClass('active');
    img.removeClass('active');
    active.next().addClass('active');
    dot.next().addClass('active');
    img.next().addClass('active');
}

function slidePrevImage() {
    var active = $(".slide ul:first li.active");
    var dot = $(".slide .slide-gallery span.active");
    var img = $(".small-image ul li.active");
    if (active.prev().length == 0) {
        active.removeClass('active');
        dot.removeClass('active');
        img.removeClass('active');
        $(".slide ul:first li:last").addClass('active');
        $(".slide-gallery .slide-gallery-dot:last").addClass('active');
        $(".small-image ul li:last").addClass('active');
        return;
    }
    active.removeClass('active');
    dot.removeClass('active');
    img.removeClass('active');
    active.prev().addClass('active');
    dot.prev().addClass('active');
    img.prev().addClass('active');
}

function slideDotClick(dotted) {
    var active = $(".slide ul:first li.active");
    var dot = $(".slide-gallery span.active");
    var img = $(".small-image ul li.active");
    var index = $(dotted).index() + 1;
    active.removeClass('active');
    dot.removeClass('active');
    img.removeClass('active');
    $('.slide ul:first li:nth-child(' + index + ')').addClass('active');
    $('.small-image ul:first li:nth-child(' + index + ')').addClass('active');
    $(dotted).addClass('active');
}

function smallImageClick(image) {
    var active = $(".slide ul:first li.active");
    var dot = $(".slide-gallery span.active");
    var img = $(".small-image ul li.active");
    var index = $(image).index() + 1;
    active.removeClass('active');
    dot.removeClass('active');
    img.removeClass('active');
    $('.slide ul:first li:nth-child(' + index + ')').addClass('active');
    $('.slide-gallery span:nth-child(' + index + ')').addClass('active');
    $(image).addClass('active');
}

$(".next").click(function() {
    slideNextImage();
    restartSlideShow();
});
$(".prev").click(function() {
    slidePrevImage();
    restartSlideShow();
});
$('.slide-gallery-dot').click(function() {
    slideDotClick(this);
    restartSlideShow();
});
$('.small-image ul li').click(function() {
    smallImageClick(this);
    restartSlideShow();
});
$('.zoom').click(function() {
    if (window.screen.width <= 768) {
        return false;
    }
    var html = '<div class="zoom-slide"></div>';
    html += '<div class="zoom-image">' + $(this).html() + '<span class="closex"></span></div>';
    $('body').append(html);
});
$(document).on('click', '.closex, .zoom-slide', function() {
    $('.zoom-slide').remove();
    $('.zoom-image').remove();
});
//End slide image

//Cart
function addItem(productId, quantity) {
    quantity = quantity <= 0 ? 1 : quantity;
    $.ajax({
        url: baseUrl + "/cart/items/add/" + productId + "/" + quantity,
        success: function() {
            location.reload();
            $('.cart').effect("shake");
        }
    });
}

function removeItem(cartId) {
    $.ajax({
        url: baseUrl + "/cart/items/remove/" + cartId,
        success: function() {
            location.reload();
        }
    });
}

function updateItem(cartId, quantity) {
    quantity = quantity <= 0 ? 1 : quantity;
    $.ajax({
        url: baseUrl + "/cart/items/update/" + cartId + "/" + quantity,
        success: function() {
            $('#up-' + cartId).parent().children('input').val(quantity);
            location.reload();
        }
    });
}

function up(id) {
    var num = $('#' + id).parent().children('input').val();
    num++;
    updateItem(id.split('-')[1], num);
}

function down(id) {
    var num = $('#' + id).parent().children('input').val();
    if (num > 1)
        num--;
    updateItem(id.split('-')[1], num);
}

function submitForm(id) {
    $('#' + id).submit();
}

$('#login').submit(function(e) {
    e.preventDefault();
    var token = $('input[name=_token]').val();
    var email = $('#email').val();
    var password = $('#password').val();
    var remember = $('#remember').val();
    if (email === "" || password === "") {
        $('#result').html($('<div/>').text('Vui lòng nhập đủ các trường!').addClass('alert alert-danger').fadeOut(5000));
        return false;
    }
    $.ajax({
        url: baseUrl + '/login',
        type: "POST",
        data: { '_token': token, 'email': email, 'password': password, 'remember': remember },
        success: function(result) {
            $('#result').html($('<div/>').text('Đăng nhập thành công. Đang chuyển hướng...').addClass('alert alert-success'));
            location.href = document.referrer;
        },
        error: function(err) {
            $('#result').html($('<div/>').text(JSON.parse(err.responseText).errors.email).addClass('alert alert-danger').fadeOut(5000));
        }
    });
});


$('#register').submit(function(e) {
    e.preventDefault();
    $('.alert.alert-danger').remove();
    var token = $('input[name=_token]').val();
    var email = $('#email').val();
    var password = $('#password').val();
    var fullname = $('#fullname').val();
    var phone = $('#phone').val();
    var city = $('#city').val();
    var district = $('#district').val();
    var commune = $('#commune').val();
    var street = $('#street').val();
    if (email === "" || password === "" || fullname === "" || phone === "" || city === "" || district === "" || commune === "" || street === "") {
        $('#result').html($('<div/>').text('Vui lòng nhập đủ các trường!').addClass('alert alert-danger'));
        return false;
    }
    $.ajax({
        url: baseUrl + '/register',
        type: "POST",
        data: {
            '_token': token,
            'fullname': fullname,
            'email': email,
            'password': password,
            'phone': phone,
            'city': city,
            'district': district,
            'commune': commune,
            'street': street
        },
        success: function(result) {
            $('#result').html($('<div/>').text('Đăng ký tài khoản thành công. Đang chuyển hướng...').addClass('alert alert-success'));
            location.href = document.referrer;
        },
        error: function(err) {
            $.each(JSON.parse(err.responseText).errors, function(key, val) {
                $('#result').html($('<div/>').text(val).addClass('alert alert-danger'));
            });
        }
    });
});


$('#edit-info').submit(function(e) {
    e.preventDefault();
    $('.alert.alert-danger').remove();
    var formData = new FormData(this);
    var token = $('input[name=_token]').val();
    var fullname = $('#fullname').val();
    var avatar = $('#avatar').val();
    var phone = $('#phone').val();
    var gender = $('#gender').val();
    var day = $('#day').val();
    var month = $('#month').val();
    var year = $('#year').val();
    if (fullname === "" || phone === "" | token === "") {
        $('#result').html($('<div/>').text('Vui lòng nhập đủ các trường!').addClass('alert alert-danger'));
        return false;
    }
    $.ajax({
        url: baseUrl + '/auth/edit-info',
        type: "POST",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function(result) {
            $('#result').html($('<div/>').text('Đã lưu. Đang chuyển hướng...').addClass('alert alert-success'));
            location.href = baseUrl + "/auth";
        },
        error: function(err) {
            $.each(JSON.parse(err.responseText).errors, function(key, val) {
                $('<div/>').text(val).addClass('alert alert-danger').appendTo('label[for=' + key + ']');
            });
        }
    });
});


$('#checkout').ready(function() {
    $('label[for=bank]').hide();
    $('#bank').hide();
    loadCity();
});

$(document).on('change', '#city', function() {
    loadDistrict($(this).val());
});
$(document).on('change', '#payment', function() {
    if ($(this).val() == 2) {
        $('label[for=bank]').show();
        $('#bank').show();
    } else {
        $('label[for=bank]').hide();
        $('#bank').hide();
    }
});
$(document).on('change', '#district', function() {
    loadCommune($(this).val());
});
$(document).on('click', '.dialog .closex', function() {
    $('.dialog').remove();
    $('#over').remove();
    location.reload();
});
$('#checkout').submit(function(e) {
    e.preventDefault();
    $('.alert.alert-danger').remove();
    var data;
    if ($.isNumeric($('#address').val())) {
        var token = $('input[name=_token]').val();
        var note = $('#note').val();
        data = {
            '_token': token,
            'note': note,
            'addressId': $('#address').val(),
            'paymentType': $('#payment').val(),
            'bank': $('#bank').val()
        };
    } else {
        var token = $('input[name=_token]').val();
        var fullname = $('#fullname').val();
        var phone = $('#phone').val();
        var city = $('#city').val();
        var district = $('#district').val();
        var commune = $('#commune').val();
        var street = $('#street').val();
        var note = $('#note').val();
        data = {
            '_token': token,
            'fullname': fullname,
            'phone': phone,
            'city': city,
            'district': district,
            'commune': commune,
            'street': street,
            'note': note,
            'paymentType': $('#payment').val(),
            'bank': $('#bank').val()
        };
    }
    $.ajax({
        url: baseUrl + '/order/confirm',
        type: 'POST',
        data: data,
        success: function(result) {
            $('<div/>').attr('id', 'over').appendTo('body');
            $('<div/>').addClass('dialog-load').appendTo('body');
            setTimeout(function() {
                $('.dialog-load').remove();
                $('body').append(result);
            }, 3000);
        },
        error: function(err) {
            $.each(JSON.parse(err.responseText).errors, function(key, val) {
                $('<div/>').text(val).addClass('alert alert-danger').appendTo('label[for=' + key + ']');
            });
        }
    });
});

function loadCity() {
    var html = '<option value="">Vui lòng chọn tỉnh/thành phố</option>';
    $.ajax({
        url: baseUrl + '/api/addresses/city',
        success: function(result) {
            $.each(result, function(key, val) {
                html += '<option value="' + val.id + '">' + val.name + '</option>';
            });
            $('select[name=city]').html(html);
        }
    });
}

function loadDistrict(cityId) {
    if (cityId == null) {
        return false;
    }
    var html = '<option value="">Vui lòng chọn quận/huyện</option>';
    $.ajax({
        url: baseUrl + '/api/addresses/district/' + cityId,
        success: function(result) {
            $.each(result, function(key, val) {
                html += '<option value="' + val.id + '">' + val.name + '</option>';
            });
            $('select[name=district]').html(html);
        }
    });
}

function loadCommune(districtId) {
    if (districtId == null) {
        return false;
    }
    var html = '<option value="">Vui lòng chọn xã/phường/thị trấn</option>';
    $.ajax({
        url: baseUrl + '/api/addresses/commune/' + districtId,
        success: function(result) {
            $.each(result, function(key, val) {
                html += '<option value="' + val.id + '">' + val.name + '</option>';
            });
            $('select[name=commune]').html(html);
        }
    });
}