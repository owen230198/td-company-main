var changQtyInput = function () {
    $(document).on('keyup change', 'input.supp_qty_modul_input', function (e) {
        e.preventDefault();
        let parent = $(this).closest('.quantity_supp_module');
        let qty_pro = parseInt(parent.find('input.pro_qty_input').val());
        let nqty = parseInt(parent.find('input.pro_nqty_input').val());
        let plus_direct = getEmptyDefault(parent.data('direct'), 0, 'int');
        let double_supp = parseInt(parent.find('input.double_supp_input').val()) == 1 ? 2 : 1;
        let qty_supp = Math.ceil(qty_pro / nqty) * double_supp;
        let compen_percent = parent.data('percent');
        let plus_to_per = getEmptyDefault(parent.data('perplus'), 0, 'float');
        let per_to_num = Math.ceil(qty_supp * compen_percent / 100) + plus_to_per;
        parent.find('input.compent_percent_input').val(per_to_num);
        let compen_plus = getEmptyDefault(parent.find('input.pro_compent_plus_input').val(), 0, 'float');
        let addqty = per_to_num + compen_plus + plus_direct;
        parent.find('input.supp_qty_input').val(qty_supp + plus_direct);
        parent.find('input.total_supp_qty_input').val(qty_supp + addqty);
        let plan_qty = parent.find('input.plan_input_supp_qty');
        if (plan_qty.length > 0) {
            plan_qty.trigger('change');
        }
    });

    $(document).on('keyup change', 'input.input_pro_qty', function (event) {
        event.preventDefault();
        let parent = $(this).closest('.tab_pane_quote_pro');
        let product_qty = parseInt($(this).val());
        let supp_product_qty = parent.find('.pro_qty_input');
        if (supp_product_qty.length > 0) {
            supp_product_qty.each(function () {
                $(this).val(product_qty);
                $(this).trigger('change');
            })
        }
    });
}

var moduleSelectOtherPaper = function () {
    $(document).on('change', 'select.select_other', function (event) {
        event.preventDefault();
        eParent = $(this).closest('.group_select_other').find('.input_add');
        if ($(this).val() == $(this).data('expland')) {
            eParent.fadeIn();
            eParent.find('input').prop('disabled', false);
        } else {
            eParent.fadeOut();
            eParent.find('input').prop('disabled', true);
        }
    });
}

var GetTodayDate = function () {
    var tdate = new Date();
    var dd = tdate.getDate(); //yields day
    var MM = tdate.getMonth(); //yields month
    var yyyy = tdate.getFullYear(); //yields year
    var str = (MM + 1) + "-" + dd + "-" + yyyy;
    return str;
}

var PrintQuote = function () {
    $(document).on('click', 'button.print_quotes', function (event) {
        event.preventDefault();
        let arrs = document.querySelectorAll('.quote_model');
        let html = '';
        let seri = $(this).data('seri');
        let company = $('.company').text();
        for (let i = 0; i < arrs.length; i++) {
            html += arrs[i].innerHTML;
        }
        str_today = GetTodayDate();
        title = company + ' - ' + seri + ' - ' + str_today;
        let mywindow = window.open('', '', '');
        mywindow.document.write('<html><head><title>' + title + '</title>');
        mywindow.document.write('<base href="' + getBaseRoute('/') + '">');
        mywindow.document.write('<link rel="icon" href="' + getBaseRoute('frontend/admin/images/logo.png') + '" type="image/gif">');
        mywindow.document.write('<link href="' + getBaseRoute('frontend/base/css/bootstrap.min.css') + '" rel="stylesheet">');
        mywindow.document.write('<link href="' + getBaseRoute('frontend/base/css/font-awesome.min.css') + '" rel="stylesheet" type="text/css">');
        mywindow.document.write('<link rel="stylesheet" href="' + getBaseRoute('frontend/admin/css/base.css') + '" type="text/css">');
        mywindow.document.write('<link rel="stylesheet" href="' + getBaseRoute('frontend/admin/css/style.css') + '" type="text/css">');
        mywindow.document.write('<link rel="stylesheet" href="' + getBaseRoute('frontend/admin/css/quote.css') + '" type="text/css">');
        mywindow.document.write('</head><body style="overflow:hidden">');
        mywindow.document.write('<div class="ex_quote_file">');
        mywindow.document.write(html);
        mywindow.document.write('</div>');
        mywindow.document.write('</div">');
        mywindow.document.write('</body></html>');
        mywindow.document.close();
        mywindow.focus();
        setTimeout(function () {
            mywindow.print();
            mywindow.close();
        }, 300);
    });
}

