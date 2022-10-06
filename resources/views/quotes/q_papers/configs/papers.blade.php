@php
  $data_paper = @$dataitem['paper_size']?json_decode($dataitem['paper_size'], true):array();
  $data_design = @$dataitem['design_model']?json_decode($dataitem['design_model'], true):array();
@endphp
<div class="d-flex align-items-center mb-4">
  <label class="base_label mr-2 mb-0 label_quotes">Định lượng & Đơn giá</label>
  <div class="d-flex align-items-center fs-13 mr-3 mb-md-0 mb-3">
    <div class="form-group d-flex align-items-center mb-0">
      <input class="form-control fs-13 short_input" placeholder="Nhập ĐL giấy" type="number" name="paper_size[quantitative]" value="{{ @$data_paper['quantitative']?$data_paper['quantitative']:'' }}" min="0" required step="any">
      <span class="d-sm-flex font_bold mx-lg-3 mx-2">-</span>
    </div>
    <div class="form-group d-flex align-items-center mb-0">
      <input class="form-control fs-13 short_input" placeholder="Nhập ĐG tấn" type="number" name="paper_size[unit_price]" value="{{ @$data_paper['unit_price']?$data_paper['unit_price']:'' }}" min="0" required step="any">
    </div>
  </div>
</div>
<div class="d-flex align-items-center mb-4 group_select_other">
  <label class="base_label mr-2 mb-0 label_quotes">Mẫu TK</label>
  <div class="d-flex align-items-center fs-13 mr-3 mb-md-0 mb-3">
    <select name="design_model[type]" class="form-control short_input select_other" data-expland="1">
      <option value="0" {{ @$data_design['type']==0?'selected':'' }}>Chọn đơn vị cung cấp</option>
      <option value="1" {{ @$data_design['type']==1?'selected':'' }}>TD cung cấp</option>
      <option value="2" {{ @$data_design['type']==2?'selected':'' }}>KH cung cấp</option>
    </select>
    <div class="input_add" style="display: {{ @$data_design['type']==1?'block':'' }}">
      <div class="form-group d-flex align-items-center mb-0">
        <span class="d-sm-flex font_bold mx-lg-3 mx-2">-</span>
        <input class="form-control fs-13 short_input x_short_input" placeholder="Nhập Giá TK" type="number" name="design_model[total]" value="{{ @$data_design['total']?$data_design['total']:'' }}" min="0" {{ @$data_design['type']!=1?'disabled':'' }} step="any">
      </div>
    </div>
  </div>
</div>