var setAdvanceCostOrder = function()
{
    $(document).on('keyup change', '.__order_advance_input', function(event) {
        event.preventDefault();
        let parent = $(this).closest('.__order_field_module');
        let advance = $(this).val();
        let total = parent.find('.__order_total_input').val();
        let rest = total - advance;
        let rest_val = rest > 0 ? rest : 0;
        parent.find('.__order_rest_input').val(rest_val);  
    });
}

var moduleVATOrder = function()
{
    $(document).on('change', 'input.__vat_order_checkbox', function(event){
        event.preventDefault();
        let parent = $(this).closest('.__order_field_module');
        let vat_per = $(this).val() == 1 ? getEmptyDefault($(this).attr('vat_per'), 0, 'float') : 0;
        let total = getEmptyDefault(parent.find('.__quote_total_input').val(), 0, 'float');
        let add_per = total*vat_per/100;
        let order_amount = total+add_per;
        parent.find('input.__order_total_input').val(order_amount);
        parent.find('.__order_advance_input').trigger('change');
    });
}

var confirmTypeRefresh = function(link, form_data)
{
    swal({
        title: "Chọn thông số cập nhật",
        text: "Thay đổi này sẽ cập nhật chi phí đơn hàng hoặc lợi nhuận đơn hàng ?",
        icon: "warning",
        buttons: {
            1: {
                text: "Chi phí đơn hàng",
                value: "1",
            },
            2: {
                text: "% lợi nhuận đơn",
                value: "2",
            },
            cancel: {
                text: "Hủy bỏ",
                value: null,
                visible: true,
            }
        },
    }).then((value) => {
        switch (value) {
            case "1":
                ajaxBaseCall({
                    url:link + '?type_refresh=1', 
                    type:'POST', 
                    data:form_data
                });
                break;
            case "2":
                ajaxBaseCall({
                    url:link +'?type_refresh=2', 
                    type:'POST', 
                    data:form_data
                });
                break;
            default:
                swal.close();
        }
    });
}

var applyOrderStep = function()
{
    $(document).on('click', '.__apply_order', function(event){
        event.preventDefault();
        let form = $(this).closest('.__form_order');
        let stage = $(this).data('stage');
        let type = $(this).data('type');
        let form_data = form.serialize();
        let id = $(this).data('id');
        let link = getBaseRoute('apply-order/'+stage+'/'+type+'/'+id);
        return confirmTypeRefresh(link, form_data);
    })
}

var submitOrderForm = function() {
    $('form.__form_order').submit(function(event) {
        event.preventDefault();
        let link = $(this).attr('action');
        let form_data = $(this).serialize();
        return confirmTypeRefresh(link, form_data);
    });
}

var planHandleElevateModule = function()
{
    $(document).on('keyup change', 'input.input_elevate_change', function(event){
        event.preventDefault();
        let parent = $(this).closest('.plan_handle_elevate_module');
        let supp_qty = parseInt(parent.find('input.plan_input_supp_qty').val());
        let inhouse = getEmptyDefault(parent.find('.__inhouse').text(), 0, 'float');
        let elevate = parseInt(parent.find('input.plan_input_elevate').val());
        let nqty = parseInt(parent.find('input.pro_nqty_input').val());
        if (supp_qty > 0) {
            parent.find('.__rest').parent().fadeIn();
            parent.find('.__takeout').parent().fadeIn(); 
            let total_elevate = 0;
            let product_qty = 0;
            if (supp_qty > inhouse) {
                parent.find('.__rest').text(0);
                let lack = supp_qty - inhouse;
                parent.find("input[name*='lack']").val(lack);
                parent.find('.__takeout').text(inhouse);
                parent.find('input.__avaliable_qty_supp_plan').val(inhouse);
                parent.find('.__lack').text(lack);
                parent.find('.__lack').parent().fadeIn(); 
                total_elevate = inhouse*elevate; 
                product_qty = inhouse*nqty;   
            }else{
                parent.find("input[name*='lack']").val(0);
                parent.find('.__rest').text(inhouse - supp_qty);
                parent.find('.__takeout').text(supp_qty);
                parent.find('input.__avaliable_qty_supp_plan').val(supp_qty);
                parent.find('.__lack').text(0);
                parent.find('.__lack').parent().fadeOut();
                total_elevate = supp_qty*elevate; 
                product_qty = supp_qty*nqty;  
            }
            parent.data('take', product_qty)
            let input_total_elevate = parent.find('input.plan_input_total_elevate')
            input_total_elevate.val(total_elevate);
            input_total_elevate.trigger('change');
        }else{
            parent.find('.__takeout').parent().fadeOut();
            parent.find('.__rest').parent().fadeOut();  
            parent.find('.__lack').parent().fadeOut();    
        }
    });

    $(document).on('change', 'input.plan_input_total_elevate', function(event){
        event.preventDefault();
        updateHandleWareHouse($(this));
    });

    $(document).on('keyup change', 'input.plan_input_warehouse_size', function(event)
    {
        event.preventDefault();
        updateHandleWareHouse($(this));
    });
}

