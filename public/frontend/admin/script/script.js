var loadingPage = function () {
    $(document).ready(function () {
        $('.lds-ring').remove();
    });
}
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
    $(document).on('keypress paste', 'input[name=username]', function (e) {
        let txt = String.fromCharCode(e.which);
        if (!txt.match(/[A-Za-z0-9&. ]/) && e.which !== 8) {
            return false;
        }
        if (e.which === 32) return false;
    });
};

var passwordInputPrevent = function () {
    $(document).on('keypress paste', 'input[name*=password]', function (e) {
        if (e.which === 32) return false;
    });
};

var checkMultiRecordModule = function () {
    $(document).on("change", "input.c_one_remove", function (event) {
        event.preventDefault();
        getValueMultipleCheckbox();
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
        getValueMultipleCheckbox();
    });
};

var getValueMultipleCheckbox = function () {
    var arr = $("input.c_one_remove:checked");
    var str = "";
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
        let src = $(this).data("src");
        let size = !empty($(this).data("size")) ? $(this).data("size") : '';
        let modal = $(".modalAction");
        modal.parent().attr("class", size);
        modal.find("iframe").attr("src", src);
    });
    $('.modalAction').on('hidden.bs.modal', function () {
        let modal = $(this);
        modal.find('iframe').attr("src", '');
        modal.parent().attr("class", '');
    })
};

var closeDataPopup = function (reload = false) {
    $(window.parent.document).find('#actionModal').find('.close_action_popup').trigger('click');
    if (reload) {
        window.parent.location.reload();
    }
}

var closeModalAction = function () {
    $(document).on('click', '.__close_modal_action', function (event) {
        event.preventDefault();
        closeDataPopup();
    });
}

var selectConfig = function (section = $('.page_content')) {
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

var menuUserHeader = function () {
    $(document).on('click', '.user_name', function (event) {
        event.preventDefault();
        let user_menu = $(this).closest('.header_menu_user').find('.header_menu_user_list');
        user_menu.slideToggle(200);
    });
}

var menuSidebar = function () {
    $(document).on('click', '.admin_sidebar .sidebar_menu>li', function (event) {
        let child_menu = $(this).find('ul');
        let list_child = $('.admin_sidebar .sidebar_menu>li').find('ul');
        list_child.each(function () {
            if ($(this).css('display') === 'block') {
                $(this).parent().removeClass('active');
                $(this).slideUp(200);
            }
        });
        if (child_menu.css('display') === 'none') {
            $(this).toggleClass('active');
            child_menu.slideToggle(200);
        } else {
            $(this).removeClass('active');
            child_menu.slideUp(200);
        }
    });
}

var selectAjaxModule = function (section = $('.page_content ')) {
    let select_ajax = section.find('select.select_ajax');
    if (select_ajax.length > 0) {
        select_ajax.each(function () {
            let url = $(this).data('url');
            $(this).select2({
                allowClear: true,
                placeholder: '',
                language: {
                    noResults: function () {
                        return "Không có dữ liệu được tìm thấy !";
                    }
                },
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
        })
    }

}

var phoneInputPrevent = function () {
    $(document).on('keypress keydown', 'input[name*=phone]', function (event) {
        let key = event.charCode ? event.charCode : event.keyCode;

        // Cho phép các phím điều khiển như backspace (8), delete (46), và các phím mũi tên (37-40)
        if (event.ctrlKey || event.metaKey || key === 8 || key === 46 || (key >= 37 && key <= 40)) {
            return true;
        }

        // Cho phép các phím số (48-57) và phím số trên bàn phím số (96-105)
        if ((key >= 48 && key <= 57) || (key >= 96 && key <= 105)) {
            return true;
        }
        
        // chặn dấu "."
        if (key === 110) {
            event.preventDefault();
            return false;
        }

        // Cho phép chữ cái (a-z và A-Z)
        if ((key >= 65 && key <= 90) || (key >= 97 && key <= 122)) {
            return true;
        }

        // Ngăn chặn các ký tự khác, bao gồm cả dấu chấm trên bàn phím số (110)
        event.preventDefault();
        return false;
    });

    $(document).on('paste', 'input[name*=phone]', function (event) {
        event.preventDefault();
        let clipboardData = event.originalEvent.clipboardData || window.clipboardData;
        let pastedData = clipboardData.getData('text').trim();
        if (/^[a-zA-Z0-9]*$/.test(pastedData)) {
            $(this).val(function (_, currentVal) {
                return currentVal + pastedData;
            });
        } else {
            swal('Không thành công', 'Số điện thoại không được phép chứa ký tự đặc biệt', 'error');
            return false;
        }
    });
};

var multipleSelectModule = function (section = $('.page_content')) {
    let select_multiple = section.find('select.__multiple_select');
    if (select_multiple.length > 0) {
        select_multiple.each(function () {
            let note = $(this).attr('note');
            let url = $(this).attr('url');
            $(this).select2({
                placeholder: note,
                language: {
                    noResults: function () {
                        return "Không có dữ liệu được tìm thấy !";
                    }
                },
                data: {
                    ids: $(this).attr('value'),
                },
                ajax: {
                    url: url,
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: data.map(function (option) {
                                return {
                                    id: option.id,
                                    text: option.label
                                };
                            })
                        };
                    },
                    cache: true
                }
            });
            let initialValues = $(this).attr('value');
            let select = $(this);
            if (initialValues.length > 0) {
                JSON.parse(initialValues).forEach(function (item) {
                    let newOption = new Option(item.label, item.id, true, true);
                    select.append(newOption).trigger('change');
                });
            }
        });
    }
}

var initInputModuleAfterAjax = function (section) {
    selectAjaxModule(section);
    multipleSelectModule(section);
    selectConfig(section);
    fileProcessV2Module(section);
    enableButtonSubmit();
}

var fileProcessModule = function () {
    //upload file
    $(document).on('change', 'input.__file_upload_input', function (event) {
        event.preventDefault();
        let files = $(this)[0].files;
        if (files.length > 0) {
            let form_data = new FormData();
            form_data.append('file', files[0]);
            let table = $(this).data('table');
            if (!empty(table)) {
                form_data.append('table', table);
            }
            let field = $(this).data('field');
            if (!empty(field)) {
                form_data.append('field', field);
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
            }).done(function (data) {
                    if (data.code == 100) {
                        swal('Không thành công', data.message, 'error');
                    } else {
                        let value = '{"id":"' + data.id + '","dir":"' + data.dir + '","path":"' + data.path + '","name":"' + data.name + '"}'
                        input_value.val(value);
                        parent.find('.__file_preview').fadeIn(200);
                        if (data.name.length > 18) {
                            parent.find('.__file_name').text(data.name.substr(0, 18) + '...  ');
                        } else {
                            parent.find('.__file_name').text(data.name);
                        }
                    }
                    $('#loader').fadeOut(200);
                })
        } else {
            swal('Không thành công', 'Dữ liệu file không đúng', 'error');
        }
    });
}

