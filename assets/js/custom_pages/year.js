//-- This function is used to display list of records in datatable
$(function () {
    $('.datatable-basic').dataTable({
        autoWidth: false,
        processing: true,
        serverSide: true,
        language: {
            search: '<span>Filter:</span> _INPUT_',
            lengthMenu: '<span>Show:</span> _MENU_',
            paginate: {'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;'},
        },
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        order: [[1, "desc"]],
        ajax: site_url + 'product/get_year',
        responsive: {
            details: {
                type: 'column',
                target: -1
            }
        },
        columns: [
            {
                data: "sr_no",
                visible: true,
                sortable: false,
            },
            {
                data: "name",
                visible: true,
                responsivePriority: 1
            },
            {
                data: "modified_date",
                visible: true,
            },
            {
                data: "action",
                visible: true,
                render: function (data, type, full, meta) {
                    action = '';
                    action += '<a id="edit_' + btoa(full.id) + '" class="btn custom_dt_action_button btn-xs edit" title="Edit">Edit</a>';
                    action += '&nbsp;&nbsp;<a href="' + site_url + 'product/year/delete/' + btoa(full.id) + '" class="btn custom_dt_action_button btn-xs" onclick="return confirm_alert(this)" title="Delete">Delete</a>';
                    return action;
                },
                sortable: false,
            },
            {
                data: 'responsive',
                className: 'control',
                orderable: false,
                targets: -1,
            }
        ]
    });

    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity,
        width: 'auto'
    });
    $('.dataTables_filter input[type=search]').attr('placeholder', 'Type to filter...');
});

//-- This function is used to edit particular records
$(document).on('click', '.edit', function () {
    var id = $(this).attr('id').replace('edit_', '');
    var url = base_url + 'product/get_year_by_id';
    $('#custom_loading').removeClass('hide');
    $('#custom_loading img').addClass('hide');
    $('#year_form_row').css('z-index', '999999');
    $.ajax({
        type: 'POST',
        url: url,
        async: false,
        dataType: 'JSON',
        data: {id: id},
        success: function (data) {
            $('#txt_year_name').val(data.name);
            $('#txt_year_name').focus();
            $('#txt_year_id').val(data.id);
            $("#txt_year_name").rules("add", {
                remote: site_url + "product/checkUnique_Year_Name/" + data.id,
                messages: {
                    remote: $.validator.format("This year already exist!")
                }
            });
            $("#add_year_form").validate().resetForm();
            $('html, body').animate({scrollTop: 0}, 500);
            setTimeout(function () {
                $('body').css('overflow', 'hidden');
            }, 500);
        }
    });
});


function cancel_click() {
    $('#custom_loading').addClass('hide');
    $('#custom_loading img').removeClass('hide');
    $('#year_form_row').css('z-index', '0');
    $('#txt_year_name').val('');
    $('#txt_year_id').val('');
    $("#txt_year_name").rules("add", {
        remote: site_url + "product/checkUnique_Year_Name/",
        messages: {
            remote: $.validator.format("This year already exist!")
        }
    });
    $('#txt_year_name').valid();
    $("#add_year_form").validate().resetForm();
    $('.form-control-feedback').remove();
    $('body').css('overflow', 'auto');
}

//-- This function is used to delete particular record
function confirm_alert(e) {
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this year!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#FF7043",
        confirmButtonText: "Yes, delete it!"
    },
    function (isConfirm) {
        if (isConfirm) {
            window.location.href = $(e).attr('href');
            return true;
        } else {
            return false;
        }
    });
    return false;
}

//-- This function is used to validate form
var validator = $("#add_year_form").validate({
    ignore: 'input[type=hidden], .select2-search__field, #txt_status', // ignore hidden fields
    errorClass: 'validation-error-label',
    successClass: 'validation-valid-label',
    highlight: function (element, errorClass) {
        $(element).removeClass(errorClass);
    },
    unhighlight: function (element, errorClass) {
        $(element).removeClass(errorClass);
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
        $(element).parent().find('.form_success_vert_icon').remove();
        $(element).parent().append('<div class="form_success_vert_icon form-control-feedback"><i class="icon-checkmark-circle"></i></div>');
        $(element).remove();
    },
    rules: {
        txt_year_name: {
            required: true,
            maxlength: 4,
            number: true,
            min: 0,
            remote: remoteURL
        }
    },
    messages: {
        txt_year_name: {
            remote: $.validator.format("This name already exist!")
        }
    },
    submitHandler: function(form){
        form.submit();
        $('.custom_save_button').prop('disabled', true);
    },
   invalidHandler: function() {
        $('.custom_save_button').prop('disabled', false);
   }
});