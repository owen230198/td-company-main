@include('quotes.tables.general_field', ['key_plus_paper'=>'PLUS_CARTON'])
<div class="d-flex align-items-center mb-4">
  <label class="base_label mr-2 mb-0 label_quotes">Loại {{ @$tableItem['note'] }}</label>
  <div class="d-flex align-items-center fs-15 mr-3 mb-md-0 mb-3">
    <select name="name" class="form-control short_input" data-expland="1">
      <option value="0" {{ @$dataitem['name']==0?'selected':'' }}>Chọn loại {{ @$tableItem['note'] }}</option>
      @foreach (getSupplyByTypeType('q_supplies', 1) as $item)
      <option value="{{ $item->id }}" {{ @$dataitem['name']==$item->id?'selected':'' }}>{{ $item->name }}</option>
      @endforeach
    </select>
  </div>
</div>
<div class="d-flex align-items-center mb-4">
  <label class="base_label mr-2 mb-0 label_quotes">Định lượng</label>
  <div class="d-flex align-items-center fs-15 mr-3 mb-md-0 mb-3">
    @php
      $data_paper = @$dataitem['paper_size']?json_decode($dataitem['paper_size'], true):array();
    @endphp
    <select name="paper_size[quantative]" class="form-control short_input" data-expland="1">
      <option value="0" {{ @$data_paper['quantative']==0?'selected':'' }}>Chọn định lượng</option>
      @foreach (getSupplyByTypeType('q_supply_prices', 1) as $item)
      <option value="{{ $item->id }}" {{ @$data_paper['quantative']==$item->id?'selected':'' }}>{{ $item->name }}</option>
      @endforeach
    </select>
  </div>
</div>
<div class="d-flex align-items-center mb-4">
  <label class="base_label mr-2 mb-0 label_quotes">Máy bế:</label>
  <input type="hidden" name="elevate[act]" value="1">
	<input class="form-control fs-15 short_input mr-3" placeholder="Giá khuôn của bài in" type="number" name="elevate[shape_price]" value="{{ @$data_elevate['shape_price']?$data_elevate['shape_price']:'' }}" min="0">
	@include('quotes.select_devices', ['key_device' => 'elevate', 'device'=>@$data_elevate['device'], 'hide_label'=>true])
</div> 
<div class="d-flex align-items-center mb-4">
  <label class="base_label mr-2 mb-0 label_quotes">Máy phay:</label>
  <input type="hidden" name="milling[act]" value="1">
	@include('quotes.select_devices', ['key_device' => 'milling', 'device'=>@$data_elevate['device'], 'hide_label'=>true])
</div> 
<div class="d-flex align-items-center mb-4">
  <label class="base_label mr-2 mb-0 label_quotes">Bóc lề:</label>
  <input type="hidden" name="peel[act]" value="1">
	@include('quotes.select_devices', ['key_device' => 'peel', 'device'=>@$data_elevate['device'], 'hide_label'=>true])
</div> 