var receiveCommand = function () {
    $(document).on('click', '.__receive_command', function (event) {
        event.preventDefault();
        let table = $(this).data('table');
        let id = $(this).data('id');
        $('#loader').fadeIn(200);
        $.ajax({
            url: getBaseRoute('receive-command/' + table + '/' + id),
            type: 'POST'
        }).done(function (data) {
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
                        window.location = getBaseRoute('view/c_designs?default_data=%7B"status"%3A"designing"%7D');
                        break;
                    default:
                        window.location.reload();
                }
            });
        })
        $('#loader').delay(200).fadeOut(500);
    });
}

var confirmCLoneDataTable = function()
{
    $(document).on('click', '.__clone_item_confirm', function(event){
        event.preventDefault();
        let _this = $(this);
        let url = _this.attr('href');
        let title = _this.attr('title');
        let name = _this.data('name');
        swal({
            title: 'Sao chép ' + title,
            text: 'Bạn chắc chắn muốn sao chép dữ liệu của ' + title + ' ' + name + ' ?',
            icon: 'info',
            buttons: true,
            confirmButtonColor: "#459300",
            buttons: ['Hủy', 'Sao chép']
        }).then((action) => {
            if (action) {
                window.location = url;   
            }
        }); 
    });
}

var reImportEmulsion = function(id, back_url) {
    swal({
        title: "Nhập lại kho cuộn nhũ đã cắt còn thừa",
        content: {
            element: "div",
            attributes: {
                innerHTML: `<div class="__re--import_emlulsion">
                    <input name="width" class="swal-content__input mb-1" placeholder="Nhập khổ chiều rộng">
                    <input name="weight" class="swal-content__input mb-1" placeholder="Nhập số kg còn lại">
                    </div>`
            },
        },
        buttons: {
            cancel: {
                text: "Hủy",
                value: "cancel",
                visible: true
            },
            complete: {
                text: "Hoàn tất",
                value: "complete",
                visible: true
            }
        },
    }).then((value) => {
        switch(value) {
            case "cancel":
                break;
            case "complete":
                let parent = $('.__re--import_emlulsion');
                let width = parent.find('input[name="width"]').val();
                let weight = parent.find('input[name="weight"]').val();
                if (empty(width) || empty(weight)) {
                    swal('error', "Bạn cần nhập nhập thông tin khổ chiều rộng và số kg nhập kho !", 'error').then(function () {
                        reImportEmulsion(id, back_url);
                        return;
                    }); 
                }else{
                    ajaxBaseCall({
                        url: getBaseRoute('re-import-emulsion/' + id),
                        type: 'POST',
                        'data': {_token: getCsrfToken(), width: width, weight:weight},
                    });
                }
                break;
            case "skip":
                window.location = back_url;
                break;
            default:
                window.location = back_url;
        }
    }); 
}

var confirmTakeOutSupply = function () {
    $(document).on('click', '.__confirm_ex_supp', function (event) {
        event.preventDefault();
        let _this = $(this);
        let id = _this.data('id');
        let form = _this.closest('form');
        let supp_type = _this.data('supp_type');
        $('#loader').fadeIn(200);
        $.ajax({
            url: getBaseRoute('take-out-supply/' + id),
            type: 'POST',
            data: form.serialize(),
        }).done(function (data) {
            if (supp_type == 'emulsion') {
                if (data.code == 200) {
                    swal({
                        title: "Nhập lại kho cuộn nhũ đã cắt ?",
                        text: 'Nếu cắt cuộn nhũ còn thừa buộc phải nhập lại kho, nếu không vui lòng bỏ qua',
                        icon: 'info',
                        buttons: true,
                        confirmButtonColor: "#459300",
                        buttons: ['Bỏ qua', 'Nhập lại kho']
                    }).then((action) => {
                        if (action) {
                            reImportEmulsion(id, data.url);    
                        } else {
                            window.location = data.url;
                        }
                    });   
                }else{
                    swal('Không thành công !', data.message, 'error');
                }
            }else{
                let title = data.code == 200 ? 'Thành công' : 'Không thành công';
                let key = data.code == 200 ? 'success' : 'error';
                if (!empty(data.message)) {
                    if (!empty(data.url)) {
                        swal(title, data.message, key).then(function () {
                            window.location = data.url;
                        });
                    }else{
                        swal(title, data.message, key);
                    }
                } else {
                    swal('Lỗi không xác định !', data.message, 'error');
                }
                $('#loader').delay(200).fadeOut(500);
            }
        })
        $('#loader').delay(200).fadeOut(500);
        
    });
}

var confirmImportSupply = function () {
    $(document).on('click', '.__confirm_im_supp', function (event) {
        event.preventDefault();
        let id = $(this).data('id');
        let table = $(this).data('table');
        ajaxBaseCall({
            url: getBaseRoute('take-in-supply/' + id + '?table=' + table),
            type: 'POST'
        });
    });
}

var moduleSelectAjaxChild = function () {
    $(document).on('change', 'select.__select_parent', function (event) {
        event.preventDefault();
        let value = $(this).val();
        let parent = $(this).closest('.__module_select_ajax_value_child');
        let url = parent.attr('link') + '?param=' + value;
        let ajax_target = parent.find('select.__select_child');
        ajaxViewTarget(url, ajax_target, ajax_target);
    })

    let select_parent = $('select.__select_parent');
    if (select_parent.length > 0) {
        select_parent.each(function () {
            __this = $(this);
            let value = __this.val();
            let parent = __this.closest('.__module_select_ajax_value_child');
            let ajax_target = parent.find('select.__select_child');
            let selected = ajax_target.val();
            let url = parent.attr('link') + '?param=' + value + '&selected=' + selected;
            if (!empty(value) && parent.length > 0 && ajax_target.length > 0) {
                ajaxViewTarget(url, ajax_target, ajax_target, 1, '', true, false);
            }
        })
    }
}

var getUrlLinkingWarehouseSize = function (type) {
    if (['carton', 'rubber', 'styrofoam', 'mica'].includes(type)) {
        wh_table = 'supply_warehouses';
    } else if (['magnet'].includes(type)) {
        wh_table = 'other_warehouses';
    } else if (['paper'].includes(type)) {
        wh_table = 'print_warehouses';
    }else if (['nilon', 'metalai', 'cover', 'decal', 'silk', 'emulsion', 'skrink'].includes(type)) {
        wh_table = 'square_warehouses';
    } else {
        wh_table = 'extend_warehouses';
    }
    url = getBaseRoute('get-data-json-linking?except_linking=1&table=' + wh_table + '&field_search=name');
    if (wh_table != 'extend_warehouses') {
        url += '&type=' + type;    
    }
    return url;
}

