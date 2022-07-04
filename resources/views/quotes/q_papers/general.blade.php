<div class="form-group d-flex align-items-center mb-4"> 
  <label class="base_label mr-2 mb-0 label_quotes">Tên sản phẩm báo giá</label>
  <input class="form-control" type="text" name="name" value="{{ @$dataitem['name']?$dataitem['name']:'' }}" required>
</div>
<div class="form-group d-flex align-items-center mb-4"> 
  <label class="base_label mr-2 mb-0 label_quotes">Xuất file báo giá</label>
  <div class="checkbox_module">
    <input type="hidden" name="main" value = "0">
    <input type="checkbox" class="toggle mx-auto change_active_stage"/>
  </div>
</div>
<div class="form-group d-flex align-items-center mb-4">
  <label class="base_label mr-2 mb-0 label_quotes">Số lượng sản phẩm</label>
  <input class="form-control fs-15 short_input" type="number" name="qty_pro" value="{{ @$dataitem['qty_pro']?$dataitem['qty_pro']:'' }}" min="0" required> 
</div>
<div class="form-group d-flex align-items-center mb-4">
  <label class="base_label mr-2 mb-0 label_quotes">Số bát/ tờ in</label>
  <input class="form-control fs-15 short_input not_zero_input" type="number" name="n_qty" value="{{ @$dataitem['n_qty']?$dataitem['n_qty']:1 }}" min="1" required> 
</div>
<div class="form-group d-flex align-items-center mb-4">
  <label class="base_label mr-2 mb-0 label_quotes">Số lượng tờ in</label>
  <div class="d-flex align-items-center">
    <input class="form-control fs-15 short_input" type="number" name="qty_paper" value="{{ @$dataitem['qty_paper']?$dataitem['qty_paper']:getExactQuantityPaper(@$dataitem['qty_pro'])}}" min="0" required>
    <span class="ml-2 w_available">+{{ getDataConfigs('QConfig', 'PLUS_PAPER') }}</span>
  </div>  
</div>
<div class="form-group d-none align-items-center mb-4">
  <input class="form-control fs-15 short_input" type="hidden" name="add_paper" value="{{ getDataConfigs('QConfig', 'PLUS_PERCENT') }}" min="0" required>  
</div>
<div class="d-flex align-items-center mb-4">
  <label class="base_label mr-2 mb-0 label_quotes">Khổ giấy in</label>
  <div class="d-flex align-items-center fs-15 mr-3 mb-md-0 mb-3">
    <div class="form-group d-flex align-items-center mb-0">
      <input class="form-control fs-15 short_input" placeholder="Nhập KT dài" type="number" name="length" value="" min="0" required step="any"> 
      <span class="d-sm-flex font_bold mx-lg-3 mx-2">X</span>
    </div>
    <div class="form-group d-flex align-items-center mb-0">
      <input class="form-control fs-15 short_input" placeholder="Nhập KT rộng" type="number" name="width" value="" min="0" required step="any">
      <span class="ml-2 w_available">Đơn vị tính (m)</span> 
    </div>
  </div>
</div>
<div class="d-flex align-items-center mb-4">
  <label class="base_label mr-2 mb-0 label_quotes">Định lượng & Đơn giá</label>
  <div class="d-flex align-items-center fs-15 mr-3 mb-md-0 mb-3">
    <div class="form-group d-flex align-items-center mb-0">
      <input class="form-control fs-15 short_input" placeholder="Nhập ĐL giấy" type="number" name="paper_size[quantitative]" value="" min="0" required step="any">
      <span class="d-sm-flex font_bold mx-lg-3 mx-2">-</span>
    </div>
    <div class="form-group d-flex align-items-center mb-0">
      <input class="form-control fs-15 short_input" placeholder="Nhập ĐG tấn" type="number" name="paper_size[unit_price]" value="" min="0" required step="any">
    </div>
  </div>
</div>
<div class="d-flex align-items-center mb-4 group_select_other">
  <label class="base_label mr-2 mb-0 label_quotes">Mẫu TK</label>
  <div class="d-flex align-items-center fs-15 mr-3 mb-md-0 mb-3">
    <select name="design_model[type]" class="form-control short_input select_other" data-expland="1">
      <option value="0">Chọn đơn vị cung cấp</option>
      <option value="1">TD cung cấp</option>
      <option value="2">KH cung cấp</option>
    </select>
    <div class="input_add">
      <div class="form-group d-flex align-items-center mb-0">
        <span class="d-sm-flex font_bold mx-lg-3 mx-2">-</span>
        <input class="form-control fs-15 short_input x_short_input" placeholder="Nhập Giá TK" type="number" name="design_model[total]" value="" min="0" disabled step="any">
      </div>
    </div>
  </div>
</div>