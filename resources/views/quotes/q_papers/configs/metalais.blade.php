@php
  $data_metalai = @$dataitem['metalai']?json_decode($dataitem['metalai'], true):array();
@endphp
@include('quotes.q_papers.active_view', ['icon'=>'ravelry', 'note'=>'Cán metalai', 'key_act'=>'metalai', 'active'=>@$data_metalai['act']])
<div class="incredent_content mt-4" style="display: {{ @$data_metalai['act']?'block':'' }};">
  <div class="d-flex align-items-center mb-3">
    <label class="base_label mr-2 mb-0 label_quotes">Chất liệu cán</label>
    <div class="d-flex align-items-center fs-13 mr-3 mb-md-0 mb-3 group_select_other">
      <div class="form-group mb-0">
        <select class="form-control short_input select_other" name="metalai[materal]" data-expland="other">
          <option value="0" {{ @$data_metalai['materal']==0?'selected':'' }}>Chọn chất liệu</option>
          @foreach (getLaminateMateralByKey('metalai') as $item)
          <option value="{{ $item->id }}" {{ @$data_metalai['materal']==$item->id?'selected':'' }}>{{ $item->name }}</option>
          @endforeach
          <option value="other" {{ @$data_metalai['materal']=='other'?'selected':'' }}>Chất liệu khác</option>
        </select>
        <div class="input_add mt-1" style="display: {{ @$data_metalai['materal']=='other'?'block':'' }};">
          <input class="form-control fs-13 short_input" placeholder="Nhập chi phí" type="number" name="metalai[materal_price]" value="{{ @$data_metalai['materal_price']?$data_metalai['materal_price']:'' }}" min="0" {{ @$data_metalai['materal']!='other'?'disabled':'' }}>
        </div>
      </div>
    </div>
  </div>   
  <div class="d-flex align-items-center mb-3">
    <label class="base_label mr-2 mb-0 label_quotes">Số mặt cán</label>
    <div class="d-flex align-items-center fs-13 mr-3 mb-md-0 mb-3">
      <div class="form-group d-flex align-items-center mb-0">
        <select class="form-control short_input" name="metalai[num_face]">
          <option value="0" {{ @$data_metalai['num_face']==0?'selected':'' }}>Chọn số mặt</option>
          <option value="1" {{ @$data_metalai['num_face']==1?'selected':'' }}>1</option>
          <option value="2" {{ @$data_metalai['num_face']==2?'selected':'' }}>2</option>
        </select>
      </div>
    </div>
  </div>
  <div class="d-flex align-items-center mb-3">
    <label class="base_label mr-2 mb-0 label_quotes">Chất liệu phủ trên</label>
    <div class="d-flex align-items-center fs-13 mr-3 mb-md-0 mb-3 group_select_other">
      <div class="form-group mb-0">
        <select class="form-control short_input select_other" name="metalai[cover_materal]" data-expland="other">
          <option value="0" {{ @$data_metalai['cover_materal']==0?'selected':'' }}>Chọn chất liệu</option>
          @foreach (getLaminateMateralByKey('cover') as $item)
          <option value="{{ $item->id }}" {{ @$data_metalai['cover_materal']==$item->id?'selected':'' }}>{{ $item->name }}</option>
          @endforeach
          <option value="other" {{ @$data_metalai['cover_materal']=='other'?'selected':'' }}>Chất liệu khác</option>
        </select>
        <div class="input_add mt-1" style="display: {{ @$data_metalai['cover_materal']=='other'?'block':'' }};">
          <input class="form-control fs-13 short_input" placeholder="Nhập chi phí" type="number" name="metalai[cover_materal_price]" value="{{ @$data_metalai['cover_materal_price']?$data_metalai['cover_materal_price']:'' }}" min="0" {{ @$data_metalai['cover_materal']!='other'?'disabled':'' }}>
        </div>
      </div>
    </div>
  </div>   
  <div class="d-flex align-items-center mb-3">
    <label class="base_label mr-2 mb-0 label_quotes">Số mặt phủ trên</label>
    <div class="d-flex align-items-center fs-13 mr-3 mb-md-0 mb-3">
      <div class="form-group d-flex align-items-center mb-0">
        <select class="form-control short_input" name="metalai[cover_num_face]">
          <option value="0" {{ @$data_metalai['cover_num_face']==0?'selected':'' }}>Chọn số mặt</option>
          <option value="1" {{ @$data_metalai['cover_num_face']==1?'selected':'' }}>1</option>
          <option value="2" {{ @$data_metalai['cover_num_face']==2?'selected':'' }}>2</option>
        </select>
      </div>
    </div>
  </div>
</div>