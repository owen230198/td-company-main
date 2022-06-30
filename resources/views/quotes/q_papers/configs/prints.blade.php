<div class="incredent_header d-flex align-item-centers">
  <label class="base_label mr-2 mb-0 label_quotes fs-16 font_bold d-flex align-item-centers text-uppercase">
    <i class="fa fa-print mr-2 fs-23" aria-hidden="true"></i>Kiểu in
  </label>
  <div class="checkbox_module">
    <input type="hidden" name="print[act]" value = "0">
    <input type="checkbox" class="toggle mx-auto change_active_stage"/>
  </div>   
</div>
<div class="incredent_content mt-4">
  <div class="d-flex align-items-center mb-3">
    <label class="base_label mr-2 mb-0 label_quotes">Màu in</label>
    <div class="d-flex align-items-center fs-15 mr-3 mb-md-0 mb-3">
      <div class="form-group d-flex align-items-center mb-0">
        <select name="print[color]" class="form-control short_input">
          <option value="0">Chọn số màu</option>
          @for ($i = 1; $i <7 ; $i++)
          <option value="{{ $i }}">{{ $i }}</option>
          @endfor
        </select>
      </div>
    </div>
  </div> 
  <div class="d-flex align-items-center mb-3">
    <label class="base_label mr-2 mb-0 label_quotes">Kiểu in</label>
    <div class="d-flex align-items-center fs-15 mr-3 mb-md-0 mb-3">
      <div class="form-group d-flex align-items-center mb-0">
        <select class="form-control short_input" name="print[style]">
          <option value="0">Chọn kiểu in</option>
          <option value="1">In một mặt</option>
          <option value="2">Nó trở nó</option>
          <option value="3">Nó trở lật</option>
          <option value="4">Nó trở khác</option>
        </select>
      </div>
    </div>
  </div>
  <div class="d-flex align-items-center">
    <label class="base_label mr-2 mb-0 label_quotes">Thiết bị</label>
    <div class="d-flex align-items-center fs-15 mr-3 mb-md-0 mb-3">
      <div class="form-group d-flex align-items-center mb-0">
        <select class="form-control short_input" name="print[device]">
          <option value="0">Chọn thiết bị</option>
          <option value="1">In offset</option>
          <option value="2">In UV</option>
        </select>
      </div>
    </div>
  </div>   
</div> 