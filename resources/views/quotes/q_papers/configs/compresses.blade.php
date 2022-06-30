<div class="incredent_header d-flex align-item-centers">
  <label class="base_label mr-2 mb-0 label_quotes fs-16 font_bold d-flex align-item-centers text-uppercase">
    <i class="fa fa-compress mr-2 fs-23" aria-hidden="true"></i>Ép nhũ
  </label>
  <div class="checkbox_module">
    <input type="hidden" name="compress[act]" value = "0">
    <input type="checkbox" class="toggle mx-auto change_active_stage"/>
  </div>   
</div>
<div class="incredent_content mt-4">
  <div class="d-flex align-items-center mb-3">
    <label class="base_label mr-2 mb-0 label_quotes">Giá tiền/SP:</label>
    <div class="d-block">
      <input class="form-control fs-15 short_input" type="number" name="compress[price]" value="" min="0">
      <span class="mt-2 w_available fs-12 color_red font-italic">Giá lượt/1 bát sp (không phải giá lượt/1 tờ in)</span>
    </div> 
  </div>   
  <div class="d-flex align-items-center mb-3">
    <label class="base_label mr-2 mb-0 label_quotes">Giá khuôn/SP:</label>
    <div class="d-block">
      <input class="form-control fs-15 short_input" type="number" name="compress[shape]" value="" min="0">
      <span class="mt-2 w_available fs-12 color_red font-italic">Giá khuôn/1 bát sp (không phải giá khuôn/1 tờ in)</span>
    </div> 
  </div>  
  <div class="d-flex align-items-center">
    <label class="base_label mr-2 mb-0 label_quotes">Thiết bị</label>
    <div class="d-flex align-items-center fs-15 mr-3 mb-md-0 mb-3">
      <div class="form-group d-flex align-items-center mb-0">
        <select class="form-control short_input" name="compress[device]">
          <option value="0">Chọn thiết bị</option>
          <option value="1">Tự động</option>
          <option value="2">Máy thủy lực</option>
        </select>
      </div>
    </div>
  </div> 
</div> 