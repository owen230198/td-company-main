@include('quotes.q_papers.active_view', ['icon'=>'eercast', 'note'=>'Cán láng', 'key_act'=>'skin'])
<div class="incredent_content mt-4">
  <div class="d-flex align-items-center mb-3">
    <label class="base_label mr-2 mb-0 label_quotes">Chất liệu</label>
    <div class="d-flex align-items-center fs-15 mr-3 mb-md-0 mb-3 group_select_other">
      <div class="form-group d-flex align-items-center mb-0 ">
        <select class="form-control short_input select_other" data-expland="other" name="skin[materal]">
          <option value="0">Chọn chất liệu</option>
          @foreach (getgetLaminateMateralByKey('skin') as $item)
           <option value="{{ $item->id }}">{{ $item->name }}</option>
          @endforeach
          <option value="other">Chất liệu khác</option>
        </select>
        <div class="input_add mt-1">
            <input class="form-control fs-15 short_input x_short_input" placeholder="Nhập chi phí" type="number" name="skin[materal_price]" value="" min="0" disabled>
        </div>
      </div>
    </div>
  </div>   
  <div class="d-flex align-items-center mb-3">
    <label class="base_label mr-2 mb-0 label_quotes">Số mặt</label>
    <div class="d-flex align-items-center fs-15 mr-3 mb-md-0 mb-3">
      <div class="form-group d-flex align-items-center mb-0">
        <select class="form-control short_input" name="skin[num_face]">
          <option value="0">Chọn số mặt</option>
          <option value="1">1</option>
          <option value="2">2</option>
        </select>
      </div>
    </div>
  </div> 
  @include('quotes.select_devices', ['key_device' => 'skin'])
</div> 