var fixWidthSupplyChangeInput = function(){
    $(document).on('change keyup', 'input.__fix_width_supp_handle_input', function(event){
        event.preventDefault();
        let parent = $(this).closest('.__handle_supply_item');
        let fix_size = getEmptyDefault(parent.find('.fixSizeTakeOutInput').val(), 0, 'float');
        let nqty = getEmptyDefault(parent.find('.fixNqtytInput').val(), 0, 'float');
        let pro_qty = getEmptyDefault(parent.find('.fixProQtyInput').val(), 0, 'float');
        let compent_percent = getEmptyDefault(parent.data('percent'), 0, 'float');
        let base_total = Math.ceil(pro_qty / nqty);
        let add_qty = base_total * compent_percent / 100;
        let total = Math.ceil(base_total + add_qty);
        parent.find('.fixQtyInput').val(total);
        let total_need = total * fix_size;
        parent.find('input.fixTotalSupplyInput').val(total_need);
        if (!empty(total_need)) {
            let inhouse = getEmptyDefault(parent.find('.__inhouse').text(), 0, 'float');
            parent.find('.__rest').parent().fadeIn();
            parent.find('.__takeout').parent().fadeIn(); 
            if (total_need > inhouse) {
                parent.find('.__rest').text(0);
                let lack = total_need - inhouse;
                parent.find("input[name*='lack']").val(lack);
                parent.find('.__takeout').text(inhouse);
                parent.find('input.__avaliable_qty_supp_plan').val(inhouse);
                parent.find('.__lack').text(lack);
                parent.find('.__lack').parent().fadeIn();
                parent.data('take', inhouse);     
            }else{
                parent.find("input[name*='lack']").val(0);
                parent.find('.__rest').text(inhouse - total_need);
                parent.find('.__takeout').text(total_need);
                parent.find('input.__avaliable_qty_supp_plan').val(total_need);
                parent.find('.__lack').text(0);
                parent.find('.__lack').parent().fadeOut();
                parent.data('take', total_need);  
            }
            updateHandleWareHouse($(this));
        }else{
            parent.find('.__takeout').parent().fadeOut();
            parent.find('.__rest').parent().fadeOut();  
            parent.find('.__lack').parent().fadeOut();    
        }
    });
}

var updateHandleWareHouse = function(obj)
{
    let parent = obj.closest('.__handle_supply_item');
    let size = parent.find('input.plan_input_warehouse_size');
    let bool = true;
    size.each(function(){
        if ($(this).val() <= 0) {
            bool = false;    
        }
    });
    if (bool == true) {
        let supp_qty = parseInt(parent.find('input.__avaliable_qty_supp_plan').val());
        parent.find('input.plan_input_warehouse_qty').val(supp_qty);    
    }
}

var planGetNeddSupply= function(parent)
{
    let base = parent.data('need');
    let take = 0;
    parent.find('.__handle_supply_item').each(function(){
        take += $(this).data('take');
    });
    return base - take;
}

