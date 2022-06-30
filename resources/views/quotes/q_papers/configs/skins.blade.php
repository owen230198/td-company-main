<div class="incredent_header d-flex align-item-centers">
  <label class="base_label mr-2 mb-0 label_quotes fs-16 font_bold d-flex align-item-centers text-uppercase">
    <i class="fa fa-eercast mr-2 fs-23" aria-hidden="true"></i>Cán láng
  </label>
  <div class="checkbox_module">
    <input type="hidden" name="skin[act]" value = "0">
    <input type="checkbox" class="toggle mx-auto change_active_stage"/>
  </div>   
</div>
<div class="incredent_content mt-4">
  <div class="d-flex align-items-center mb-3">
    <label class="base_label mr-2 mb-0 label_quotes">Chất liệu</label>
    <div class="d-flex align-items-center fs-15 mr-3 mb-md-0 mb-3 group_select_other">
      <div class="form-group d-flex align-items-center mb-0 ">
        @php
          $skin_materals = getDataTable('skin_materals', 'id, name', array(
            ['key'=>'act', 'compare'=>'=', 'value'=>1]), 0, 'name', 'asc');
          $skin_materals = $skin_materals!=null?$skin_materals:array();
        @endphp
        <select class="form-control short_input select_other" data-expland="other" name="skin[materal]">
          <option value="0">Chọn chất liệu</option>
          @foreach ($skin_materals as $item)
           <option value="{{ $item->id }}">{{ $item->name }}</option>
          @endforeach
          <option value="other">Chất liệu khác</option>
        </select>
        <div class="input_add">
          <div class="form-group d-flex align-items-center mb-0">
            <span class="d-sm-flex font_bold mx-lg-3 mx-2">-</span>
            <input class="form-control fs-15 short_input x_short_input" placeholder="Nhập chi phí" type="number" name="skin[materal_price]" value="" min="0" disabled>
          </div>
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