var changeSelectTypeTrigger = function(select, reset_input = 0)
{
    let parent = select.closest('.__module_select_type_warehouse');
    let value = select.val();
    let url = getUrlLinkingWarehouseSize(value);
    let select_size = parent.find('select.__wh_select_size');
    select_size.data('url', url);
    if (reset_input == 1) {
        select_size.val('');
        select_size.data('id', '');
        select_size.data('label', '');
        let module_qty = parent.closest('.__c_supply_warehouse').find('.__ajax_qty_type');
        if (module_qty.length > 0) {
            let url_get_qty = 'qty-by-supply-type?type=' + value;
            ajaxViewTarget(url_get_qty, module_qty, module_qty);
        }
    }
    initInputModuleAfterAjax(parent);
}

var selectTypeSuppWarehouse = function () {
    let select_type_c_supp = $('select.__wh_select_type');
    $(document).on('change', 'select.__wh_select_type', function (event) {
        event.preventDefault();
        changeSelectTypeTrigger($(this), 1)
    });
    if (select_type_c_supp.length > 0) {
        select_type_c_supp.each(function () {
            changeSelectTypeTrigger($(this))   
        })
    }
}

var selectSupplyToOrigin = function()
{
    $(document).on('change', '.__select_supply_to_origin ', function(event){
        event.preventDefault();
        let _this = $(this);
        let parent = _this.closest('.__data_supply_buying_conf');
        let supply_id = _this.val();
        let cate = parent.data('cate');
        let param = '&type=' + cate + '&supply_id=' + supply_id + '&field_search=name';
        let select_origin = parent.find('.__origin_select');
        if (select_origin.length > 0) {
            select_origin.data('url', getBaseRoute('get-data-json-linking?table=supply_origins' + param));
            select_origin.val('');
        }
        let select_qtv = parent.find('.__qtv_select');
        if (select_qtv.length > 0) {
            select_qtv.data('url', getBaseRoute('get-data-json-linking?table=supply_prices' + param));
            select_qtv.val('');
        }
        selectAjaxModule(parent);
    });
    $('.__qtv_select').change(function(event){
        event.preventDefault();
        let _this = $(this);
        let id = _this.val();
        let parent = _this.closest('.__data_supply_buying_conf');
        $.ajax({
            url: getBaseRoute('ajax-respone/getPricePrurchaseById?id=' + id),
            type: 'GET'
        })
        .done(function (data) {
            if (!empty(data.price_purchase)) {
                _this.data('price_purchase', data.price_purchase);
                parent.find('.__buying_qty_input').trigger('change');
            }
        })
    })
}

var getUrlLinkingCPaymentObject = function (type) {
    if (empty(type)) {
        return '';
    }
    let table = '';
    if (type == 'order') {
        table = 'customers';
    } else if (type == 'supplier') {
        table = 'warehouse_providers';
    } else if (type == 'partner') {
        table = 'partners';
    }
    url = getBaseRoute('get-data-json-linking?&table=' + table + '&field_search=name');
    return url;
}

var changeSelectTypePaymentReqTrigger = function(select, reset_input = 0)
{
    let parent = select.closest('.__module_select_type_payment_require');
    let value = select.val();
    let url = getUrlLinkingCPaymentObject(value);
    let select_size = parent.find('select.__pm_select_object');
    select_size.data('url', url);
    if (reset_input == 1) {
        select_size.val('');
        select_size.data('id', '');
        select_size.data('label', '');
    }
    initInputModuleAfterAjax(parent);
}

var selectTypePaymentRequire = function () {
    let select_type_c_supp = $('select.__select_type_c_payment');
    $(document).on('change', 'select.__select_type_c_payment', function (event) {
        event.preventDefault();
        changeSelectTypePaymentReqTrigger($(this), 1)
    });

    if (select_type_c_supp.length > 0) {
        select_type_c_supp.each(function () {
            changeSelectTypePaymentReqTrigger($(this))   
        })
    }
}

var selectTypeWorker = function () {
    $(document).on('change', 'select.__worker_select_type', function (event) {
        event.preventDefault();
        let parent = $(this).closest('.__module_select_type_worker');
        let value = $(this).val();
        let url = getBaseRoute('get-data-json-linking?table=w_users&field_search=name&type=' + value);
        let select_worker = parent.find('select.__worker_select_worker');
        select_worker.data('url', url);
        if (!empty(value)) {
            select_worker.attr('readonly', false);
        } else {
            select_worker.attr('readonly', true);
        }
        initInputModuleAfterAjax(parent);
    })
}

var moduleSelectStyleProduct = function () {
    $(document).on('change', '.__select_product_category', function (event) {
        event.preventDefault();
        let parent = $(this).closest('.__style_product_select_module');
        let category = $(this).val();
        let select_style = parent.find('select.__select_product_style');
        let url = 'get-list-option-ajax/product_styles?category=' + category;
        $('#loader').fadeIn(200);
        $.ajax({
            url: getBaseRoute(url),
            type: 'GET'
        })
        .done(function (data) {
            if (typeof data === 'object' && data.code == 100) {
                swal('Không thành công', data.message, 'error');
            } else {
                if (!empty(data)) {
                    select_style.html(data);
                    select_style.attr('disabled', false);
                    select_style.closest('.__style_select').fadeIn();
                } else {
                    select_style.attr('disabled', true);
                    select_style.closest('.__style_select').fadeOut();
                }
            }
            $('#loader').delay(200).fadeOut(500);
        })
    });
}

var passwordChangeInput = function () {
    $(document).on('click', 'button.__pass_change', function (event) {
        event.preventDefault();
        let pass_input = $(this).parent().find('input[type=password]');
        let val = pass_input.val();
        let i = $(this).find('i')
        if (pass_input.attr('disabled') == 'disabled') {
            i.toggleClass('fa-times');
            i.removeClass('fa-pencil-square-o');
            pass_input.prop('disabled', false);
        } else {
            i.removeClass('fa-times');
            i.toggleClass('fa-pencil-square-o');
            pass_input.prop('disabled', true);
        }
    });
}

