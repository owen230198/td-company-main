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
                toastr["success"](json.message);
            } else {
                toastr["error"](json.message);
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
};

var selectConfigs = function () {
    if ($("select.select_config").length > 0) {
        $("select.select_config").select2({
            minimumResultsForSearch: 1,
        });
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
                    format: "DD/MM/YYYY hh:mm A",
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

var selectAjaxModule = function(section = $('.base_content '))
{
    let select_ajax = section.find('select.select_ajax');
    if (select_ajax.length > 0) {
        select_ajax.each(function(){
            let url = $(this).data('url');
            if ($(this).val() == null) {
                $(this).select2({
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
    $(document).on('keypress paste keydown', 'input[name*=phone]', function (e) {
        let txt = String.fromCharCode(e.which);
        if ((!txt.match(/^[0-9]+$/) && e.which !== 8) || e.which === 32)
            return false;
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
}

var fileUploadModule = function() {
    $(document).on('change', 'input.__file_upload_input', function(event) {
        event.preventDefault();
        let file = new FormData();
        file.append('file')
        if (file.length > 0) {
            $('#loader').fadeIn(200);
            $.ajax({
                url: getBaseRoute('upload-file'),
                type: 'POST',
                data: {file:file[0]},
                dataType: 'json',
                processData: false,
            })
            .done(function(data){
                console.log(data);
                $('#loader').fadeOut(200);
            })
        }   
    })    
}

$(function () {
    submitActionAjaxForm();
    confirmRemoveData();
    checkBoxModule();
    changeSubmit();
    usernameInputPrevent();
    passwordInputPrevent();
    checkMultiRecordModule();
    loadDataPopup();
    selectConfigs();
    dateRangeInputModule();
    datePickerModule();
    menuUserHeader();
    menuSidebar();
    selectAjaxModule();
    multipleSelectModule();
    phoneInputPrevent();
    fileUploadModule();
});
