<div class="form-group d-flex align-items-center mb-4"> 
    <label class="base_label mr-2 mb-0 label_quotes">Tên sản phẩm báo giá</label>
    <input class="form-control" type="text" name="name" value="{{ @$dataitem['name']?$dataitem['name']:'' }}" required>
  </div>
  <div class="form-group d-flex align-items-center mb-4">
    <label class="base_label mr-2 mb-0 label_quotes">Số lượng sản phẩm</label>
    <input class="form-control fs-15 short_input" type="number" name="qty_pro" value="" min="0" required> 
  </div>
  <div class="form-group d-flex align-items-center mb-4">
    <label class="base_label mr-2 mb-0 label_quotes">Số bát/ tờ in</label>
    <input class="form-control fs-15 short_input change_qty_input" type="number" name="n_qty" value="" min="0" required> 
  </div>
  <div class="form-group d-flex align-items-center mb-4">
    <label class="base_label mr-2 mb-0 label_quotes">Số lượng tờ in</label>
    <div class="d-flex align-items-center">
      <input class="form-control fs-15 short_input" type="number" name="qty_paper" value="" min="0" required>
      <span class="ml-2 w_available">+100</span>
    </div>  
  </div>
  <div class="form-group d-none align-items-center mb-4">
    <input class="form-control fs-15 short_input" type="hidden" name="add_paper" value="2" min="0" required>  
  </div>
  <div class="d-flex align-items-center mb-4">
    <label class="base_label mr-2 mb-0 label_quotes">Khổ giấy in</label>
    <div class="d-flex align-items-center fs-15 mr-3 mb-md-0 mb-3">
      <div class="form-group d-flex align-items-center mb-0">
        <input class="form-control fs-15 short_input x_short_input" placeholder="Nhập KT dài" type="number" name="p_lenght" value="" min="0" required> 
        <span class="d-sm-flex font_bold mx-lg-3 mx-2">X</span>
      </div>
      <div class="form-group d-flex align-items-center mb-0">
        <input class="form-control fs-15 short_input x_short_input" placeholder="Nhập KT rộng" type="number" name="p_width" value="" min="0" required>
        <span class="ml-2 w_available">Đơn vị tính (m)</span> 
      </div>
    </div>
  </div>
  <div class="d-flex align-items-center mb-4">
    <label class="base_label mr-2 mb-0 label_quotes">Định lượng & Đơn giá</label>
    <div class="d-flex align-items-center fs-15 mr-3 mb-md-0 mb-3">
      <div class="form-group d-flex align-items-center mb-0">
        <input class="form-control fs-15 short_input x_short_input" placeholder="Nhập ĐL giấy" type="number" name="p_quantitative" value="" min="0" required>
        <span class="d-sm-flex font_bold mx-lg-3 mx-2">-</span>
      </div>
      <div class="form-group d-flex align-items-center mb-0">
        <input class="form-control fs-15 short_input x_short_input" placeholder="Nhập ĐG tấn" type="number" name="p_price" value="" min="0" required>
      </div>
    </div>
  </div>
  <div class="d-flex align-items-center mb-4">
    <label class="base_label mr-2 mb-0 label_quotes">Mẫu TK</label>
    <div class="d-flex align-items-center fs-15 mr-3 mb-md-0 mb-3">
      <div class="form-group d-flex align-items-center mb-0">
        <select class="form-control short_input">
          <option>TD cung cấp</option>
          <option>KH cung cấp</option>
        </select>
        <span class="d-sm-flex font_bold mx-lg-3 mx-2">-</span>
      </div>
      <div class="form-group d-flex align-items-center mb-0">
        <input class="form-control fs-15 short_input x_short_input" placeholder="Nhập Giá TK" type="number" name="" value="" min="0">
      </div>
    </div>
  </div>