var planChoseSupplyModule = function()
{
    $(document).on('change', 'select.__select_in_warehouse', function(event)
    {
        event.preventDefault();
        let _this = $(this);
        let parent = _this.closest('.__supply_handle_list');
        let item = _this.closest('.__handle_supply_item');
        item.data('take', 0);
        let need = planGetNeddSupply(parent);
        let type = parent.data('type');
        let target = item.find('.__handle_supply_detail_ajax');
        let over_supply = item.find('.__over_supply');
        if (over_supply.length > 0) {
            over_supply.fadeIn();
        }
        let value = _this.val();
        let url = 'select-supply-warehouse?supply='+value+'&need='+need;
        if (!empty(value)) {
            $('#loader').fadeIn(200);
            $.ajax({
                url: getBaseRoute(url),
                type: 'GET'
            })
            .done(function(obj){
                if (obj.code == 100) {
                    swal('Không thành công', obj.message, 'error');    
                }else{
                    data = obj.data;
                    target.fadeIn();
                    target.find('.__inhouse').text(data.inhouse);
                    afterPlanSelectSupply(type, data, target, item);
                    if (type == 'paper') {
                        item.find('input.__qty_supp_plan').val(need);       
                    }else if (type == 'plate'){
                        item.find('input.pro_qty_input').val(need);           
                    }else if(type == 'fix_width'){
                        target.find('.__sizeFixWidth').text(data.fix_width);
                    }
                }
                $('#loader').delay(200).fadeOut(500); 
            })
        }else{
            target.fadeOut();
            target.find('.__inhouse').text(0);
            afterPlanSelectSupply(type, data, target, item, true);
        }
    });
}

var afterPlanSelectSupply = function(type, data, target, item, reset = false) 
{
    if (reset) {
        target.find("input[name*='qty']").val(0);
        target.find('.__takeout').text(0);
        item.data('take', 0);
        target.find('.__rest').text(0);
        target.find("input[name*='lack']").val(0);
        target.find('input.__nqty_supp_plan').val(0);
        target.find('.__lack').parent().fadeOut();
        target.find('.__lack').text(0); 
    }else{
        if (type == 'hank' || type == 'magnet') {
            target.find("input[name*='qty']").val(data.takeout);
            target.find('.__takeout').text(data.takeout);
            item.data('take', data.takeout);
            target.find('.__rest').text(data.rest);
            target.find("input[name*='lack']").val(data.lack);
            target.find('.__lack').text(data.lack);
            if (data.lack == 0) {
                target.find('.__lack').parent().fadeOut();    
            }else{
                target.find('.__lack').parent().fadeIn();    
            }
        }else if (type == 'paper') {
            let nqty_input = target.find('input.__nqty_supp_plan');
            nqty_input.trigger('change');
        }else if(type == 'plate') {
            target.find('input.input_elevate_change').trigger('change');
        }else if(type == 'fix_width') {
            target.find('input.fixNqtytInput').trigger('change');
        }
    }
}

var planAddSupplyHandle = function()
{
    $(document).on('click', 'button.__supply_handle_button_add', function(event){
        event.preventDefault();
        let parent = $(this).closest('.__module_multiple_handle_supply');
        let ajax_target = parent.find('.__supply_handle_list');
        let param = $(this).data('param');
        let items = ajax_target.find('.__handle_supply_item');
        let index = items.length;
        let except_value = '';
        items.each(function(){
            let select_supply = $(this).find('select.__select_in_warehouse');
            select_supply.attr('readonly', true);
            except_value += ''+select_supply.val()+',';
            let nqty_input = $(this).find('input.__nqty_supp_plan');
            if (nqty_input.length > 0) {
                nqty_input.attr('readonly', true);
            }

            let nqty_supp = $(this).find('input.pro_nqty_input');
            if (nqty_supp.length > 0) {
                nqty_supp.attr('readonly', true);
            }
        })
        let url = 'add-select-supply-handle?index='+index+''+param+'&except_value='+except_value;
        ajaxViewTarget(url, ajax_target, ajax_target, 2);
    });
}

var planRemoveSupplyHandle = function()
{
    $(document).on('click', 'button.__supply_handle_btn_remove', function(event){
        let parent = $(this).closest('.__supply_handle_list');
        let items = parent.find('.__handle_supply_item');
        if (items.length  == 2) {
            items.each(function(){
                $(this).find('select.__select_in_warehouse').attr('readonly', false);
                let nqty_input = $(this).find('input.__nqty_supp_plan');
                if (nqty_input.length > 0) {
                    nqty_input.attr('readonly', false);
                }
                let nqty_supp = $(this).find('input.pro_nqty_input');
                if (nqty_supp.length > 0) {
                    nqty_supp.attr('readonly', false);
                }
            })
        }
        $(this).parent().remove();
    })
}

