<div class="form-group d-flex align-items-center mb-4"> 
  <label class="base_label mr-2 mb-0 label_quotes">Tên sản phẩm báo giá</label>
  <input class="form-control" type="text" name="name" value="{{ @$dataitem['name']?$dataitem['name']:'' }}" required>
</div>
<div class="form-group d-flex align-items-center mb-4"> 
  <label class="base_label mr-2 mb-0 label_quotes">Xuất file báo giá</label>
  <div class="checkbox_module">
    <input type="hidden" name="main" value = "{{ @$dataitem['main']?1:0 }}">
    <input type="checkbox" class="toggle mx-auto change_active_stage" {{ @$dataitem['main']?'checked':'' }} />
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
@include('quotes.q_papers.configs.papers')