var fileProcessV2Module = function (section = $('.page_content')) {
    let file_uplaod_v2 = section.find('.__browse_file_v2_button');
    if (file_uplaod_v2.length > 0) {
        file_uplaod_v2.each(function () {
            let browseFile = $(this);
            let resumable = new Resumable({
                target: getBaseRoute('upload-chunnked-file'),
                query: { _token: getCsrfToken() },// CSRF token
                headers: {
                    'Accept': 'application/json'
                },
                testChunks: false,
                throttleProgressCallbacks: 1,
            });
            resumable.assignBrowse(browseFile[0]);

            resumable.on('fileAdded', function (file) { // trigger when file picked
                showProgress();
                $('#loader').fadeIn(200);
                resumable.upload() // to actually start uploading.
            });

            resumable.on('fileProgress', function (file) { // trigger when file progress update
                updateProgress(Math.floor(file.progress() * 100));
            });

            let parent = $(this).closest('.file_upload_v2_module');
            let progress = parent.find('.progress');

            resumable.on('fileSuccess', function (file, response) { // trigger when file upload complete
                data = JSON.parse(response);
                let value = '{"id":"' + data.id + '","dir":"' + data.dir + '","path":"' + data.path + '","name":"' + data.name + '"}'
                let input_value = parent.find('input.__file_value');
                input_value.val(value);
                parent.find('.__file_preview').fadeIn(200);
                $('#loader').delay(200).fadeOut(500);
                if (data.name.length > 18) {
                    parent.find('.__file_name').text(data.name.substr(0, 18) + '...  ');
                } else {
                    parent.find('.__file_name').text(data.name);
                }
                progress.hide();
            });

            resumable.on('fileError', function (file, response) { // trigger when there is any error
                swal('Không thành công', 'Lỗi không thể upload file', 'error');
            });

            function showProgress() {
                progress.find('.progress-bar').css('width', '0%');
                progress.find('.progress-bar').html('0%');
                progress.find('.progress-bar').removeClass('bg-success');
                progress.show();
            }

            function updateProgress(value) {
                progress.find('.progress-bar').css('width', `${value}%`)
                progress.find('.progress-bar').html(`${value}%`)
            }
        })
    }
}
var addSuppBuyModule = function () {
    $(document).on('click', 'button.add_supp_buy_button', function (event) {
        event.preventDefault();
        let list_section = $(this).closest('.json_supply_buy').find('.list_supply_buy');
        let item = list_section.find('.item_supp_buy');
        let index = getEmptyDefault(item.last().data('index'), 0, 'number') + 1;
        let type = list_section.closest('form').find('.__supply_buying_select_type').val();
        if (empty(type)) {
            swal('Không thành công', "Bạn cần chọn loại vật tư trước", 'error')
        }else{
            let url = 'add-supply-buying?index=' + index + '&supp_type=' + type;
            ajaxViewTarget(url, list_section, list_section, 2);
        }
       
    });

    $(document).on('change', '.__select_supp_type_buying', function (event) {
        event.preventDefault();
        let _this = $(this);
        let parent = _this.closest('.item_supp_buy');
        let index = parent.data('index');
        let url = 'get-view-buying-supply-type?index=' + index + '&supp_type=' + _this.val();
        let view_target = parent.find('.ajax_supply_buying_data');
        ajaxViewTarget(url, view_target, view_target);
    });
}

var selectTypeSupplyBuying = function()
{
    $(document).on('change', 'select.__supply_buying_select_type', function(event){
        event.preventDefault();
        let _this = $(this);
        let parent = _this.closest('form');
        let selects = parent.find('.__select_supp_type_buying');
        let type = _this.val();
        if (selects.length > 0) {
            selects.each(function(){
                $(this).val(type);
                $(this).trigger('change');   
            });
        }
    })
}

var addDataLinkingModule = function () {
    $(document).on('click', 'button.add_data_linking_button', function (event) {
        event.preventDefault();
        let list_section = $(this).closest('.list_linking_view_update').find('.list_linking_data');
        let item = list_section.find('.item_data_linking');
        let index = parseInt(item.last().data('index')) + 1;
        let url = 'add-linking-data?index=' + index;
        ajaxViewTarget(url, list_section, list_section, 2);
    });
}

var addItemChildLinking = function()
{
    $(document).on('click', '.__add_item_child_linking_button', function (event) {
        event.preventDefault();
        let _this = $(this);
        let parent = _this.closest('.list_item_child_linking');
        let list_module = parent.find('.list_child_linking_data');
        let items = list_module.find('.item_child_linking');
        let index = getEmptyDefault(items.last().data('index'), 0, 'float') + 1;
        let url = 'ajax-respone/insertItemChildLinking?index=' + index + '&table=' + _this.data('table') + '&key_name=' + _this.data('key');
        ajaxViewTarget(url, list_module, list_module, 2);
    });
}

var removeParentElement = function () {
    $(document).on('click', '.remove_parent_element_button', function (event) {
        event.preventDefault();
        $(this).parent().remove();
        let id = $(this).data('id');
        let table = $(this).data('table');
        if (!empty(id)) {
            swal({
                title: 'Xóa dữ liệu ',
                text: 'Bạn chắc chắn muốn Xóa vĩnh viễn dữ liệu dữ này ?',
                icon: 'info',
                dangerMode: true,
                buttons: true,
                confirmButtonColor: "#459300",
                buttons: ['Hủy', 'Xóa dữ liệu']
            }).then((action) => {
                if (action) {
                    ajaxBaseCall({
                        url: getBaseRoute('remove?ajax=1'),
                        type: 'DELETE',
                        data: { remove_id: id, table: table }
                    });
                }
            });
        }
    });
}

var submitOnlylinkingData = function () {
    $(document).on('click', 'button.__submit_only_linking_data', function (event) {
        event.preventDefault();
        let customer = $(this).data('customer');
        let parent = $(this).closest('.list_linking_view_update');
        ajaxBaseCall({ url: getBaseRoute('process-data-represent/' + customer), type: 'POST', data: parent.find('.form-control').serialize() });
    })
}

var calcTotalSupplyBuying = function(json_supp_module)
{
    let list_item = json_supp_module.find('.item_supp_buy');
    let buying_total = 0;
    list_item.each(function () {
        let total_item_buy = getEmptyDefault($(this).find('input.__buying_total_input').val(), 0, 'float');
        buying_total += total_item_buy;
    });
    let ship_price = getEmptyDefault(json_supp_module.find('input.__buying_ship_price').val(), 0, 'float');
    let other_price = getEmptyDefault(json_supp_module.find('input.__buying_other_price').val(), 0, 'float');
    let total_input = json_supp_module.find('input.__buying_total_amount_input');
    let total_amount = buying_total + ship_price + other_price;
    total_input.val(price_format(total_amount));
    total_input.trigger('change');
}