var selectCustomerQuote = function () {
    $(document).on('change', '.select_customer_quote', function (event) {
        event.preventDefault();
        $.ajax({
            url: getBaseRoute('get-view-customer-data?id=' + $(this).val()),
            type: 'GET'
        }).done(function (html) {
            $('.customer_info_quote').html(html);
            selectAjaxModule($('.customer_info_quote'));
            enableButtonSubmit();
        });
    })
}

var chooseRepresentQuote = function() {
    $(document).on('click', 'li.__choose_represent', function(event) {
        event.preventDefault();
        let _this = $(this);
        let parent = _this.parent();
        parent.find('li.__choose_represent').each(function(){
            $(this).removeClass('active');
        })
        _this.toggleClass('active');
        let id = _this.data('id');
        let url  = 'get-view-customer-data?type=represent&id=' + id;
        ajaxViewTarget(url, $('.__ajax_represent_info'), $('.__ajax_represent_info'));
    });
}

var selectSupplyMateralModule = function () {
    $(document).on('change', 'select.__supply_materal_select_module', function (event) {
        event.preventDefault();
        let _this = $(this);
        let parent = _this.closest('.__materal_select_supply_module');
        let materal = _this.val();
        let key_supp = parent.data('key_supp');
        let pro_index = parent.data('pro_index');
        let supp_index = parent.data('supp_index');
        let key_stage = parent.data('key_stage');
        let param = '?materal=' + materal + '&key_supp=' + key_supp + '&pro_index=' + pro_index + '&supp_index=' + supp_index + '&key_stage=' + key_stage;
        let url = 'ajax-respone/getViewQtvByMateral' + param;
        let view_target =  parent.find('.__materal_ajax_qtv');
        ajaxViewTarget(url, view_target, view_target);
        
    });
}

var moduleInputQuantityProduct = function () {
    let input_time;
    $(document).on('keyup', 'input.quote_set_qty_pro_input', function (event) {
        event.preventDefault();
        let quantity = parseInt($(this).val());
        if (quantity > 0) {
            let url = 'get-view-product-quantity?quantity=' + $(this).val();
            let ajax_target = $(this).closest('.quote_handle_section.handle_pro_section').find('.ajax_product_quote_number');
            clearTimeout(input_time)
            input_time = setTimeout(function () {
                ajaxViewTarget(url, ajax_target, ajax_target);
            }, 500)
        }
    });
}

var addSuppModule = function () {
    $(document).on('click', 'button.add_supp_quote_button', function (event) {
        event.preventDefault();
        let list_section = $(this).closest('.module_quote_supp_config').find('.list_supp_item');
        let item = list_section.find('.quote_supp_item');
        let pro_index = $(this).data('product');
        let supp_view = $(this).data('key');
        let supp_index = parseInt(item.last().data('index')) + 1;
        let supp_name = item.first().find('input.quote_receive_paper_name_main').val();
        let pro_qty = item.first().find('input.pro_qty_input ').first().val();
        let url = 'add-supply-quote?pro_index=' + pro_index + '&supp_index=' + supp_index + '&supp_view=' + supp_view + '&supp_name=' + supp_name + '&pro_qty=' + pro_qty;
        ajaxViewTarget(url, list_section, list_section, 2);
    });
}

var addFillFinishModule = function () {
    $(document).on('click', 'button.add_fill_finish_quote_button', function (event) {
        event.preventDefault();
        let list_section = $(this).closest('.section_quote_fill_finish').find('.list_item_fill_finish');
        let item = list_section.find('.quote_fill_finish_item');
        let pro_index = $(this).data('product');
        let findex = parseInt(item.last().data('index')) + 1;
        let view = $(this).data('view');
        let ajax_target = list_section.find('.ajax_ff_quote');
        let url = 'add-fill-finish-quote?pro_index=' + pro_index + '&ff_index=' + findex + '&view=' + view;
        ajaxViewTarget(url, ajax_target, list_section, 2);
    });
}

var removeItemAddedModule = function () {
    $(document).on('click', 'span.remove_ext_element_quote', function (event) {
        event.preventDefault();
        removeItemBaseModule($(this));
    });
}

