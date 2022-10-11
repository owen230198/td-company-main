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
            eParent = $(this).closest(".checkbox_module");
            val = $(this).is(":checked") ? 1 : 0;
            eParent.find("input[type=hidden]").val(val);
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
var ajaxChildOptionByParent = function () {
    $(document).on("change", "select.change_select_ajax", function (event) {
        event.preventDefault();
        eParent = $(this).closest(".ajaxSelectModule");
        parent_id = $(this).val();
        url = $(this).data("url") + parent_id;
        $.ajax({
            url: url,
        }).done(function (html) {
            eParent.find("select.ajax_option").html(html);
        });
    });
};

var tableSelectConfig = function () {
    $(document).on("change", ".tableSelectAjaxChild", function (event) {
        event.preventDefault();
        sChilTable = $(this).data("child-table");
        sAjaxTarget = $(this).data("child-target");
        sChildField = $(this).data("child-field");
        sUrl =
            "option-child-data/" +
            sChilTable +
            "/" +
            sChildField +
            "/" +
            $(this).val();
        if (sAjaxTarget.length != "") {
            $.ajax({
                url: sUrl,
            }).done(function (shtml) {
                $("select[name=" + sAjaxTarget + "]").html(shtml);
            });
        }
    });
};

var selectCustomerAjax = function () {
    form = $(".actionForm");
    cusomerSelect = form.find("select[name=customer_id]");
    companyInput = form.find("input[name=company_name]");
    contacterInput = form.find("input[name=contacter]");
    addressInput = form.find("input[name=address]");
    emailInput = form.find("input[name=email]");
    phoneInput = form.find("input[name=phone]");
    if (
        cusomerSelect.length > 0 &&
        companyInput.length > 0 &&
        contacterInput.length > 0 &&
        addressInput.length > 0 &&
        emailInput.length > 0 &&
        phoneInput.length > 0
    ) {
        $(document).on("change", "select[name=customer_id]", function (event) {
            event.preventDefault();
            parent_id = $(this).val();
            $.ajax({
                url: "get-data-details/customers/" + parent_id,
            }).done(function (data) {
                var json = JSON.parse(data);
                companyInput.val(json.name);
                contacterInput.val(json.contacter);
                addressInput.val(json.address);
                emailInput.val(json.email);
                phoneInput.val(json.phone);
            });
        });
    }
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

$(function () {
    submitActionAjaxForm();
    confirmRemoveData();
    checkBoxModule();
    changeSubmit();
    usernameInputPrevent();
    passwordInputPrevent();
    checkMultiRecordModule();
    loadDataPopup();
    ajaxChildOptionByParent();
    tableSelectConfig();
    selectCustomerAjax();
    selectConfigs();
    dateRangeInputModule();
    datePickerModule();
});
