<div class="row baseInfoProductItem">
    <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
        <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Tên sản phẩm</label>
        <input type="text" class="form-control nameProductInput" data-label="pro-{{ $key }}-label" 
        name="product[{{ $key }}][name]" value="{{ $proName.' '. $key+1 }}" required>
    </div>
    @include('orders.products.select_categories')
    <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
        <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Số mặt thiết kế</label>
        <input type="number" class="form-control" name="product[{{ $key }}][num_face_design]" value=""
         min="1" required>
    </div>
    <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
        <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">SL thành phẩm</label>
        <input type="number" class="form-control proItemQtyInput" name="product[{{ $key }}][qty]" value="0"
         min="0" required>
    </div>
    <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
        <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Đơn giá</label>
        <input type="number" class="form-control proItemPriceInput" name="product[{{ $key }}][price]" value="0"
         min="0" required>
    </div>
    <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
        <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Thành tiền</label>
        <input type="number" class="form-control disable_field proItemTotalInput" name="product[{{ $key }}][total_cost]" 
        value="0">
    </div>
    <div class="form-group d-flex border_bot_eb col-12">
        <label class="mb-0 mr-3 w_125 fs-13 text-capitalize align-items-start">Ghi chú về sản phẩm</label>
        <textarea class="form-control" name="product[{{ $key }}][note]"></textarea>
    </div>
</div>