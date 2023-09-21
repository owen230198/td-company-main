@if (isNotBox($cate))
<div class="form-group d-flex mb-2">
    <label class="mb-0 min_210 fs-13 text-capitalize justify-content-end mr-3 d-flex align-items-center">
        Nhập kích thước {{ !isNotBox(@$cate) ? ' hộp' : '' }}
    </label>
    @include('products.duo_size')
</div>
@else
    <div class="form-group d-flex mb-2">
        <label class="mb-0 min_210 fs-13 text-capitalize justify-content-end mr-3 d-flex align-items-center">
            Nhập kích thước hộp
        </label>
        @include('products.full_size',['pro_index' => @$pro_index])
    </div>
@endif
<div class="__suggest_product_submited_ajax">

</div>