var totalSupplyBuyingInput = function()
{
    $(document).on('change keyup paste', 'input.__buying_change_total_input', function(event){
        event.preventDefault();
        let parent = $(this).closest('.json_supply_buy');
        calcTotalSupplyBuying(parent);
    });
}

var changeInputPriceBuying = function () {
    $(document).on('change keyup', '.__buying_change_input', function (event) {
        event.preventDefault();
        let _this = $(this);
        let item = _this.closest('.item_supp_buy');
        let length = getEmptyDefault(item.find('input.__buying_length').val(), 1, 'float');
        let width = getEmptyDefault(item.find('input.__buying_width').val(), 1, 'float');
        let qtv = getEmptyDefault(item.find('.__qtv_select').data('price_purchase'), 1, 'float');
        let price = getEmptyDefault(item.find('input.__buying_price_input').val(), 0, 'float');
        let qty = getEmptyDefault(item.find('input.__buying_qty_input').val(), 0, 'number');
        let total_input = item.find('.__buying_total_input');
        total_value = length * width * qtv * price * qty;
        total_input.val(price_format(total_value));
        total_input.trigger('change');
        let parent = _this.closest('.json_supply_buy');
        calcTotalSupplyBuying(parent);
    });
}

var confirmBought = function () {
    $(document).on('click', 'button.__confirm_bought', function (e) {
        e.preventDefault();
        let _this = $(this);
        let id = _this.data('id');
        let status = _this.data('status');
        let form = _this.closest('form');
        ajaxBaseCall({
            url: getBaseRoute('confirm-supply-bought/' + status + '/' + id),
            type: 'POST',
            data: form.serialize()
        });
    });
}

var confirmImportSupplyBuy = function () {
    $(document).on('click', 'button.__confirm_warehouse_imported', function (event) {
        event.preventDefault();
        let id = $(this).data('id');
        let form = $(this).closest('form');
        ajaxBaseCall({
            url: 'confirm-warehouse-imported/' + id,
            type: 'POST',
            data: form.serialize()
        });
    });
}

var KCSTakeInReqLoadView = function () {
    $(document).on("click", "button.__product_takein_req", function (event) {
        event.preventDefault();
        let modal = $("#actionModal");
        let id = $(this).data("id");
        modal.find("iframe").attr("src", getBaseRoute('kcs-take-in-req/' + id));
        modal.modal('show');
    });
}

var productListSupplyProcess = function () {
    $(document).on("click", "button.__product_list_supp_process", function (event) {
        event.preventDefault();
        let modal = $("#actionModal");
        let id = $(this).data("id");
        modal.find("iframe").attr("src", getBaseRoute('list-supply-process?product=' + id));
        modal.modal('show');
    });
}

var confirmImportProductWarehouse = function () {
    $(document).on('click', 'button.__confirm_product_warehouse', function (event) {
        event.preventDefault();
        let modal = $("#actionModal");
        let id = $(this).data("id");
        modal.find("iframe").attr("src", getBaseRoute('confirm-product-warehouse/' + id));
        modal.modal('show');
    });
}

var productWarehouseHistory = function () {
    $(document).on("click", "button.__product_warehouse_history", function (event) {
        event.preventDefault();
        let modal = $("#actionModal");
        let id = $(this).data("id");
        modal.find("iframe").attr("src", getBaseRoute('product-warehouse-history/' + id));
        modal.modal('show');
    });
}

var showKcsAfterPrintPopup = function (id, qty, name) {
    swal({
        title: "KCS sản phẩm sau in",
        // text:"Nhập " + "số tờ in "+name+" đã đạt yêu cầu để thợ in được xác nhận lương.",
        content: {
            element: "input",
            attributes: {
                placeholder: "Nhập số lượng đạt yêu cầu (tối đa: " + qty + ")",
            },
        },
        buttons: ["Hủy", "Xác nhận"],
    }).then((value_qty) => {
        if (value_qty === null) {
            return;
        }
        if (value_qty === "" || parseInt(value_qty) > qty) {
            swal('Không thành công', "Số lượng bạn nhập không hợp lệ !", 'error').then(() => {
                showKcsAfterPrintPopup(id, qty, name);
            });;

        } else {
            let txt = "Bạn sẽ xác nhận chấm công cho thợ " + value_qty + " tờ in " + name.toLowerCase() + " đã in đạt yêu cầu. ";
            if (qty - parseInt(value_qty) > 0) {
                txt += qty - parseInt(value_qty) + " tờ in chưa đạt yêu cầu sẽ được gửi yêu cầu sản xuất lại.";
            }
            swal({
                title: "Chắc chắn rằng " + value_qty + " tờ in đã đạt yêu cầu ?",
                text: txt,
                icon: 'info',
                buttons: true,
                dangerMode: true,
                confirmButtonColor: "#459300",
                buttons: ['Hủy', 'Xác nhận chấm công']
            }).then((value_conf) => {
                if (value_conf) {
                    $('#loader').fadeIn(200);
                    $.ajax({
                        url: 'after-print-kcs/' + id,
                        type: 'POST',
                        data: { qty: value_qty },
                    })
                        .done(function (data) {
                            let title = data.code == 200 ? 'Thành công' : 'Không thành công';
                            let key = data.code == 200 ? 'success' : 'error';
                            if (!empty(data.message)) {
                                swal(title, data.message, key).then(function () {
                                    if (data.code == 200) {
                                        window.location.reload();
                                    } else {
                                        showKcsAfterPrintPopup(id, qty, name);
                                    }
                                });
                            } else {
                                window.location.reload();
                            }
                            $('#loader').delay(200).fadeOut(500);
                        })
                } else {
                    swal("Đã hủy", "Đã hủy xác nhận chấm công !", "error").then(() => {
                        showKcsAfterPrintPopup(id, qty, name);
                    });
                }
            });
        }
    });
}

var kscAfterPrintModule = function () {
    $(document).on("click", 'button.__confirm_worker_salary', function (event) {
        event.preventDefault();
        let qty = $(this).data("qty");
        let name = $(this).data("name");
        let id = $(this).data("id");
        showKcsAfterPrintPopup(id, qty, name);
    });
}

var reworkButtonModule = function () {
    $(document).on("click", "button.__confirm_rework", function (event) {
        event.preventDefault();
        let modal = $("#actionModal");
        let id = $(this).data("id");
        modal.find("iframe").attr("src", getBaseRoute('product-require-rework/' + id));
        modal.modal('show');
    });
}

