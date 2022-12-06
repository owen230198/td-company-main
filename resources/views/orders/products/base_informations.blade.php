@php
    $singleRecord = !empty($sigleObject);
    $productPaper = !empty($dataItemProduct['json_data_paper'])?json_decode($dataItemProduct['json_data_paper'], true):[];
@endphp
<div class="row baseInfoProductItem">
    <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
        <label class="mb-0 mr-3 w_150 fs-13 text-capitalize">Tên sản phẩm</label>
        <input type="text" class="form-control nameProductInput" {!! !$singleRecord?'data-label="pro-'.$key.'-label"':'' !!} 
        name="{{ $singleRecord?'name':'product['.$key.'][name]' }}" value="{{ @$dataItemProduct['name']??$proName.' '. $key+1 }}" required>
    </div>
    @include('orders.products.select_categories')
    <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
        <label class="mb-0 mr-3 w_150 fs-13 text-capitalize">Số mặt thiết kế</label>
        <input type="number" class="form-control" name="{{ $singleRecord?'num_face_design':'product['.$key.'][num_face_design]' }}" 
        value="{{ @$dataItemProduct['num_face_design'] }}" min="1" required>
    </div>
    <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
        <label class="mb-0 mr-3 w_150 fs-13 text-capitalize">Định lượng giấy in</label>
        <input type="number" class="form-control" name="{{ $singleRecord?'json_data_paper[quantative]':'product['.$key.'][json_data_paper][quantative]' }}" 
        value="{{ @$productPaper['quantative'] }}" min="0" required>
    </div>
    <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
        <label class="mb-0 mr-3 w_150 fs-13 text-capitalize">Loại giấy in</label>
        <select name="{{ $singleRecord?'json_data_paper[substance]':'product['.$key.'][json_data_paper][substance]' }}" class="form-control select_config" required>
            <option value="0">Chọn loại giấy</option>
            @foreach ($listPaperSubs as $item)
                <option value="{{ @$item['id'] }}" {{ @$productPaper['substance']==$item['id']?'selected':'' }}>{{ $item['name'] }}</option> 
            @endforeach
        </select>
    </div>
    <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
        <label class="mb-0 mr-3 w_150 fs-13 text-capitalize">SL thành phẩm</label>
        <input type="number" class="form-control proItemQtyInput" name="{{ $singleRecord?'qty':'product['.$key.'][qty]' }}" 
        value="{{ (int)@$dataItemProduct['qty'] }}" min="0" required>
    </div>
    <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
        <label class="mb-0 mr-3 w_150 fs-13 text-capitalize">Đơn giá</label>
        <input type="number" class="form-control proItemPriceInput" name="{{ $singleRecord?'price':'product['.$key.'][price]' }}" 
        value="{{ (int)@$dataItemProduct['price'] }}" min="0" required>
    </div>
    <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
        <label class="mb-0 mr-3 w_150 fs-13 text-capitalize">Thành tiền</label>
        <input type="number" class="form-control disable_field proItemTotalInput" name="{{ $singleRecord?'total_cost':'product['.$key.'][total_cost]' }}" 
        value="{{ (int)@$dataItemProduct['total_cost'] }}">
    </div>
    <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-12">
        <label class="mb-0 mr-3 w_150 fs-13 text-capitalize align-items-start">Ghi chú về sản phẩm</label>
        <textarea class="form-control" name="{{ $singleRecord?'note':'product['.$key.'][note]' }}">{{ @$dataItemProduct['note'] }}</textarea>
    </div>
</div>