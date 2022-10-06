@php
  $data_plus = @$dataitem['plus']?json_decode($dataitem['plus'], true):array();
@endphp
@include('quotes.q_papers.active_view', ['icon'=>'plus-square', 'note'=>'Phát sinh', 'key_act'=>'plus', 'active'=>@$data_plus['act']])
<div class="incredent_content mt-4" style="display: {{ @$data_plus['act']?'block':'' }};">
  <div class="d-flex align-items-center mb-3">
    <label class="base_label mr-2 mb-0 label_quotes">Chi phí phát sinh/SP:</label>
    <input class="form-control fs-13 short_input" type="number" name="plus[price]" value="{{ @$data_plus['price']?$data_plus['price']:'' }}" min="0">
  </div>
  <h4 class="fs-13 font-bold color_red">Dành cho điền giá 1 sản phẩm</h4> 
  <p class="fs-14 font-italic color_red">1. Tem + toa đi kèm hộp.</p>
  <p class="fs-14 font-italic color_red">2. Các chi phí phát sinh vật tư khác.</p>
</div> 