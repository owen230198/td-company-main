<div class="config_paper_quantative {{ $tableItem['name']=='q_foams'?'ajaxSelectModule':'' }}">
  <div class="d-flex align-items-center mb-4">
    <label class="base_label mr-2 mb-0 label_quotes">Loại {{ @$tableItem['note'] }}</label>
    <div class="d-flex align-items-center fs-13 mr-3 mb-md-0 mb-3">
      <select name="name" class="form-control short_input {{ $tableItem['name']=='q_foams'?'change_select_ajax':'' }}" {{ $tableItem['name']=='q_foams'?'data-url=option-child-data/q_supply_prices/q_supply_id/':'' }}>
        <option value="0" {{ @$dataitem['name']==0?'selected':'' }}>Chọn loại {{ @$tableItem['note'] }}</option>
        @foreach (getSupplyByType('q_supplies', @$key_supply) as $item)
        <option value="{{ $item->id }}" {{ @$dataitem['name']==$item->id?'selected':'' }}>{{ $item->name }}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="d-flex align-items-center mb-4">
    <label class="base_label mr-2 mb-0 label_quotes">Định lượng</label>
    <div class="d-flex align-items-center fs-13 mr-3 mb-md-0 mb-3">
      @php
        $data_paper = @$dataitem['paper_size']?json_decode($dataitem['paper_size'], true):array();
      @endphp
      <select name="paper_size[quantative]" class="form-control short_input {{ $tableItem['name']=='q_foams'?'ajax_option':'' }}">
        <option value="0" {{ @$data_paper['quantative']==0?'selected':'' }}>Chọn định lượng</option>
        @if (@$key_supply==1)
          @foreach (getSupplyByType('q_supply_prices', 1) as $item)
          <option value="{{ $item->id }}" {{ @$data_paper['quantative']==$item->id?'selected':'' }}>{{ $item->name }}</option>
          @endforeach
          @elseif(@$key_supply==2&&@$dataitem['name']!=0)
          @foreach (getSupplyPriceByParent($dataitem['name']) as $item)
          <option value="{{ $item->id }}" {{ @$data_paper['quantative']==$item->id?'selected':'' }}>{{ $item->name }}</option>
          @endforeach
        @endif
      </select>
    </div>
  </div>
</div>
<div class="d-flex align-items-center mb-4">
  <label class="base_label mr-2 mb-0 label_quotes">Máy bế:</label>
  <input type="hidden" name="elevate[act]" value="1">
  @php
    $data_elevate = @$dataitem['elevate']?json_decode($dataitem['elevate'], true):array();
  @endphp
	<input class="form-control fs-13 short_input mr-3" placeholder="Giá khuôn" type="number" name="elevate[shape_price]" value="{{ @$data_elevate['shape_price']?$data_elevate['shape_price']:'' }}" min="0">
	@include('quotes.select_devices', ['key_device' => 'elevate', 'device'=>@$data_elevate['device'], 'hide_label'=>true])
</div> 
@if ($tableItem['name'] == 'q_cartons')
  <div class="d-flex align-items-center mb-4">
    <label class="base_label mr-2 mb-0 label_quotes">Máy phay:</label>
    @php
      $data_milling = @$dataitem['milling']?json_decode($dataitem['milling'], true):array();
    @endphp
    <input type="hidden" name="milling[act]" value="1">
    @include('quotes.select_devices', ['key_device' => 'milling', 'device'=>@$data_milling['device'], 'hide_label'=>true])
  </div>
@endif 
<div class="d-flex align-items-center mb-4">
  <label class="base_label mr-2 mb-0 label_quotes">Bóc lề:</label>
  @php
     $data_peel = @$dataitem['peel']?json_decode($dataitem['peel'], true):array();
  @endphp
  <input type="hidden" name="peel[act]" value="1">
	@include('quotes.select_devices', ['key_device' => 'peel', 'device'=>@$data_peel['device'], 'hide_label'=>true])
</div> 