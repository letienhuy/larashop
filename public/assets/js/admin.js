function removeAddress(id) {
    if (confirm('Bạn có muốn xoá địa chỉ này?')) {
        location.href = location.href + '/delete?id=' + id;
    } else {
        return false;
    }
}
$('#product-image').load('./getImage');
$('#add-image').submit(function(e) {
    e.preventDefault();
    $(this).append('<center><div class="loading"></div></center>');
    var formData = new FormData(this);
    $.ajax({
        url: './image',
        type: "POST",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function(result) {
            $('#product-image').load('./getImage');
            $('.loading').remove();
        },
        error: function(err) {
            var text = JSON.parse(err.responseText);
            $('.loading').remove();
            $('<div/>').text(text.errors.image).addClass('alert alert-danger').appendTo('#add-image').fadeOut(5000);
        }
    });
});

$(document).on('click', '.delete', function() {
    var img = $(this).parent().children('img').attr('src').split('\\').pop();
    if (img.length !== 36) {
        img = $(this).parent().children('img').attr('src').split('/').pop();
    }
    var id = location.search.split('=').pop();
    if (confirm('Xoá ảnh này?')) {
        $.ajax({
            url: './deleteImage',
            data: { 'image': img, 'id': id },
            success: function(result) {
                $('#product-image').load('./getImage');
            }
        });
    }
});
$(document).ready(function() {
    $('#count-item').html('(' + $('input:checked').length + ' item selected)');
});
$(document).on('change', 'input[type=checkbox]', function() {
    $('#count-item').html('(' + $('input:checked').length + ' item selected)');
});
$(document).on('change', '#sort-category', function() {
    location.href = '?catId=' + $('#sort-category').val();
});
$(document).on('click', '#multi-delete', function() {
    var data = new FormData($('#multi-select')[0]);
    $('input:checked').each(function(key, val) {
        data.append('product_id[]', $(val).val());
    });
    if (confirm('Xoá ' + $('input:checked').length + ' sản phẩm, sau khi xoá không thể khôi phục!?')) {
        $.ajax({
            url: location.href + '/multiDelete',
            data: data,
            type: "POST",
            processData: false,
            contentType: false,
            cache: false,
            success: function(r) {
                location.reload();
            }
        });
    } else {
        return false;
    }
});
$(document).on('click', '#multi-move', function() {
    var form = $('#multi-select');
    form.attr('action', 'product/multiMove');
    form.attr('method', 'POST');
    form.submit();
});

function removeProduct(id) {
    if (confirm('Xoá sản phẩm sẽ không thể khôi phục. Tiếp tục?')) {
        location.href = location.href + '/delete?id=' + id + '&confirm=1';
    } else {
        return false;
    }
}

function removeUser(id) {
    if (confirm('Xoá tài khoản sẽ không thể khôi phục. Tiếp tục?')) {
        location.href = location.href + '/delete?id=' + id + '&confirm=1';
    } else {
        return false;
    }
}

function removeSlide(id) {
    if (confirm('Xoá ảnh này sẽ không thể khôi phục. Tiếp tục?')) {
        location.href = location.href + '/delete?id=' + id + '&confirm=1';
    } else {
        return false;
    }
}

function removeCategory(id) {
    if (confirm('Xoá danh mục này sẽ không thể khôi phục. Tiếp tục?')) {
        location.href = location.href + '/delete?id=' + id + '&confirm=1';
    } else {
        return false;
    }
}

function submitForm(id) {
    $('#' + id).submit();
}