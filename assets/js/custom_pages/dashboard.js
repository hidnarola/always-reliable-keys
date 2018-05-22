$('#txt_make_name').change(function(){
    var selected_val = $(this).val();
    $.ajax({
        url: site_url + 'dashboard/change_make_get_ajax',
        dataType: "json",
        type: "POST",
        data: {id: selected_val},
        success: function (response) {
            $('#txt_model_name').html(response);
            $('#txt_model_name').select2({containerCssClass : 'select-sm'});
        }
    });
});

// $('#btn_search').on('click',function(){
//     var make_name = $('#txt_make_name').val();
//     var model_name = $('#txt_model_name').val();
//     var year_name = $('#txt_year_name').val();
//     $.ajax({
//         url: site_url + 'dashboard/get_transponder_details',
//         dataType: "json",
//         type: "POST",
//         data: {_make_id: make_name, _model_id:model_name, _year_id:year_name},
//         success: function (response) {
//             $('#div_transponder_result').removeClass('hide');
//             $('#tbl_dashboard_trans').html(response);
//         }
//     });
// });

var validator = $("#search_transponder_form").validate({
    ignore: '.select2-search__field, #txt_status', // ignore hidden fields
    errorClass: 'validation-error-label',
    successClass: 'validation-valid-label',
    highlight: function (element, errorClass, validClass) {
        var elem = $(element);
        if (elem.hasClass("select2-offscreen")) {
            $("#s2id_" + elem.attr("id") + " ul").removeClass(errorClass);
        } else {
            elem.removeClass(errorClass);
        }
    },
    unhighlight: function (element, errorClass, validClass) {
        var elem = $(element);
        if (elem.hasClass("select2-offscreen")) {
            $("#s2id_" + elem.attr("id") + " ul").removeClass(errorClass);
        } else {
            elem.removeClass(errorClass);
        }
    },
    errorPlacement: function (error, element) {
        $(element).parent().find('.form_success_vert_icon').remove();
        if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container')) {
            if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                error.appendTo(element.parent().parent().parent().parent());
            } else {
                error.appendTo(element.parent().parent().parent().parent().parent());
            }
        } else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
            error.appendTo(element.parent().parent().parent());
        } else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
            error.appendTo(element.parent());
        } else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
            error.appendTo(element.parent().parent());
        } else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
            error.appendTo(element.parent().parent());
        } else {
            error.insertAfter(element);
        }
    },
    validClass: "validation-valid-label",
    success: function (element) {
        if ($(element).parent('div').hasClass('media-body')) {
            $(element).parent().find('.form_success_vert_icon').remove();
            $(element).remove();
        } else {
            $(element).parent().find('.form_success_vert_icon').remove();
            $(element).parent().append('<div class="form_success_vert_icon form-control-feedback"><i class="icon-checkmark-circle"></i></div>');
            $(element).remove();
        }
    },
    rules: {
        txt_make_name: { required: true },
        txt_model_name: { required: true },
        txt_year_name: { required: true }
    },
    submitHandler: function (form) {
        $('#custom_loading').removeClass('hide');
        var make_name = $('#txt_make_name').val();
        var model_name = $('#txt_model_name').val();
        var year_name = $('#txt_year_name').val();
        $.ajax({
            url: site_url + 'dashboard/get_transponder_details',
            dataType: "json",
            type: "POST",
            data: {_make_id: make_name, _model_id:model_name, _year_id:year_name},
            success: function (response) {
                $('#div_transponder_result, #div_list_of_parts').removeClass('hide');
                $('#tbl_dashboard_trans').html(response.table_body);
                $('.div_part_list').html(response.div_part_list);
                $('#custom_loading').addClass('hide');
            }
        });
    },
    invalidHandler: function () {
        $('.custom_save_button').prop('disabled', false);
    }
});

$(document).on('click','#btn_reset',function(){
    $('#txt_make_name').val('').select2('');
    $('#txt_model_name').val('').select2('');
    $('#txt_year_name').val('').select2('');
    //$("#search_transponder_form").validate().resetForm();
    $('.form-control-feedback').remove();
    $('#div_transponder_result').addClass('hide');
    $('#div_list_of_parts').addClass('hide');
});

$(document).on('click', '.btn_home_item_view', function () {
    $.ajax({
        url: site_url + 'inventory/get_item_data_ajax_by_id',
        type: "POST",
        data: {id: this.id},
        success: function (response) {
            $('#dash_view_body1').html(response);
            $('#dash_view_modal1').modal('show');
        }
    });
});