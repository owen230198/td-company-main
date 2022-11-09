<div class="form-group mb-3 pb-3 border_bot_eb vat_cost_group_input d_flex col-4" {{ @$dataItemOrder['vat']==1?'style="display: none"':'' }}>
    <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">VAT(%)</label>
    <input type="number" class="form-control" name="order[vat_percent]" value="{{ (int)@$dataItemOrder['vat_percent'] }}">
</div>
<div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
    <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Tiền hàng</label>
    <input type="number" class="form-control disable_field" name="order[product_cost]" value="{{ (int)@$dataItemOrder['product_cost'] }}">
</div>
<div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
    <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Tổng tiền</label>
    <input type="number" class="form-control disable_field" name="order[total_cost]" value="{{ (int)@$dataItemOrder['total_cost'] }}">
</div>
<div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
    <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Tạm ứng</label>
    <input type="number" class="form-control" name="order[advance_cost]" value="{{ (int)@$dataItemOrder['advance_cost'] }}">
</div>
<div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
    <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Còn lại</label>
    <input type="number" class="form-control disable_field" name="order[rest_cost]" value="{{ (int)@$dataItemOrder['rest_cost'] }}">
</div>
@php
    $orderPaper = !empty($dataItemOrder['json_data_paper'])?json_decode($dataItemOrder['json_data_paper'], true):[];
@endphp
<div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
    <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Định lượng giấy in</label>
    <input type="number" class="form-control" name="order[json_data_paper][quantative]" value="{{ (int)@$orderPaper['quantative'] }}" min="0" required>
</div>
<div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
    <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Loại giấy in</label>
    <select name="order[json_data_paper][substance]" class="form-control select_config" required>
        <option value="0">Chọn loại giấy</option>
        @foreach ($listPaperSubs as $item)
            <option value="{{ @$item['id'] }}" {{ @$orderPaper['substance']==@$item['id']?'selected':'' }}>{{ $item['name'] }}</option> 
        @endforeach
    </select>
</div>
