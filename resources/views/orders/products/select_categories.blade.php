<div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
    <label class="mb-0 mr-3 w_150 fs-13 text-capitalize">Nhóm sản phẩm</label>
    <select name="{{ $singleRecord?'product_category_id':'product['.$key.'][product_category_id]' }}" 
    class="form-control select_config sellectProCate" data-key = {{ @$key }}>
        <option value="">Chọn danh mục</option>
        @foreach ($listTypeProcate as $t_key => $cateType)
            <optgroup label="{{ @$cateType['name'] }}">
                @if (is_array(@$cateType['child']))
                    @foreach ($cateType['child'] as $tc_key => $typeChild)
                        <optgroup label="__{{ @$typeChild['name'] }}">
                            @foreach ($listProCate as $cateroryChild)
                                @if (@$cateroryChild['parent'] == $tc_key)
                                    <option value="{{ @$cateroryChild['id'] }}" {{ @$dataItemProduct['product_category_id']==$cateroryChild['id']?'selected':'' }}>
                                        ___{{ @$cateroryChild['name'] }}
                                    </option>
                                @endif    
                            @endforeach
                        </optgroup>
                    @endforeach   
                @endif
                @foreach ($listProCate as $category)
                    @if (@$category['parent'] == $t_key)
                        <option value="{{ @$category['id'] }}" {{ @$dataItemProduct['product_category_id']==$category['id']?'selected':'' }}>___{{ @$category['name'] }}</option>
                    @endif    
                @endforeach
            </optgroup> 
        @endforeach
    </select>
</div>