var setNameProductQuote = function () {
    $(document).on('change', 'input.quote_set_product_name', function (event) {
        event.preventDefault();
        let text = $(this).val() != '' ? $(this).val() : 'Chưa có tên';
        let tabpane = $(this).closest('.tab-pane.tab_pane_quote_pro');
        let li_id = tabpane.attr('id');
        $('a#' + li_id + '-tab').text(text);
        $(this).closest('.config_handle_paper_pro').find('input.__quote_receive_name').each(function () {
            let current_text = $(this).val();
            let match = current_text.match(/\(([^)]+)\)$/);
            if (!empty(match)) {
                if (EXT_NAME_PAPER.includes(match[1].trim())) {
                    text += ' (' + match[1] + ')';     
                }
            }
            $(this).val(text);
        });
        tabpane.data('pname', text);
    })
}

var selectExtNamePaperModule = function () {
    $(document).on('keyup change', 'select.select_ext_name_paper', function (event) {
        event.preventDefault();
        let id = $(this).val();
        let link_ajax = 'get-after-print-view?pro_index=' + pro_index + '&supp_index=' + supp_index + '&id=' + id;
        let ajax_target = parent.find('.paper_ajax_after_print');
        ajaxViewTarget(link_ajax, ajax_target, ajax_target);
    });
}

var selectProductCategory = function () {
    $(document).on('change', 'select.select_quote_procategory', function (event) {
        event.preventDefault();
        let proindex = $(this).attr('proindex');
        let paper_name = $(this).closest('.config_handle_paper_pro').find('input.quote_set_product_name').val();
        let pro_qty = $(this).closest('.config_handle_paper_pro').find('input.input_pro_qty').val();
        let url = 'get-view-product-structure?category=' + $(this).val() + '&proindex=' + proindex + '&paper_name=' + paper_name + '&pro_qty=' + pro_qty;
        let section = $(this).closest('.config_handle_paper_pro').find('.ajax_product_view_by_category');
        ajaxViewTarget(url, section, section);
    });
}

var showHandleDetail = function () {
    $(document).on('click', 'button.show_config_handle_quote', function (event) {
        let section = $(this).closest('.config_handle_paper_pro').find('.ajax_product_view_by_category');
        let icon = $(this).find('i');
        let text = $(this).find('span');
        if (section.find('.product_structure_quote').length > 0) {
            text.text('Xem chi tiết sản xuất');
            icon.removeClass('fa-angle-double-up');
            icon.toggleClass('fa-angle-double-down');
            section.html('');
        } else {
            text.text('Thu gọn');
            icon.removeClass('fa-angle-double-down');
            icon.toggleClass('fa-angle-double-up');
            let proindex = $(this).attr('proindex');
            let id = $(this).data('proid');
            let cate = $(this).data('category');
            let url = 'get-view-product-structure-data?id=' + id + '&category=' + cate + '&proindex=' + proindex;
            ajaxViewTarget(url, section, section);
        }

    });
}

var calcSizeSupply = function () {
    $(document).on('keyup change', 'input.temp_size_length', function (event) {
        event.preventDefault();
        let parent = $(this).closest('.calc_size_module');
        let plus = getEmptyDefault(parent.data('plus'), 0, 'float');
        let divide = getEmptyDefault(parent.data('divide'), 0, 'float');
        let value = getEmptyDefault($(this).val(), 0, 'float');
        let otm_input = parent.find('input.otm_size_length');
        let nqty = Math.floor(divide / (value + plus));
        if (value > 0 && nqty > 0) {
            otm_input.attr('readonly', true);
            otm_input.val(divide / nqty);
        } else {
            otm_input.attr('readonly', false);
            otm_input.val('')
        }
    })
}

var selectDecalNQty = function () {
    $(document).on('change', 'select.select_decal_nqty', function (event) {
        event.preventDefault();
        let decal_module = $(this).closest('.decal_module');
        let size_module = decal_module.find('.module_decal_size');
        let val = $(this).val();
        if (val == 1) {
            size_module.fadeIn();
        } else {
            size_module.fadeOut();
        }
    })
}

var moduleSelectSupply = function () {
    $(document).on('change', 'select.select_supply_type', function (event) {
        event.preventDefault();
        let id = $(this).val();
        let cvalue = $(this).attr('cvalue');
        let url = 'get-list-option-ajax/supply_prices?supply_id=' + id + '&cvalue=' + cvalue;
        let ajax_target = $(this).closest('.module_select_supply_type').find('select.ajax_supply_price');
        ajaxViewTarget(url, ajax_target, ajax_target);
    });
}

