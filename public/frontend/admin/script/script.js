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
    $(document).on(
        "change",
        ".checkbox_module input[type=checkbox]",
        function (event) {
            event.preventDefault();
            eParent = $(this).closest(".checkbox_module");
            val = $(this).is(":checked") ? 1 : 0;
            eInutHidden = eParent.find("input[type=hidden]")
            eInutHidden.val(val);
            if (eInutHidden.attr('name')=='order[vat]') {
                vatCheckBoxModule(val);
            }
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
    $("input[name=username]").keypress(function (e) {
        var txt = String.fromCharCode(e.which);
        if (!txt.match(/[A-Za-z0-9&. ]/)) {
            return false;
        }
        if (e.which === 32) return false;
    });

    $("input[name=username]").bind("paste", function (e) {
        setTimeout(function () {
            var value = $("input[name=username]").val();
            var updated = value.replace(/[^A-Za-z0-9&. ]/g, "");
            $("input[name=username]").val(updated);
        });
        if (e.which === 32) return false;
    });
};

var passwordInputPrevent = function () {
    $("input[name=password]").keypress(function (e) {
        if (e.which === 32) return false;
    });

    $("input[name=password]").bind("paste", function (e) {
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
                format: "MM/DD/YYYY HH:mm",
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
                picker.startDate.format("MM/DD/YYYY H:mm") +
                    " - " +
                    picker.endDate.format("MM/DD/YYYY H:mm")
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
                    format: "MM/DD/YYYY hh:mm A",
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

var selectAjaxModule = function()
{
    let select_ajax = $('select.select_ajax');
    if (select_ajax.length > 0) {
        select_ajax.each(function(){
            let url = $(this).data('url');
            $(this).select2({
                ajax: {
                    url: url,
                    dataType: 'json',
                    data: (params) => {
                        return {
                        q: params.term,
                        }
                    },
                    processResults: (data, params) => {
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
        })
    }
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
});
