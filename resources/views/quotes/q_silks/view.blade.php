@include('quotes.tables.general_field', ['key_plus_paper'=>'PLUS_CARTON'])
<div class="d-flex align-items-center mb-4">
   <label class="base_label mr-2 mb-0 label_quotes">Loại {{ @$tableItem['note'] }}</label>
   <div class="d-flex align-items-center fs-15 mr-3 mb-md-0 mb-3">
	   <select name="paper_size[quantative]" class="form-control short_input">
	      @foreach (getSupplyByType('q_supply_prices', 3) as $item)
	      <option value="{{ $item->id }}" {{ @$dataitem['name']==$item->id?'selected':'' }}>{{ $item->name }}</option>
	      @endforeach
	   </select>
   </div>
</div>
<div class="d-flex align-items-center mb-4">
  	<label class="base_label mr-2 mb-0 label_quotes">Số lỗ sản phẩm:</label>
  	@php
    	$data_hole = @$dataitem['hole_price']?json_decode($dataitem['hole_price'], true):array();
  	@endphp
	<input class="form-control fs-15 short_input mr-3" placeholder="Nhập số lỗ" type="number" name="hole_price[num]" value="{{ @$data_hole['num']?$data_hole['num']:'' }}" min="0">
</div>