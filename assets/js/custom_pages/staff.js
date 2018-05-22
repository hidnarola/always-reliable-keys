$('.datatable-basic').dataTable({
    autoWidth: false,
    processing: true,
    serverSide: true,
    language: {
        search: '<span>Filter:</span> _INPUT_',
        lengthMenu: '<span>Show:</span> _MENU_',
        paginate: {'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;'},
        emptyTable: 'No data currently available.'
    },
    dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
    order: [[2, "asc"]],
    ajax: site_url + 'staff/get_ajax_data',
    columns: [
        {
            data: "sr_no",
            visible: true,
            sortable: false
        },
        {
            data: "status",
            visible: true,
            render: function (data, type, full, meta) {
                status = '';
                if (full.is_delete == 1) {
                    status = '<span class="label label-danger">Deleted</span>';
                } else {
                    if (full.status == 'block') {
                        status = '<div class="checkbox checkbox-switchery switchery-xs switchery-double datatable custom_switchery_unchecked checkbox_' + full.id + '"><label><input type="checkbox" class="switchery-info" name="txt_status_' + full.id + '" id="txt_status_' + full.id + '" onClick="change_status(' + full.id + ')" disabled="disabled"></label></div>';
                    } else if (full.status == 'active') {
                        status = '<div class="checkbox checkbox-switchery switchery-xs switchery-double datatable custom_switchery_checked checkbox_' + full.id + '"><label><input type="checkbox" class="switchery-info" name="txt_status_' + full.id + '" id="txt_status_' + full.id + '" onClick="change_status(' + full.id + ')" checked disabled="disabled"></label></div>';
                    }
                }
                return status;
            }
        },
        {
            data: "role_name",
            visible: true,
            render: function (data, type, full, meta) {
                if(full.role_name=='admin'){
                    return '<span class="label bg-success">Admin</span>';
                } else if(full.role_name=='admin_assistant'){
                    return '<span class="label bg-info">Admin Assistant</span>';
                } else if(full.role_name=='staff'){
                    return '<span class="label bg-grey-400">Staff</span>';
                }
            }
        },
        {
            data: "full_name",
            visible: true,
        },
        {
            data: "username",
            visible: true,
        },
        {
            data: "email_id",
            visible: true,
        },
        {
            data: "modified_date",
            visible: true,
        },
        {
            data: "action",
            render: function (data, type, full, meta) {
                action = '';
                //action += '<a href="javascript:void(0);" class="btn btn-xs custom_dt_action_button menu_cat_view_btn" title="View" id="' + btoa(full.id) + '">View</a>';
                action += '&nbsp;&nbsp;<a href="' + site_url + 'staff/edit/' + btoa(full.id) + '" class="btn custom_dt_action_button btn-xs" title="Edit">Edit</a>';
                action += '&nbsp;&nbsp;<a href="' + site_url + 'staff/delete/' + btoa(full.id) + '" class="btn custom_dt_action_button btn-xs" onclick="return confirm_alert(this)" title="Delete">Delete</a>';
                return action;
            },
            sortable: false,
        },
    ],
    "fnDrawCallback": function () {
        var info = document.querySelectorAll('.switchery-info');
        $(info).each(function () {
            var switchery = new Switchery(this, {color: '#95e0eb'});
        });
    }
});

$('.dataTables_length select').select2({
    minimumResultsForSearch: Infinity,
    width: 'auto'
});
$('.dataTables_filter input[type=search]').attr('placeholder', 'Type to filter...');
var add_button = '<div class="text-right"><a href="' + site_url + 'staff/add" class="btn bg-teal-400 btn-labeled custom_add_button"><b><i class="icon-plus-circle2"></i></b> Add Staff</a></div>';
$('.datatable-header').append(add_button);

//-- Sweet Alert Delete Popup
function confirm_alert(e) {
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this staff!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#FF7043",
        confirmButtonText: "Yes, delete it!"
    },
    function (isConfirm) {
        if (isConfirm) {
            window.location.href = $(e).attr('href');
            return true;
        }
        else {
            return false;
        }
    });
    return false;
}
var validator = $("#add_staff_form").validate({
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
        txt_first_name: { required: true,maxlength: 50 },
        txt_last_name: { required: true,maxlength: 50 },
        txt_email_id: { required: true, email: true, remote: remoteURL },
        txt_user_name: { required: username_req, remote: remoteURL2 },
        txt_role: { required: true },
    },
    messages: {
        txt_email_id: { remote: $.validator.format("This Email already exist!") },
        txt_user_name: { remote: $.validator.format("This Username already exist!") },

    },
    submitHandler: function (form) {
        form.submit();
        $('.custom_save_button').prop('disabled', true);
        // $('form input[type=submit]').html('Saving..');
    },
    invalidHandler: function () {
        $('.custom_save_button').prop('disabled', false);
    }
});

//-- Switchery 
var info = document.querySelector('.switchery-info');
if (info != null) {
    var switchery = new Switchery(info, {color: '#95e0eb'});
}
var clickCheckbox = document.querySelector('#txt_status');
if (clickCheckbox != null) {
    clickCheckbox.addEventListener('click', function () {
        if (clickCheckbox.checked) {
            $('.switchery small').removeClass('custom_switchery_before');
            $('.switchery small').addClass('custom_switchery_after');
        } else {
            $('.switchery small').removeClass('custom_switchery_after');
            $('.switchery small').addClass('custom_switchery_before');
        }
    });
}
if (status == 'checked') {
    $('.switchery small').removeClass('custom_switchery_before');
    $('.switchery small').addClass('custom_switchery_after');
} else if (status == 'unchecked' || status == 'null') {
    $('.switchery small').removeClass('custom_switchery_after');
    $('.switchery small').addClass('custom_switchery_before');
}