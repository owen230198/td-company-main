var loadingPage = function(){
    $(document).ready(function(){
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
        $(".modalAction").find("iframe").attr("src", src);
    });
    $('.modalAction').on('hidden.bs.modal', function () {
        $(window.parent.document).find('#actionModal').find('iframe').attr("src",'');
    })
};

var closeDataPopup = function(reload = false)
{
    $(window.parent.document).find('#actionModal').find('.close_action_popup').trigger('click');
    if (reload) {
        window.parent.location.reload();
    }
}

var closeModalAction = function()
{
    $(document).on('click', '.__close_modal_action', function(event){
        event.preventDefault();
        closeDataPopup();
    });
}

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
            $(this).select2({
                allowClear: true,
                placeholder: '',
                language: {
                    noResults: function() {
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
    let select_multiple = section.find('select.__multiple_select');
    if (select_multiple.length > 0) {
        select_multiple.each(function(){
            let note = $(this).attr('note');
            let url = $(this).attr('url');
            $(this).select2({
                placeholder: note,
                ajax: {
                    url: url,
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data.options, function(option) {
                                return {
                                    id: option.value,
                                    label: option.label
                                };
                            })
                        };
                    },
                    cache: true
                }
            });
        });
    }
}

var initInputModuleAfterAjax = function(section)
{
    selectAjaxModule(section);
    multipleSelectModule(section);
    selectConfig(section);
    fileProcessV2Module(section);
    enableButtonSubmit();
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
            })
            .done(function(data){
                if (data.code == 100) {
                    swal('Không thành công', data.message, 'error');
                }else{
                    let value = '{"id":"'+data.id+'","dir":"'+data.dir+'","path":"'+data.path+'","name":"'+data.name+'"}'
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

var confirmImportSupply = function()
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
    }else if(['paper'].includes(type)){
        wh_table = 'print_warehouses';    
    }else{
        wh_table = 'square_warehouses';
    }
    return getBaseRoute('get-data-json-linking?except_linking=1&table='+wh_table+'&field_search=name&type='+type);
}

var selectTypeSuppWarehouse = function()
{
    $(document).on('change', 'select.__wh_select_type', function(event){
        event.preventDefault();
        let parent = $(this).closest('.__module_select_type_warehouse');
        let value = $(this).val();
        let url =  getUrlLinkingWarehouseSize(value);
        let select_size = parent.find('select.__wh_select_size');
        select_size.val('');
        select_size.data('id', '');
        select_size.data('label', '');
        select_size.data('url', url);
        if (!empty(value)) {
            select_size.attr('readonly', false);    
        }else{
            select_size.attr('readonly', true);   
        }
        initInputModuleAfterAjax(parent);
    })
}

var selectTypeWorker = function()
{
    $(document).on('change', 'select.__worker_select_type', function(event){
        event.preventDefault();
        let parent = $(this).closest('.__module_select_type_worker');
        let value = $(this).val();
        let url =  getBaseRoute('get-data-json-linking?table=w_users&field_search=name&type='+value);
        let select_worker = parent.find('select.__worker_select_worker');
        select_worker.data('url', url);
        if (!empty(value)) {
            select_worker.attr('readonly', false);    
        }else{
            select_worker.attr('readonly', true);   
        }
        initInputModuleAfterAjax(parent);
    })
}

var moduleSelectStyleProduct = function()
{
    $(document).on('change', '.__select_product_category', function(event) {
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
        .done(function(data){
            if (typeof data === 'object' && data.code == 100) {
            swal('Không thành công', data.message, 'error');
            }else{
                if (!empty(data)) {
                    select_style.html(data);
                    select_style.attr('disabled', false);
                    select_style.closest('.__style_select').fadeIn();   
                }else{
                    select_style.attr('disabled', true);
                    select_style.closest('.__style_select').fadeOut();
                }
            }
            $('#loader').delay(200).fadeOut(500); 
        })
    });
}

var passwordChangeInput = function()
{
    $(document).on('click', 'button.__pass_change', function(event){
        event.preventDefault();
        let pass_input = $(this).parent().find('input[type=password]');
        let i = $(this).find('i')
        if (pass_input.attr('disabled') == 'disabled') {
            i.toggleClass('fa-times');
            i.removeClass('fa-pencil-square-o');
            pass_input.prop('disabled', false);
        }else{
            i.removeClass('fa-times');
            i.toggleClass('fa-pencil-square-o');
            pass_input.prop('disabled', true);   
        }
    });
}

var fileProcessV2Module = function(section = $('.base_content'))
{
    let file_uplaod_v2 = section.find('.__browse_file_v2_button');
    if (file_uplaod_v2.length > 0) {
        file_uplaod_v2.each(function(){
            let browseFile = $(this);
            let resumable = new Resumable({
                target: getBaseRoute('upload-chunnked-file'),
                query:{_token:getCsrfToken()} ,// CSRF token
                headers: {
                    'Accept' : 'application/json'
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
                let value = '{"id":"'+data.id+'","dir":"'+data.dir+'","path":"'+data.path+'","name":"'+data.name+'"}'
                let input_value = parent.find('input.__file_value');
                input_value.val(value);
                parent.find('.__file_preview').fadeIn(200);
                $('#loader').delay(200).fadeOut(500); 
                if (data.name.length > 18) {
                    parent.find('.__file_name').text(data.name.substr(0,18)+'...  ');
                }else{
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
var addSuppBuyModule = function()
{
  $(document).on('click', 'button.add_supp_buy_button', function(event){
    event.preventDefault();
    let list_section = $(this).closest('.json_supply_buy').find('.list_supply_buy');
    let item = list_section.find('.item_supp_buy');
    let index = parseInt(item.last().data('index')) + 1;
    let url = 'add-supply-buying?index='+index;
    ajaxViewTarget(url, list_section, list_section, 2);
  });
}

var removeParentElement = function()
{
    $(document).on('click', '.remove_parent_element_button', function(event){
        event.preventDefault();
        $(this).parent().remove();
      });
}

var confirmBuying = function()
{
    $(document).on('click', 'button.__confirm_buying', function(event){
        event.preventDefault();
        let id = $(this).data('id');
        ajaxBaseCall({
            url: getBaseRoute('confirm-supply-buy/'+id),
            type: 'POST'
        });
    });
}

var changeInputPriceBuying = function()
{
    $(document).on('change keyup', 'input.__buying_change_input', function(event){
        event.preventDefault();
        let _this = $(this);
        let item = _this.closest('.item_supp_buy');
        let price = getEmptyDefault(item.find('input.__buying_price_input').val(), 0, 'float');
        let qty = getEmptyDefault(item.find('input.__buying_qty_input').val(), 0, 'number');
        item.find('.__buying_total_input').val(price*qty);
        let parent = _this.closest('.json_supply_buy');
        let list_item = parent.find('.item_supp_buy');
        let buying_total = 0;
        list_item.each(function(){
            let total_item_buy = getEmptyDefault($(this).find('input.__buying_total_input').val(), 0, 'number');
            buying_total += total_item_buy;
        });
        parent.find('input.__buying_total_amount_input').val(buying_total);
    });
}

var confirmBought = function()
{
    $(document).on('click', 'button.__confirm_bought', function(e) {
        e.preventDefault();
        let _this = $(this);
        id = _this.data('id');
        let form = _this.closest('form');
        ajaxBaseCall({
            url: getBaseRoute('confirm-supply-bought/'+id),
            type: 'POST',
            data: form.serialize()
        });
    });
}

var confirmImportSupplyBuy = function()
{
    $(document).on('click', 'button.__confirm_warehouse_imported', function(event) {
        event.preventDefault();
        let id = $(this).data('id');
        ajaxBaseCall({
            url: 'confirm-warehouse-imported/'+id,
            type: 'POST'
        });
    });
}

var KCSTakeInReqLoadView = function()
{
    $(document).on("click", "button.__product_takein_req", function (event) {
        event.preventDefault();
        let modal = $("#actionModal");
        let id = $(this).data("id");
        modal.find("iframe").attr("src", getBaseRoute('kcs-take-in-req/'+id));
        modal.modal('show');
    });
}

var productListSupplyProcess = function()
{
    $(document).on("click", "button.__product_list_supp_process", function (event) {
        event.preventDefault();
        let modal = $("#actionModal");
        let id = $(this).data("id");
        modal.find("iframe").attr("src", getBaseRoute('list-supply-process?product='+id));
        modal.modal('show');
    });
}

var confirmImportProductWarehouse = function()
{
    $(document).on('click', 'button.__confirm_product_warehouse', function(event) {
        event.preventDefault();
        let id = $(this).data('id');
        ajaxBaseCall({
            url: 'confirm-product-warehouse/'+id,
            type: 'POST'
        });
    });
}

var productWarehouseHistory = function()
{
    $(document).on("click", "button.__product_warehouse_history", function (event) {
        event.preventDefault();
        let modal = $("#actionModal");
        let id = $(this).data("id");
        modal.find("iframe").attr("src", getBaseRoute('product-warehouse-history/'+id));
        modal.modal('show');
    });
}

var showKcsAfterPrintPopup = function(id, qty, name){
    swal({
        title: "KCS sản phẩm sau in",
        // text:"Nhập " + "số tờ in "+name+" đã đạt yêu cầu để thợ in được xác nhận lương.",
        content: {
            element: "input",
            attributes: {
                placeholder: "Nhập số lượng đạt yêu cầu (tối đa: "+qty+")",
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
           
        }else{
            let txt = "Bạn sẽ xác nhận chấm công cho thợ "+value_qty+" tờ in "+name.toLowerCase()+" đã in đạt yêu cầu. ";
            if (qty - parseInt(value_qty) > 0) {
                txt += qty - parseInt(value_qty)+" tờ in chưa đạt yêu cầu sẽ được gửi yêu cầu sản xuất lại.";
            }
            swal({
                title: "Chắc chắn rằng "+value_qty+" tờ in đã đạt yêu cầu ?",
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
                        url: 'after-print-kcs/'+id,
                        type: 'POST',
                        data: {qty:value_qty},
                    })
                    .done(function(data) {
                        let title = data.code == 200 ? 'Thành công' : 'Không thành công';
                        let key = data.code == 200 ? 'success' : 'error';
                        if (!empty(data.message)) {
                            swal(title, data.message, key).then(function() {
                                if (data.code == 200) {
                                    window.location.reload();
                                }else{
                                    showKcsAfterPrintPopup(id, qty, name);   
                                }
                            });
                        }else{
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

var kscAfterPrintModule = function()
{
    $(document).on("click", 'button.__confirm_worker_salary', function(event) {
        event.preventDefault();
        let qty = $(this).data("qty");
        let name = $(this).data("name");
        let id = $(this).data("id");
        showKcsAfterPrintPopup(id, qty, name);
    });
}

var reworkButtonModule = function()
{
    $(document).on("click", "button.__confirm_rework", function (event) {
        event.preventDefault();
        let modal = $("#actionModal");
        let id = $(this).data("id");
        modal.find("iframe").attr("src", getBaseRoute('product-require-rework/'+id));
        modal.modal('show');
    });
}

var showConfirmNoReworkPopup = function(id, qty, name){
    let pro_name = name.toLowerCase();
    console.log(pro_name);
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
           
        }else{
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
                        url: 'product-require-rework/'+id,
                        type: 'POST',
                        data: {status:"not_need_rework"},
                    })
                    .done(function(data) {
                        let title = data.code == 200 ? 'Thành công' : 'Không thành công';
                        let key = data.code == 200 ? 'success' : 'error';
                        if (!empty(data.message)) {
                            swal(title, data.message, key).then(function() {
                                if (data.code == 200) {
                                    window.location.reload();
                                }else{
                                    showConfirmNoReworkPopup(id, qty, name);   
                                }
                            });
                        }else{
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

var noReworkButtonModule = function()
{
    $(document).on('click', 'button.__not_need_rework', function(event){
        event.preventDefault();
        let qty = $(this).data("qty");
        let name = $(this).data("name");
        let id = $(this).data("id");
        showConfirmNoReworkPopup(id, qty, name);
    })
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
    selectTypeWorker();
    passwordChangeInput();
    moduleSelectStyleProduct();
    fileProcessV2Module();
    addSuppBuyModule();
    removeParentElement();
    confirmBuying();
    changeInputPriceBuying();
    confirmBought();
    confirmImportSupplyBuy();
    KCSTakeInReqLoadView();
    closeModalAction();
    productListSupplyProcess();
    confirmImportProductWarehouse();
    productWarehouseHistory();
    kscAfterPrintModule();
    reworkButtonModule();
    noReworkButtonModule();
});
