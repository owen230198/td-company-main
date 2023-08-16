var submitActionAjaxForm = function () {
    $(".adminAjaxForm").submit(function (event) {
        event.preventDefault();
        $.ajax({
            url: $(this).attr("action"),
            type: $(this).attr("method"),
            data: $(this).serialize(),
        }).done(function (data) {
            var json = JSON.parse(data);
            if (json.code == 200) {
                swal('Thành công', json.message, 'success');
            } else {
                swal('Không thành công', json.message, 'error');
            }
        });
    });
};

var confirmRemoveData = function () {
    $(document).on("click", ".delete_btn", function (event) {
        event.preventDefault();
        var id = $(this).data("id");
        $("input[name=remove_id]").val(id);
    });
};

var checkBoxModule = function () {
    $(document).on("change", ".checkbox_module input[type=checkbox]", function (event) {
            event.preventDefault();
            let parent = $(this).closest(".checkbox_module");
            let val = $(this).is(":checked") ? 1 : 0;
            let value_input = parent.find("input[type=hidden]")
            value_input.val(val);
            value_input.trigger('change');
        }
    );
};

var changeSubmit = function () {
    $(document).on("change", ".change_submit", function (event) {
        event.preventDefault(event);
        $(this).closest("form").submit();
    });
};

var usernameInputPrevent = function () {
    $(document).on('keypress paste', 'input[name=username]', function(e){
        let txt = String.fromCharCode(e.which);
        if (!txt.match(/[A-Za-z0-9&. ]/) && e.which !== 8) {
            return false;
        }
        if (e.which === 32) return false;
    });
};

var passwordInputPrevent = function () {
    $(document).on('keypress paste', 'input[name*=password]', function(e){
        if (e.which === 32) return false;
    });
};

var checkMultiRecordModule = function () {
    $(document).on("change", "input.c_one_remove", function (event) {
        event.preventDefault();
        getValueMuliCheckbox();
    });

    $(document).on("change", "input.c_all_remove", function (event) {
        event.preventDefault();
        if (
            $(".c_one_remove").is(":checked") &&
            $(this).prop("checked") == false
        ) {
            $(".c_one_remove").prop("checked", false);
        } else {
            $(".c_one_remove").prop("checked", true);
        }
        getValueMuliCheckbox();
    });
};

var getValueMuliCheckbox = function () {
    var arr = $("input.c_one_remove:checked");
    var str = "";
    console.log(arr.length);
    for (var i = 0; i < arr.length; i++) {
        var item = arr[i];
        str += $(item).data("id");
        if (i < arr.length - 1) {
            str += ",";
        }
    }
    $("input[name=multi_remove_id]").val(str);
};

var loadDataPopup = function () {
    $(document).on("click", ".load_view_popup", function (event) {
        event.preventDefault();
        var src = $(this).data("src");
        $(".modalAction").find("iframe").attr("src", src);
    });
    $('.modalAction').on('hidden.bs.modal', function (e) {
        location.reload();
      })
};

var selectConfig = function (section = $('.base_content')) {
    let list_select2 = section.find("select.select_config");
    if (list_select2.length > 0) {
        list_select2.each(function () {
            $(this).select2({
                minimumResultsForSearch: 1,
            });   
        })
    }
};

var dateRangeInputModule = function () {
    $(function () {
        $(".dateRangeInput").daterangepicker({
            autoUpdateInput: false,
            timePicker: true,
            locale: {
                format: "DD/MM/YYYY HH:mm",
                separator: " - ",
                applyLabel: "Xong",
                cancelLabel: "Hủy",
                fromLabel: "Từ ngày",
                toLabel: "Đến ngày",
                customRangeLabel: "Custom",
                daysOfWeek: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
                monthNames: [
                    "Tháng 1 / ",
                    "Tháng 2 / ",
                    "Tháng 3 / ",
                    "Tháng 4 / ",
                    "Tháng 5 / ",
                    "Tháng 6 / ",
                    "Tháng 7 / ",
                    "Tháng 8 / ",
                    "Tháng 9 / ",
                    "Tháng 10 / ",
                    "Tháng 11 / ",
                    "Tháng 12 / ",
                ],
                firstDay: 1,
            },
        });

        $(".dateRangeInput").on("apply.daterangepicker", function (ev, picker) {
            $(this).val(
                picker.startDate.format("DD/MM/YYYY H:mm") +
                    " - " +
                    picker.endDate.format("DD/MM/YYYY H:mm")
            );
        });
        $(".dateRangeInput").on(
            "cancel.daterangepicker",
            function (ev, picker) {
                $(this).val("");
            }
        );
    });
};

