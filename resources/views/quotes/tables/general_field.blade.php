<div class="form-group d-flex align-items-center mb-4">
  <label class="base_label mr-2 mb-0 label_quotes">Số lượng sản phẩm</label>
  <input class="form-control fs-15 short_input" type="number" name="qty_pro" value="{{ @$dataitem['qty_pro']?$dataitem['qty_pro']:'' }}" min="0" required> 
</div>
<div class="form-group d-flex align-items-center mb-4">
  <label class="base_label mr-2 mb-0 label_quotes">Số bát</span></label>
  <input class="form-control fs-15 short_input not_zero_input" type="number" name="n_qty" value="{{ @$dataitem['n_qty']?$dataitem['n_qty']:1 }}" min="1" required> 
</div>
<div class="form-group d-flex align-items-center mb-4">
  <label class="base_label mr-2 mb-0 label_quotes">Số lượng <span class="text-lowercase">{{ @$tableItem['note'] }}</span></label>
  <div class="d-flex align-items-center">
    <input class="form-control fs-15 short_input" type="number" name="qty_paper" value="{{ @$dataitem['qty_paper']?$dataitem['qty_paper']:getExactQuantityPaper(@$dataitem['qty_pro'])}}" min="0" required>
    <span class="ml-2 w_available">+{{ getDataConfigs('QConfig', @$key_plus_paper) }}</span>
  </div>  
</div>
<div class="form-group d-none align-items-center mb-4">
  <input class="form-control fs-15 short_input" type="hidden" name="add_paper" value="{{ getDataConfigs('QConfig', 'PLUS_PERCENT') }}" min="0" required>  
</div>
<div class="d-flex align-items-center mb-4">
  <label class="base_label mr-2 mb-0 label_quotes">Kích thước khổ giấy</label>
  <div class="d-flex align-items-center fs-15 mr-3 mb-md-0 mb-3">
    <div class="form-group d-flex align-items-center mb-0">
      <input class="form-control fs-15 short_input" placeholder="Nhập KT dài" type="number" name="length" value="{{ @$dataitem['length']?$dataitem['length']:'' }}" min="0" required step="any"> 
      <span class="d-sm-flex font_bold mx-lg-3 mx-2">X</span>
    </div>
    <div class="form-group d-flex align-items-center mb-0">
      <input class="form-control fs-15 short_input" placeholder="Nhập KT rộng" type="number" name="width" value="{{ @$dataitem['width']?$dataitem['width']:'' }}" min="0" required step="any">
      <span class="ml-2 w_available">Đơn vị tính (m)</span> 
    </div>
  </div>
</div>