var hoverDetailSupplyCost = function () {
    $("li.supply_item_inf").hover(
        function () {
            let tab_detail = $(this).find('.detail_quote_supply_item');
            let timeout = setTimeout(function () {
                tab_detail.addClass("hover");
            }, 1500);
            tab_detail.data("timeout", timeout);
        },
        function () {
            let tab_detail = $(this).find('.detail_quote_supply_item');
            clearTimeout(tab_detail.removeClass('hover').data('timeout'));
        }
    )
}

var modulePaperExceptHandle = function () {
    $(document).on('change', '.__paper_except_handle', function (event) {
        event.preventDefault();
        let value = $(this).val();
        let after_print = $(this).closest('.quote_product_structure').find('.paper_ajax_after_print');
        if (value == 1) {
            after_print.hide();
        } else {
            after_print.show();
        }
    });
}

var suggestShapeFileBySize = function () {
    let timeout;
    $(document).on('keyup', 'input.__size_suggest_input', function (event) {
        event.preventDefault();
        let module = $(this).closest('.config_handle_paper_pro');
        clearTimeout(timeout);
        timeout = setTimeout(function () {
            let category = module.find('select.__category_product').val();
            let style = module.find('select.__style_product').val();
            let length = module.find('input.__length_input').val();
            let width = module.find('input.__width_input').val();
            let height = module.find('input.__height_input').val();
            let url = 'suggest-product-submited-by-size?category=' + category + '&style=' + style + '&length=' + length + '&width=' + width + '&height=' + height;
            let suggest_section = module.find('.__suggest_product_submited_ajax');
            ajaxViewTarget(url, suggest_section, suggest_section);
        }, 500)
    });
}

var selectProductMadeBy = function () {
    $(document).on('change', 'select.__select_pro_made_by', function (event) {
        event.preventDefault();
        let parent = $(this).closest('.paper_product_config')
        let ajax_made_by_content = parent.find('.ajax_made_by_content');
        let made_by = $(this).val();
        if (empty(made_by)) {
            $('.ajax_product_view_by_category').html('');
        }
        ajaxViewTarget('get-view-made-by-product?made_by=' + made_by + '&pro_index=' + $(this).attr('pro_index') + '&supp_index=' + $(this).attr('supp_index') + '&rework=' + $(this).attr('rework'), ajax_made_by_content, ajax_made_by_content);
    })
}

var moduleMadeByPartnerPrice = function () {
    $(document).on('change keyup', 'input.__input_module_made_by_partner', function (event) {
        event.preventDefault();
        let parent = $(this).closest('.paper_product_config');
        let qty = parseInt(parent.find('input.input_paper_qty').val());
        let made_by_partner_module = parent.find('.made_by_partner_module');
        let price = parseInt(made_by_partner_module.find('input.input_paper_price').val());
        let total = price * qty;
        made_by_partner_module.find('input.input_paper_price').val(price);
        made_by_partner_module.find('input.input_paper_total_cost').val(total);
        made_by_partner_module.find('input.input_paper_total_amount').val(total);
    })
}

var elevateFloatChangeModule = function () {
    $(document).on("change", ".__elevate_float_checkbox", function (event) {
        event.preventDefault();
        let parent = $(this).closest(".__paper_elevate_float_handle");
        let float_module = parent.find(".__float_base_config");
        if (float_module.length > 0) {
            let inputs = float_module.find('input.__config_float_price_input');
            if ($(this).val() == 1) {
                float_module.fadeIn();
            } else {
                float_module.fadeOut();
                inputs.each(function () {
                    $(this).val(0);
                });
            }
        }
    });
}

$(function () {
    changQtyInput();
    moduleSelectOtherPaper();
    PrintQuote();
    selectCustomerQuote();
    chooseRepresentQuote();
    selectSupplyMateralModule();
    moduleInputQuantityProduct();
    addSuppModule();
    addFillFinishModule();
    removeItemAddedModule();
    setNameProductQuote();
    selectExtNamePaperModule();
    selectProductCategory();
    calcSizeSupply();
    selectDecalNQty();
    moduleSelectSupply();
    showHandleDetail();
    hoverDetailSupplyCost();
    modulePaperExceptHandle();
    suggestShapeFileBySize();
    selectProductMadeBy();
    moduleMadeByPartnerPrice();
    elevateFloatChangeModule();
});