<div class="row baseInfoProductItem">
    <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
        <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Tên sản phẩm</label>
        <input type="text" class="form-control nameProductInput" data-label="pro-{{ $key }}-label" 
        name="product[{{ $key }}][name]" value="{{ $proName.' '. $key+1 }}">
    </div>
    <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
        <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Nhóm sản phẩm</label>
        <select name="product[{{ $key }}][product_category_id]" class="form-control select_config">
            <option value="">Tất cả danh mục</option>
            <optgroup label="Hàng đặt">
                <option value="">___Hộp cứng</option>
                <option value="">___Hộp giấy</option>
            </optgroup>
            <optgroup label="Hàng bán sẵn">
                <optgroup label="__Hộp cứng">
                    <option value="">___Hộp quà tết</option>
                    <option value="">___Hộp bánh trung thu</option>
                    <option value="">___Hộp nắp mika</option>
                    <option value="">___Hộp trụ tròn</option>
                    <option value="">___Thuyền</option>
                </optgroup>
                <optgroup label="__Hộp giấy">
                    <option value="">___Hộp bánh trung thu</option>
                </optgroup>
            </optgroup>
        </select>
    </div>
    <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
        <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Số mặt thiết kế</label>
        <input type="number" class="form-control" name="product[{{ $key }}][num_face_design]" value="" min="1">
    </div>
    <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
        <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">SL thành phẩm</label>
        <input type="number" class="form-control proItemQtyInput" name="product[{{ $key }}][qty]" value="0" min="0">
    </div>
    <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
        <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Đơn giá</label>
        <input type="number" class="form-control proItemPriceInput" name="product[{{ $key }}][price]" value="0" min="0">
    </div>
    <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
        <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Thành tiền</label>
        <input type="number" class="form-control disable_field proItemTotalInput" name="product[{{ $key }}][total_cost]" value="0">
    </div>
    <div class="form-group d-flex border_bot_eb col-12">
        <label class="mb-0 mr-3 w_125 fs-13 text-capitalize align-items-start">Ghi chú về sản phẩm</label>
        <textarea class="form-control" name="product[{{ $key }}][note]"></textarea>
    </div>
</div>