var showConfirmNoReworkPopup = function (id, qty, name) {
    let pro_name = name.toLowerCase();
    swal({
        title: "Sản xuất lại sản phẩm",
        // text:"Nhập " + "Xác nhận không sản xuất lại sản phẩm " + pro_name,
        content: {
            element: "textarea",
            attributes: {
                placeholder: "Nhập lí do không sản xuất lại (Ví dụ: Khách hàng đồng ý " + qty + " sản phẩm sẽ nhận ở lần đặt sau)",
            },
        },
        buttons: ["Hủy", "Xác nhận"],
    }).then((value) => {
        if (!value) throw null;
        let note = value = document.querySelector(".swal-content__textarea").value;
        if (note == "") {
            swal('Không thành công', "Bạn chưa nhập lí do không sản xuất lại sản phẩm !", 'error').then(() => {
                showConfirmNoReworkPopup(id, qty, name);
            });;

        } else {
            swal({
                title: "Xác nhận không sản xuất lại " + qty + " sản phẩm",
                text: "Bạn có chắc chắn không sản xuất lại sản phẩm " + pro_name + " vì: " + note,
                icon: 'info',
                buttons: true,
                dangerMode: true,
                confirmButtonColor: "#459300",
                buttons: ['Hủy', 'Xác nhận']
            }).then((value_conf) => {
                if (value_conf) {
                    $('#loader').fadeIn(200);
                    $.ajax({
                        url: 'product-require-rework/' + id,
                        type: 'POST',
                        data: { status: "not_need_rework", note: note },
                    })
                        .done(function (data) {
                            let title = data.code == 200 ? 'Thành công' : 'Không thành công';
                            let key = data.code == 200 ? 'success' : 'error';
                            if (!empty(data.message)) {
                                swal(title, data.message, key).then(function () {
                                    if (data.code == 200) {
                                        window.location.reload();
                                    } else {
                                        showConfirmNoReworkPopup(id, qty, name);
                                    }
                                });
                            } else {
                                window.location.reload();
                            }
                            $('#loader').delay(200).fadeOut(500);
                        })
                } else {
                    swal("Đã hủy", "Đã hủy xác nhận không sản xuất lại!", "error").then(() => {
                        showConfirmNoReworkPopup(id, qty, name);
                    });
                }
            });
        }
    });
}

var noReworkButtonModule = function () {
    $(document).on('click', 'button.__not_need_rework', function (event) {
        event.preventDefault();
        let qty = $(this).data("qty");
        let name = $(this).data("name");
        let id = $(this).data("id");
        showConfirmNoReworkPopup(id, qty, name);
    })
}

var baseExportTable = function () {
    $(document).on('click', '.__base_export_btn', function (event) {
        event.preventDefault();
        let param = $('#form-search').serialize();
        let table = $(this).data('table');
        window.parent.location.href = getBaseRoute('export/' + table + '?' + param);
    });
}

var baseTriggerEvent = function (event_e, parent_e, trigger_e, event_name = 'click', trigger_name = 'click') {
    $(document).on(event_name, event_e, function (event) {
        event.preventDefault();
        let parent = $(this).closest(parent_e);
        parent.find(trigger_e).trigger(trigger_name);
    });
}

var ModuleImportExcel = function () {
    baseTriggerEvent('.__import_button_btn', '.__import_excel_module', '.__import_table_input');
    $(document).on('change', '.__import_table_input', function (event) {
        event.preventDefault();
        let table = $(this).data('table');
        let files = $(this)[0].files;
        let url = 'import-excel/' + table;
        let data = new FormData();
        data.append('file', files[0]);
        ajaxBaseCall({ url: url, type: 'POST', data: data, contentType: false, processData: false, dataType: 'json' });
    });
}

var removeNotifyButton = function () {
    $(document).on('click', 'button.remove_notify_button', function (event) {
        event.preventDefault();
        let id = $(this).data('id');
        if (!empty(id)) {
            $('#loader').fadeIn(200);
            $.ajax({
                url: getBaseRoute('remove?ajax=1'),
                type: 'DELETE',
                data: { remove_id: id, table: 'notifies' }
            }).done(function (data) {
                let title = data.code == 200 ? 'Thành công' : 'Không thành công';
                let key = data.code == 200 ? 'success' : 'error';
                swal(title, data.message, key).then(() => {
                    window.location = getBaseRoute('');
                });
            })
            $('#loader').delay(200).fadeOut(500);
        }
    });
}

var moduleAuthentication = function()
{
    $(document).on('change', 'input.__login_username_input', function(event){
        event.preventDefault();
        let _this = $(this);
        let parent = _this.closest('.__base_login_module');
        let password_input = parent.find('input.__login_password_input');
        password_input.val('');
        password_input.trigger('keyup');
        let username = _this.val();
        let auth_key = parent.data('auth_key');
        if (!empty(username) && !empty(auth_key)) {
            $('#loader').fadeIn(200);
            $.ajax({
                url: getBaseRoute('get-password-remembered?auth_key=' +auth_key+ '&username=' + username),
                type: 'GET',
            }).done(function (password) {
                if (!empty(password)) {
                    password_input.val(password);
                    parent.find('input.__login_remembered_input').val(1);   
                }else{
                    password_input.val('');
                    password_input.trigger('keyup');    
                }   
            })
            $('#loader').delay(200).fadeOut(500);
        }
    })
    $(document).on('keyup', 'input.__login_password_input', function(event){
        event.preventDefault();
        let parent = $(this).closest('.__base_login_module');
        let remembered_input = parent.find('input.__login_remembered_input');
        if (remembered_input.length > 0) {
            remembered_input.val(0);
        }
    });
}

var selectImportProductMethod = function () {
    $(document).on('change', '.__select_import_product_warehouse_method', function(event){
        event.preventDefault();
        let _this = $(this);
        let action = _this.val();
        let parent = _this.closest('form.__import_product_warehouse_form');
        let module = parent.find('.ajax_data_field_import_product');
        let warehouse_type = getEmptyDefault(parent.find('.__expertise_select_warehouse_type').val(), '');
        let url = 'ajax-respone/ajaxFieldImportProductByAction?action=' + action + '&warehouse_type=' + warehouse_type;
        ajaxViewTarget(url, module, module);
    });

    $(document).on('change', '.__expertise_select_warehouse_type', function (e) {
        e.preventDefault();
        let parent = $(this).closest('form.__import_product_warehouse_form');
        let select_method = parent.find('.__select_import_product_warehouse_method');
        select_method.trigger('change');
    })
}

