@include('quotes.q_papers.active_view', ['icon'=>'ravelry', 'note'=>'Cán metalai', 'key_act'=>'metalai'])
<div class="incredent_content mt-4">
  <div class="d-flex align-items-center mb-3">
    <label class="base_label mr-2 mb-0 label_quotes">Chất liệu cán</label>
    <div class="d-flex align-items-center fs-15 mr-3 mb-md-0 mb-3 group_select_other">
      <div class="form-group mb-0">
        <select class="form-control short_input select_other" name="metalai[materal]" data-expland="other">
          <option value="0">Chọn chất liệu</option>
          @foreach (getLaminateMateralByKey('metalai') as $item)
          <option value="{{ $item->id }}">{{ $item->name }}</option>
          @endforeach
          <option value="other">Chất liệu khác</option>
        </select>
        <div class="input_add mt-1">
            <input class="form-control fs-15 short_input" placeholder="Nhập chi phí" type="number" name="metalai[materal_price]" value="" min="0" disabled>
        </div>
      </div>
    </div>
  </div>   
  <div class="d-flex align-items-center mb-3">
    <label class="base_label mr-2 mb-0 label_quotes">Số mặt cán</label>
    <div class="d-flex align-items-center fs-15 mr-3 mb-md-0 mb-3">
      <div class="form-group d-flex align-items-center mb-0">
        <select class="form-control short_input" name="metalai[num_face]">
          <option value="0">Chọn số mặt</option>
          <option value="1">1</option>
          <option value="2">2</option>
        </select>
      </div>
    </div>
  </div>
  <div class="d-flex align-items-center mb-3">
    <label class="base_label mr-2 mb-0 label_quotes">Chất liệu phủ trên</label>
    <div class="d-flex align-items-center fs-15 mr-3 mb-md-0 mb-3 group_select_other">
      <div class="form-group mb-0">
        <select class="form-control short_input select_other" name="metalai[cover_materal]" data-expland="other">
          <option value="0">Chọn chất liệu</option>
          @foreach (getLaminateMateralByKey('cover') as $item)
          <option value="{{ $item->id }}">{{ $item->name }}</option>
          @endforeach
          <option value="other">Chất liệu khác</option>
        </select>
        <div class="input_add mt-1">
          <input class="form-control fs-15 short_input" placeholder="Nhập chi phí" type="number" name="metalai[cover_materal_price]" value="" min="0" disabled>
        </div>
      </div>
    </div>
  </div>   
  <div class="d-flex align-items-center mb-3">
    <label class="base_label mr-2 mb-0 label_quotes">Số mặt phủ trên</label>
    <div class="d-flex align-items-center fs-15 mr-3 mb-md-0 mb-3">
      <div class="form-group d-flex align-items-center mb-0">
        <select class="form-control short_input" name="metalai[cover_num_face]">
          <option value="0">Chọn số mặt</option>
          <option value="1">1</option>
          <option value="2">2</option>
        </select>
      </div>
    </div>
  </div>
</div>