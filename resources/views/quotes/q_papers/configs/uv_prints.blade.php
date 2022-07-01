@include('quotes.q_papers.active_view', ['icon'=>'underline', 'note'=>'In UV', 'key_act'=>'uv'])
<div class="incredent_content mt-4">
  <div class="d-flex align-items-center mb-3">
    <label class="base_label mr-2 mb-0 label_quotes">Số mặt in</label>
    <div class="d-flex align-items-center fs-15 mr-3 mb-md-0 mb-3">
      <div class="form-group d-flex align-items-center mb-0">
        <select class="form-control short_input" name="uv[num_face]">
          <option value="0">Chọn số mặt in</option>
          <option value="1">1</option>
          <option value="2">2</option>
        </select>
      </div>
    </div>
  </div>  
  @include('quotes.select_devices', ['key_device' => 'uv'])
</div> 