var planHandleSupplyQty = function()
{
    $(document).on('keyup change', 'input.__supp_plan_qty_change', function(event){
        event.preventDefault();
        let parent = $(this).closest('.__handle_supply_item');
        let need_qty = getEmptyDefault(parent.find('input.__qty_supp_plan').val(), 0, 'float');
        let nqty = getEmptyDefault(parent.find('input.__nqty_supp_plan').val(), 0, 'float');
        let total_supp = !empty(nqty) ? Math.ceil(need_qty/nqty) : 0;
        parent.find('input.__total_qty_supp_plan').val(total_supp);
        let inhouse = getEmptyDefault(parent.find('.__inhouse').text(), 0, 'float');
        if (total_supp > 0) {
            parent.find('.__rest').parent().fadeIn();
            parent.find('.__takeout').parent().fadeIn(); 
            if (total_supp > inhouse) {
                parent.find('.__rest').text(0);
                let lack = total_supp - inhouse;
                parent.find("input[name*='lack']").val(lack);
                parent.find('.__takeout').text(inhouse);
                parent.find('input.__avaliable_qty_supp_plan').val(inhouse);
                parent.find('.__lack').text(lack);
                parent.find('.__lack').parent().fadeIn();
                parent.data('take', inhouse);     
            }else{
                parent.find("input[name*='lack']").val(0);
                parent.find('.__rest').text(inhouse - total_supp);
                parent.find('.__takeout').text(total_supp);
                parent.find('input.__avaliable_qty_supp_plan').val(total_supp);
                parent.find('.__lack').text(0);
                parent.find('.__lack').parent().fadeOut();
                parent.data('take', total_supp);  
            }
            updateHandleWareHouse($(this));
        }else{
            parent.find('.__takeout').parent().fadeOut();
            parent.find('.__rest').parent().fadeOut();  
            parent.find('.__lack').parent().fadeOut();    
        }
    });
}

var KCSRequireToWarehouse = function()
{
    $(document).on('change', '.__expertise_status_select', function(event) {
        event.preventDefault();
        let _this = $(this);
        let prob_module = _this.closest('form').find('.problerm_module');
        if (_this.val() == EXP_STT_PROBLEM) {
            prob_module.fadeIn();
        }else{
            prob_module.fadeOut();
        }
    });

    $(document).on('change', '.__expertise_select_handle', function(event){
        event.preventDefault();
        let _this = $(this);
        let rework_module = _this.closest('.problerm_module').find('.__rework_module');
        console.log(rework_module);
        if (_this.val() == 'rework') {
            rework_module.fadeIn();
        }else{
            rework_module.fadeOut();
        }
    });
}

var searchIngredient = function ()
{ 
	$('.form_search_ingredient .base_table_form_search form').submit(function(event) {
		event.preventDefault();
        let target = $('.ajax_data_ingredient');
		ajaxViewTarget('search-table/print_warehouses', target, target, 1, $(this).serialize());
	});
    $(document).on('click', '.ajax_data_ingredient .page-link', function(event){
        event.preventDefault();
        let url = $(this).attr('href');
        let target = $('.ajax_data_ingredient');
        ajaxViewTarget(url + '&get_table_view_ajax=table_base_view', target, target, 1, '', false);
    })
}

var inventoryAjaxForm = function ()
{
	$('form.inventoryFormAjax').submit(function(event) {
		event.preventDefault();
        let target = $('.ajax_data_inventory');
		ajaxViewTarget($(this).attr('action'), target, target, 1, $(this).serialize(), false);
	});

    $(document).on('change', '.__select_type_supply_search_history', function(event){
        event.preventDefault();
        let type = $(this).val();
        let url = 'field-search-supply-history?type=' + type;
        let target = $(this).closest('form').find('.inventory_ajax_field_search');
        if (!empty(type)) {
            ajaxViewTarget(url, target, target);
        }else{
            target.html('');
        }
    });

    $(document).on('click', '.__inventory_undo_search', function(event) {
        event.preventDefault();
        let form = $(this).closest('form');
        let select_type = form.find('.__select_type_supply_search_history');
        select_type.val('');
        select_type.trigger('change');
        initInputModuleAfterAjax(form);
    })
}

var inventoryExportExcel = function ()
{
    $('.inventory_export_excel').click(function(event){
        event.preventDefault();
        let form = $(this).closest('form.inventoryFormAjax');
        let param = form.serialize();
        let export_route = $(this).data('route');
        let url = getBaseRoute(export_route + '?' + param);
        window.parent.location.href = url;
    })
}

