<ul class="nav nav-pills mb-3" id="order-pro-tab" role="tablist">
    <label class="mb-0 min_210 mr-3"></label>
    @foreach ($products as $i => $product)
        <li class="nav-item">
            <a class="nav-link{{ $i == 0 ? ' active' : '' }}" id="order-pro-{{ $i }}-tab" data-toggle="pill" href="#order-pro-{{ $i }}" 
            role="tab" aria-controls="order-pro-{{ $i }}" aria-selected="true">
                {{ @$product['name'] }}
            </a>
        </li>
    @endforeach
</ul>

<div class="tab-content" id="order-pro-tabContent">
    @foreach ($products as $pro_index => $product)
        <div class="tab-pane fade{{ $pro_index == 0 ? ' show active' : '' }} tab_pane_order_pro" id="order-pro-{{ $pro_index }}" role="tabpanel" aria-labelledby="order-pro-{{ $pro_index }}-tab">
            <div class="base_info_section mb-3">
                <div class="d-flex align-items-center mb-2 fs-13">
                    <label class="mb-0 min_210 text-capitalize text-right mr-3">Tên sản phẩm: </label>
                    <p class="font_italic">{{ $product['name'] }}</p>
                </div>
                <div class="d-flex align-items-center mb-2 fs-13">
                    <label class="mb-0 min_210 text-capitalize text-right mr-3">Số lượng: </label>
                    <p class="font_italic">{{ $product['qty'] }}</p>
                </div>
                <div class="d-flex align-items-center mb-2 fs-13">
                    <label class="mb-0 min_210 text-capitalize text-right mr-3">Nhóm sản phẩm: </label>
                    <p class="font_italic">
                        {{ getFieldDataById('name', 'product_categories', $product['category']) }}   
                    </p>
                </div>
                <div class="d-flex align-items-center mb-2 fs-13">
                    <label class="mb-0 min_210 text-capitalize text-right mr-3">Thiết kế: </label>
                    <p class="font_italic">
                        {{ getFieldDataById('name', 'design_types', $product['design']) }}   
                    </p>
                </div>
                <div class="d-flex align-items-center mb-2 fs-13">
                    <label class="mb-0 min_210 text-capitalize text-right mr-3">Kích thước hộp: </label>
                    <p class="font_italic">{{ $product['size'] }}</p>
                </div>
            </div>    
        </div>
    @endforeach
</div>