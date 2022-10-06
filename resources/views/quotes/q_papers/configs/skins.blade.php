@php
  $data_skin = @$dataitem['skin']?json_decode($dataitem['skin'], true):array();
@endphp
@include('quotes.q_papers.active_view', ['icon'=>'eercast', 'note'=>'Cán láng', 'key_act'=>'skin', 'active'=>@$data_skin['act']])
<div class="incredent_content mt-4" style="display: {{ @$data_skin['act']?'block':'' }};">
  <div class="d-flex align-items-center mb-3">
    <label class="base_label mr-2 mb-0 label_quotes">Chất liệu</label>
    <div class="d-flex align-items-center fs-13 mr-3 mb-md-0 mb-3 group_select_other">
      <div class="form-group mb-0 ">
        <select class="form-control short_input select_other" data-expland="other" name="skin[materal]">
          <option value="0">Chọn chất liệu</option>
          @foreach (getLaminateMateralByKey('skin') as $item)
           <option value="{{ $item->id }}" {{ @$data_skin['materal']==$item->id?'selected':'' }}>{{ $item->name }}</option>
          @endforeach
          <option value="other" {{ @$data_skin['materal']=='other'?'selected':'' }}>Chất liệu khác</option>
        </select>
        <div class="input_add mt-1" style="display: {{ @$data_skin['materal']=='other'?'block':'' }};">
          <input class="form-control fs-13 short_input x_short_input" placeholder="Nhập chi phí" type="number" name="skin[materal_price]" value="{{ @$data_skin['materal_price']?$data_skin['materal_price']:'' }}" min="0" {{ @$data_skin['materal']!='other'?'disabled':'' }}>
        </div>
      </div>
    </div>
  </div>   
  <div class="d-flex align-items-center mb-3">
    <label class="base_label mr-2 mb-0 label_quotes">Số mặt</label>
    <div class="d-flex align-items-center fs-13 mr-3 mb-md-0 mb-3">
      <div class="form-group d-flex align-items-center mb-0">
        <select class="form-control short_input" name="skin[num_face]">
          <option value="0" {{ @$data_skin['num_face']==0?'selected':'' }}>Chọn số mặt</option>
          <option value="1" {{ @$data_skin['num_face']==1?'selected':'' }}>1</option>
          <option value="2" {{ @$data_skin['num_face']==2?'selected':'' }}>2</option>
        </select>
      </div>
    </div>
  </div> 
  @include('quotes.select_devices', ['key_device' => 'skin', 'device'=>@$data_skin['device']])
</div> 