var viewDebtGroup = function () {
    $(document).on('click', 'button.__view_debt_goup_btn', function (event) {
        event.preventDefault();
        let form = $(this).closest('.__debt_base_view').find('#form-search');
        let params = form.serialize();
        let url = form.attr('action') + '?' + params + '&group=true';
        window.parent.location.href = url;
    });
}

var debtExport = function () {
    $(document).on('click', 'button.__export_data_debt', function (event) {
        event.preventDefault();
        let _this = $(this);
        let form = _this.closest('.__debt_base_view').find('#form-search');
        let params = form.serialize();
        let table = _this.data('table');
        let group = _this.data('group');;
        let url = getBaseRoute('export-data-debt/') + table + '?group=' + group + '&' + params;
        window.location.href = url;
    });
}

var addItemMoveWarehouse = function ()
{
    $(document).on('click', 'button.__add_item_move_warehouse', function (event) {
        event.preventDefault();
        let _this = $(this);
        let list_section = _this.closest('.__multiple_product_warehouse_module').find('.__list_product_move_warehouse');
        let item = list_section.find('.__item_move_warehouse');
        let index = getEmptyDefault(item.last().data('index'), 0, 'number') + 1;
        let view = 'product_warehouses.move_multiples';
        let url = 'ajax-respone/returnItemJson?view_return=' + view + '&index=' + index;
        $('#loader').fadeIn(200);
        $.ajax({ 
            url: url, 
            type: 'GET' 
        }).done(function (html) {
            list_section.append(html);
            let section_class = list_section.find('.__item_move_warehouse').last();
            initInputModuleAfterAjax(section_class);
            $('#loader').delay(200).fadeOut(500);
        })
    });

    $(document).on('click', '.__remove_move_warehouse_item', function (event) {
        event.preventDefault();
        let _this = $(this);
        let item = _this.closest('.__item_move_warehouse');
        item.remove();
    });
}

var moduleSelectDataMoveWarehouse = function()
{
    $(document).on('change', 'select.__move_warehouse_select_take', function(event){
        event.preventDefault();
        let _this = $(this);
        let parent = _this.closest('.__item_move_warehouse');
        let form_control = parent.find('.__data_move_field');
        let take = _this.val();
        form_control.each(function(){
            $(this).val('');
            $(this).data('id', '');
            $(this).data('label', '');
        });
        let select_product = parent.find('.__move_warehouse_select_product');
        let url = 'get-data-json-linking?table=product_warehouses&field_search=name&field_value=id&except_linking=0&warehouse_type=' + take;
        select_product.data('url', getBaseRoute(url));
        initInputModuleAfterAjax(parent);
    });

    $(document).on('change', '.__move_warehouse_select_product', function (e) {
        e.preventDefault();
        let _this = $(this);
        let parent = _this.closest('.__item_move_warehouse');
        let id = _this.val();
        let url = 'ajax-respone/getDataProductMoveWarehouse?id=' + id;
        let select_to = parent.find('.__move_warehouse_to');
        $.ajax({
            url: getBaseRoute(url),
            type: 'GET',
        })
		.done(function (data) {
            if (data.code == 100) {
                swal('Không thành công', data.message, 'error');
            }
            let warehouse_id = data.warehouse_type;
            let warehouse_label = data.warehouse_label;
            parent.find('.__move_warehouse_qty').val(data.qty);
            select_to.val(warehouse_id);
            select_to.data('id', warehouse_id);
            select_to.data('label', warehouse_label);
            parent.find('.__move_warehouse_note').val(data.note);
            selectAjaxModule(select_to.parent());
		});
    });
}

$(function(){
    setAdvanceCostOrder(); 
    moduleVATOrder();
    applyOrderStep();
    submitOrderForm();
    planHandleElevateModule();
    fixWidthSupplyChangeInput();
    planChoseSupplyModule();
    planAddSupplyHandle();
    planRemoveSupplyHandle();
    planHandleSupplyQty();
    KCSRequireToWarehouse();
    searchIngredient();
    inventoryAjaxForm();
    inventoryExportExcel();
    viewDebtGroup();
    debtExport();
    addItemMoveWarehouse();
    moduleSelectDataMoveWarehouse();
});