var selectTypeCOrder = function()
{
    $(document).on('change', 'select.__select_type_c_order', function(event){
        event.preventDefault();
        let _this = $(this);
        let type = _this.val();
        let module = _this.closest('.__c_order_action');
        let url = 'ajax-respone/ajaxFieldCOrderByType?type=' + type;
        let where_module = module.find('.__type_c_order_select');
        let customer = where_module.find('select.__select_customer_c_order').val();
        if (!empty(customer)) {
            url += '&customer=' + customer    
        }
        let represent = where_module.find('select.__select_represent_c_order').val();
        if (!empty(represent)) {
            url += '&represent=' + represent    
        }
        let order = where_module.find('input.__hidden_order').val();
        if (!empty(order)) {
            url += '&order=' + order    
        }
        let target = module.find('.__ajax_view_c_order_by_type');
        ajaxViewTarget(url, target, target);
        rest_input = module.find('input.__selling_advance_input');
        rest_input.val('0');
        rest_input.trigger('keyup');
    });

    $(document).on('change', 'select.__select_customer_c_order', function(event){
        event.preventDefault();
        let parent = $(this).closest('.__c_order_action'); 
        let select_represent = parent.find('select.__select_represent_c_order');
        select_represent.val('');
        select_represent.data('id', '');
        select_represent.data('label', '');
        selectConfig(select_represent.parent());
    });

    $(document).on('change', 'select.__select_represent_c_order', function(event){
        event.preventDefault();
        let _this = $(this);
        let parent = _this.closest('.__c_order_action');
        let represent = _this.val(); 
        let url = 'ajax-respone/checkRepreSentPermission?represent=' + represent;
        $.ajax({
            url: url,
            type: 'GET',
        })
		.done(function (data) {
            if (data.code == 100) {
                swal('Không thành công', 'Bạn không có quyền chọn người đại diện, vui lòng liên hệ Admin để được cấp quyền !', 'error').then(function () {
                    _this.val('');
                    _this.data('label', '');
                    _this.data('id', '');
                    selectConfig(_this.parent());
				});
            }
		})
    });
}

var addItemJsonModule = function () {
    $(document).on('click', 'button.add_item_json_button', function (event) {
        event.preventDefault();
        let _this = $(this);
        let parent = _this.closest('.__cost_c_order_module');
        let type = parent.find('.__select_warehouse_type').val();
        let item_type = parent.closest('.__c_order_action').find('.__select_type_c_order').val();
        if (empty(type)) {
            swal('Không thành công', "Bạn cần chọn địa điểm kho trước !", 'error')
        }else{
            let list_section = _this.closest('.__json_data_module').find('.__list_item_json');
            let item = list_section.find('.__item_json');
            let index = getEmptyDefault(item.last().data('index'), 0, 'number') + 1;
            let table = _this.data('table');
            let url = 'ajax-respone/returnItemJson?view_return=' + table + '&index=' + index + '&warehouse_type=' + type + '&item_type=' + item_type;
            $('#loader').fadeIn(200);
            $.ajax({ 
                url: url, 
                type: 'GET' 
            }).done(function (html) {
                list_section.append(html);
                let section_class = list_section.find('.__item_json').last();
                initInputModuleAfterAjax(section_class);
                $('#loader').delay(200).fadeOut(500);
            })
        }
    });
    
    $(document).on('click', 'span.__remove_object_json_item', function (event) {
        event.preventDefault();
        let _this = $(this);
        _this.parent().remove();
        calcTotalProductSelling($('.__cost_c_order_module'));
    });
}

var addItemJsonFieldModule = function () {
    $(document).on('click', 'button.__json_field_button_add', function (event) {
        event.preventDefault();
        let _this = $(this);
        let parent = _this.closest('.__json_field_module');
        let list_section = parent.find('.__list_item_field');
        let item = list_section.find('.__json_field_item');
        let index = getEmptyDefault(item.last().data('index'), 0, 'number') + 1;
        let json = parent.data('json');
        let name = parent.data('name');
        let jsonString = encodeURIComponent(JSON.stringify(json));
        let url = `ajax-respone/returnItemJson?view_return=json_fields&name=`+name+`&jindex=${index}&json=${jsonString}`;
        $('#loader').fadeIn(200);
        $.ajax({ 
            url: url, 
            type: 'GET' 
        }).done(function (html) {
            list_section.append(html);
            let section_class = list_section.find('.__json_field_item').last();
            initInputModuleAfterAjax(section_class);
            $('#loader').delay(200).fadeOut(500);
        })
    });
}

var selectProductSellingModule = function(){
    $(document).on('change', 'select.__select_warehouse_type', function(event){
        event.preventDefault();
        let _this = $(this);
        let parent = _this.closest('.__cost_c_order_module');
        parent.find('.__list_item_json').html('');
        calcTotalProductSelling(parent);
    });

    $(document).on('change', 'select.__select_product_sell', function(event){
        event.preventDefault();
        let _this = $(this);
        let parent = _this.closest('.__item_json');
        let id = _this.val();
        let target = parent.find('input.__selling_price_input_item');
        let name_input = parent.find('input.__selling_input_product_name');
        if (empty(id)) {
            name_input.val('');
            target.val('');
            target.trigger('keyup'); 
            return false;     
        }
        let qty = getEmptyDefault(parent.find('input.__selling_qty_input_item').val(), 0, 'float');
        let url = 'ajax-respone/getPriceProductWarehouse?id=' + id + '&qty=' + qty;
        $.ajax({
            url: url,
            type: 'GET',
        })
		.done(function (data) {
            if (data.code == 100) {
                swal('Không thành công', data.message, 'error').then(function () {
                    _this.val('');
                    target.val(''); 
                    name_input.val('');
                    target.trigger('keyup'); 
				});
            }else{
                name_input.val(data.name);
                target.val(data.price);
                target.trigger('keyup');
            }
		});
    });

    $(document).on('change', 'input.__selling_qty_input_item', function(event) {
        let _this = $(this);
        let parent = _this.closest('.__item_json');
        let qty = getEmptyDefault(_this.val(), 0, 'float');
        let id = getEmptyDefault(parent.find('select.__select_product_sell').val(), 0, 'float');
        let url = 'ajax-respone/getPriceProductWarehouse?id=' + id + '&qty=' + qty + '&check_qty=1';
        if (!empty(id) && !empty(qty)) {
            $.ajax({
                url: url,
                type: 'GET',
            })
            .done(function (data) {
                if (data.code == 100) {
                    swal('Không thành công', data.message, 'error').then(function(){
                        _this.val(0);
                        _this.trigger('change');
                    });
                }
            });  
        }     
    });
}