var datePickerModule = function () {
    $(function () {
        $(".inputDatePicker").daterangepicker(
            {
                singleDatePicker: true,
                minYear: 2010,
                timePicker: true,
                locale: {
                    format: "DD/MM/YYYY H:mm",
                    separator: " - ",
                    applyLabel: "Xong",
                    cancelLabel: "Hủy",
                    fromLabel: "Từ ngày",
                    toLabel: "Đến ngày",
                    customRangeLabel: "Custom",
                    daysOfWeek: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
                    monthNames: [
                        "Tháng 1 / ",
                        "Tháng 2 / ",
                        "Tháng 3 / ",
                        "Tháng 4 / ",
                        "Tháng 5 / ",
                        "Tháng 6 / ",
                        "Tháng 7 / ",
                        "Tháng 8 / ",
                        "Tháng 9 / ",
                        "Tháng 10 / ",
                        "Tháng 11 / ",
                        "Tháng 12 / ",
                    ],
                    firstDay: 1,
                },
            },
            function (start, end, label) {
                var years = moment().diff(start, "years", 10);
            }
        );
    });
};

var menuUserHeader = function(){
    $(document).on('click', '.user_name', function(event){
        event.preventDefault();
        let user_menu = $(this).closest('.header_menu_user').find('.header_menu_user_list');
        user_menu.slideToggle(200);
    });
}

var menuSidebar = function()
{
    $(document).on('click', '.admin_sidebar .sidebar_menu>li', function(event){
        let child_menu = $(this).find('ul');
        let list_child = $('.admin_sidebar .sidebar_menu>li').find('ul');
        list_child.each(function(){
            if ($(this).css('display') === 'block') {
                $(this).parent().removeClass('active');
                $(this).slideUp(200);
            }
        });
        if (child_menu.css('display') === 'none') {
            $(this).toggleClass('active');
            child_menu.slideToggle(200);
        }else{
            $(this).removeClass('active');
            child_menu.slideUp(200);    
        }
    });
}

var selectAjaxModule = function(section = $('.page_content '))
{
    let select_ajax = section.find('select.select_ajax');
    if (select_ajax.length > 0) {
        select_ajax.each(function(){
            let url = $(this).data('url');
            if ($(this).val() == null) {
                $(this).select2({
                    allowClear: true,
                    placeholder: '',
                    ajax: {
                        url: url,
                        dataType: 'json',
                        data: (params) => {
                            return {
                            q: params.term,
                            }
                        },
                        processResults: (data) => {
                            const results = data.map(item => {
                            return {
                                id: item.id,
                                text: item.label,
                            };
                            });
                            return {
                            results: results,
                            }
                        },
                    },
                });
                if ($(this).data('id') !== '' && $(this).data('label') !== '') {
                    var newOption = new Option($(this).data('label'), $(this).data('id'), true, true);
                    $(this).append(newOption).trigger('change');
                }
            }
            
        })
    }

}

var phoneInputPrevent = function () {
    $(document).on('keypress paste keydown', 'input[name*=phone]', function (event) {
        let key = event.charCode ? event.charCode : event.keyCode;
        if (key == 46)
        {
            event.preventDefault();
            return false;
        } 
    });
};

var multipleSelectModule = function(section = $('.base_content'))
{
    let select_multiple = section.find('select.multiple_select');
    if (select_multiple.length > 0) {
        select_multiple.each(function(){
            let note = $(this).data('note')
            $(this).multiselect(
                {
                    nonSelectedText: 'Chọn '+note,
                    nSelectedText: note + ' đã được chọn',
                    allSelectedText: 'Đã chọn hết ' + note,
                    dropRight: true,
                }
            );
        });
    }
}

var initInputModuleAfterAjax = function(section)
{
    selectAjaxModule(section);
    multipleSelectModule(section);
    selectConfig(section);
}

