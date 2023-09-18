@if (@$attr['type_input'] == 'number')
    <div id="slider-range" class="price-filter-range" name="rangeInput"></div>
    <div style="my-3">
        <input type="number" min=0 max="9900" oninput="validity.valid || (value='0');" id="min_price" class="price-range-field" />
        <input type="number" min=0 max="10000" oninput="validity.valid || (value='10000');" id="max_price" class="price-range-field" />
    </div>
@else
    <input type="text" name="{{ $name }}" class="form-control" placeholder="Nhập thông tin {{ $note }}" value = "{{ @$data_search[$name]}}"/>
@endif