var calcTotalProductSelling = function(json_selling_module)
{
    let list_item = json_selling_module.find('.__item_json');
    let selling_total = 0;
    list_item.each(function () {
        let total_item = getEmptyDefault($(this).find('input.__selling_total_item_input').val(), 0, 'float');
        selling_total += total_item;
    });
    let other_price = getEmptyDefault(json_selling_module.find('input.__selling_other_price_input').val(), 0, 'float');
    let profit = getEmptyDefault(json_selling_module.find('input.__selling_profit_input').val(), 0, 'float');
    let temp_total = selling_total + other_price;
    let profit_price = getValueByPercent(temp_total, profit);
    
    let total = temp_total + profit_price;
    
    let advance = getEmptyDefault(json_selling_module.find('input.__selling_advance_input').val(), 0, 'float');
    let total_input = json_selling_module.find('input.__selling_total_input');
    total_input.val(price_format(total));
    total_input.trigger('change');
    let rest_input = json_selling_module.find('input.__selling_rest_input');
    rest_input.val(price_format(total - advance));
    rest_input.trigger('change');
}

var countPriceSellingModule = function() {
    $(document).on('change keyup', 'input.__selling_input_count_item', function(event) {
        event.preventDefault();
        let parent = $(this).closest('.__item_json');
        let qty = getEmptyDefault(parent.find('input.__selling_qty_input_item').val(), 0, 'float'); 
        let price = getEmptyDefault(parent.find('input.__selling_price_input_item').val(), 0, 'float'); 
        let total_input = parent.find('input.__selling_total_item_input');
        let total = qty * price;
        let other_price = 0;
        oth_price_module = parent.find('.__item_product_warehouse_other_price');
        let oth_price_input = oth_price_module.find('.__selling_other_price_input_item');
        oth_price_input.each(function(){
            other_price += getEmptyDefault($(this).val(), 0, 'float') * qty;    
        });
        let number_format = price_format(total + other_price);
        total_input.val(number_format);
        total_input.trigger('change');
        calcTotalProductSelling(parent.closest('.__cost_c_order_module'))
    });

    $(document).on('change keyup', 'input.__selling_input_count', function(event) {
        event.preventDefault();
        calcTotalProductSelling($(this).closest('.__cost_c_order_module'));
    });
}

var selectOrderForSelling = function(){
    $(document).on('change', 'select.__select_order_for_selling', function(event){
        event.preventDefault();
        let _this = $(this);
        let parent = _this.closest('.__c_order_action');
        let id = _this.val();
        let url = 'ajax-respone/getAdvanceOrder?id=' + id;
        let target = parent.find('input.__selling_advance_input');
        $.ajax({
            url: url,
            type: 'GET',
        })
		.done(function (data) {
            target.val(data);
            target.trigger('keyup');
		});
    })
}

var confirmTakeOutSelling = function () {
    $(document).on('click', 'button.__confirm_ex_selling', function (event) {
        event.preventDefault();
        let _this = $(this);
        id = _this.data('id');
        let url = 'ajax-respone/confirmTakeSelling?id=' + id;
        let form = _this.closest('form');
        ajaxBaseCall({url:url, type: 'POST', data: form.serialize()});
    });
}



var priceInputModule = function(){
    $(document).on('change keyup', '.price_input_module input.price_input_label', function(event){
        event.preventDefault();
        let _this = $(this);
        let parent = _this.closest('.price_input_module');
        let number =  getExactNumber(_this.val());
        let number_format = price_format(number);
        _this.val(number_format);
        parent.find('input.price_input_value').val(number);
        
    });
}

var viewChartBtn = function () {
    $(document).on('click', 'button.__view_chart_buton', function (event) {
        event.preventDefault();
        let param = $('#form-search').serialize();
        let table = $(this).data('table');
        let field = $(this).data('field');
        let field_by = $(this).data('field_by');
        let url = getBaseRoute('report/viewChart?table=' + table + '&field=' + field + '&field_by=' + field_by + '&nosidebar=1&' + param);
        let modal = $("#actionModal");
        modal.find("iframe").attr("src", url);
        modal.modal('show');
    });
}

var suggestOriginModule = function (){
    $(document).on('change', '.__suggest_supply_provider_price', function(event){
        event.preventDefault();
        let _this = $(this);
        let parent = _this.closest('.item_supp_buy');
        let origin = getEmptyDefault(parent.find('.__origin_select').val(), 0);
        let url = 'ajax-respone/getProviderSuggestBuying' + '?origin=' + origin;
        let select_providers = parent.find('.__provider_suggest_module');
        let price_input = parent.find('.__provider_price_suggest_module');
        $.ajax({
            url: url,
            type: 'GET',
        }).done(function (data) {
            if (!empty(data.id) && !empty(data.price)) {
                select_providers.each(function(){
                    $(this).val(data.id);
                    $(this).data('label', data.label);
                    $(this).data('id', data.id);
                    $(this).data('price', data.price);
                    $(this).data('url', getBaseRoute('get-data-json-linking?except_linking=1&table=provider_prices&field_search=name&origin=' + origin));
                    initInputModuleAfterAjax($(this).closest('.module_sugest_provider_buying'));
                });
                price_input.each(function(){
                    $(this).val(data.price);
                    $(this).trigger('change');
                });
                
            }
		});
    });

    $(document).on('change', '.__provider_suggest_module', function(event){
        event.preventDefault();
        let _this = $(this);
        let price = _this.val();
        let parent = _this.closest('.module_sugest_provider_buying');
        let price_input = parent.find('.__buying_price_input');
        price_input.val(price);
        price_input.trigger('change');
    });
}

$(function () {
    // loadingPage();
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
    selectTypePaymentRequire();
    selectSupplyToOrigin();
    selectTypeWorker();
    passwordChangeInput();
    moduleSelectStyleProduct();
    fileProcessV2Module();
    addSuppBuyModule();
    selectTypeSupplyBuying();
    addDataLinkingModule();
    addItemChildLinking();
    removeParentElement();
    submitOnlylinkingData();
    changeInputPriceBuying();
    totalSupplyBuyingInput();
    confirmBought();
    confirmImportSupply();
    confirmImportSupplyBuy();
    KCSTakeInReqLoadView();
    closeModalAction();
    productListSupplyProcess();
    confirmImportProductWarehouse();
    productWarehouseHistory();
    kscAfterPrintModule();
    reworkButtonModule();
    noReworkButtonModule();
    baseExportTable();
    ModuleImportExcel();
    removeNotifyButton();
    moduleAuthentication();
    selectImportProductMethod();
    selectTypeCOrder();
    addItemJsonModule();
    selectProductSellingModule();
    countPriceSellingModule();
    selectOrderForSelling();
    confirmTakeOutSelling();
    priceInputModule();
    confirmCLoneDataTable();
    viewChartBtn();
    suggestOriginModule();
    addItemJsonFieldModule();
});