var fileProcessModule = function() {
    //upload file
    $(document).on('change', 'input.__file_upload_input', function(event) {
        event.preventDefault();
        let files = $(this)[0].files;
        if (files.length > 0) {
            let form_data = new FormData();
            form_data.append('file', files[0]);
            let table = $(this).data('table');
            if (!empty('table')) {
                form_data.append('table', table);
            }
            let field = $(this).data('field');
            if (!empty('field')) {
                form_data.append('field', field);
            }
            let obj = $(this).data('obj');
            if (!empty('obj')) {
                form_data.append('obj', obj);
            }
            let parent = $(this).closest('.__module_upload_file');
            let input_value = parent.find('input.__file_value');
            $('#loader').fadeIn(200);
            $.ajax({
                url: getBaseRoute('file-upload'),
                method: 'POST',
                data: form_data,
                contentType: false,
                processData: false,
                dataType: 'json'
            })
            .done(function(data){
                if (data.code == 100) {
                    swal('Không thành công', data.message, 'error');
                }else{
                    let value = '{"path":"'+data.path+'","name":"'+data.name+'"}'
                    input_value.val(value);
                    parent.find('.__file_preview').fadeIn(200);
                    if (data.name.length > 18) {
                        parent.find('.__file_name').text(data.name.substr(0,18)+'...  ');
                    }else{
                        parent.find('.__file_name').text(data.name);
                    } 
                }
                $('#loader').fadeOut(200);
            })
        }else{
            swal('Không thành công', 'Dữ liệu file không đúng', 'error');
        }   
    });
}

var receiveCommand = function()
{
    $(document).on('click', '.__receive_command', function(event){
        event.preventDefault();
        let table = $(this).data('table');
        let id = $(this).data('id');
        $('#loader').fadeIn(200);
        $.ajax({
            url: getBaseRoute('receive-command/'+table+'/'+id),
            type: 'POST'
        }).done(function(data){
            let title = data.code == 200 ? 'Thành công' : 'Không thành công';
            let key = data.code == 200 ? 'success' : 'error';
            swal(title, data.message, key, {
                buttons: {
                  catch: {
                    text: "Lệnh đang nhận",
                    value: "received",
                  },
                  OK: true,
                },
              }).then((value) => {
                switch (value) {
                  case "received":
                    window.location = getBaseRoute('view/c_designs?default_data={"status":"designing"}');
                    break;
                  default:
                    window.location.reload();	
                }
            });
        })
        $('#loader').delay(200).fadeOut(500); 
    });
}

var confirmTakeOutSupply = function()
{
    $(document).on('click', '.__confirm_ex_supp', function(event){
        event.preventDefault();
        let id = $(this).data('id');
        ajaxBaseCall({
            url: getBaseRoute('take-out-supply/'+id),
            type: 'POST'
        });
    });
}

var confirmTakeOutSupply = function()
{
    $(document).on('click', '.__confirm_im_supp', function(event){
        event.preventDefault();
        let id = $(this).data('id');
        ajaxBaseCall({
            url: getBaseRoute('take-in-supply/'+id),
            type: 'POST'
        });
    });
}

var moduleSelectAjaxChild = function()
{
    $(document).on('change', 'select.__select_parent', function(event){
        event.preventDefault();
        let value = $(this).val();
        let parent = $(this).closest('.__module_select_ajax_value_child');
        let url =  parent.attr('link')+'?param='+value;
        let ajax_target = parent.find('select.__select_child');
        ajaxViewTarget(url, ajax_target, ajax_target);
        if (!empty(value)) {
            ajax_target.attr('disabled', false);    
        }else{
            ajax_target.attr('disabled', true);   
        }
    })
}

var getUrlLinkingWarehouseSize = function(type)
{
    if (['carton', 'rubber', 'styrofoam', 'mica'].includes(type)) {
        wh_table = 'supply_warehouses';   
    }else if(['magnet'].includes(type)){
        wh_table = 'other_warehouses';
    }else{
        wh_table = 'print_warehouses';    
    }
    return getBaseRoute('get-data-json-linking?table='+wh_table+'&field_search=name&type='+type);
}

var selectTypeSuppWarehouse = function()
{
    $(document).on('change', 'select.__wh_select_type', function(event){
        event.preventDefault();
        let parent = $(this).closest('.__module_select_type_warehouse');
        let value = $(this).val();
        let url =  getUrlLinkingWarehouseSize(value);
        let select_size = parent.find('select.__wh_select_size');
        select_size.data('url', url);
        initInputModuleAfterAjax(parent);
        if (!empty(value)) {
            select_size.attr('disabled', false);    
        }else{
            select_size.attr('disabled', true);   
        }
    })
}

$(function () {
    submitActionAjaxForm();
    confirmRemoveData();
    checkBoxModule();
    changeSubmit();
    // usernameInputPrevent();
    passwordInputPrevent();
    checkMultiRecordModule();
    loadDataPopup();
    selectConfig();
    dateRangeInputModule();
    datePickerModule();
    menuUserHeader();
    menuSidebar();
    selectAjaxModule();
    multipleSelectModule();
    phoneInputPrevent();
    fileProcessModule();
    receiveCommand();
    confirmTakeOutSupply();
    moduleSelectAjaxChild();
    selectTypeSuppWarehouse();
});
