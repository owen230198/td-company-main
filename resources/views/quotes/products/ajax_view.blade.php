@include('quotes.products.list_tab')
<div class="tab-content" id="quote-pro-tabContent">
    @foreach ($products as $pro_index => $product)
        <div class="tab-pane fade{{ $pro_index == 0 ? ' show active' : '' }} tab_pane_quote_pro" id="quote-pro-{{ $pro_index }}" role="tabpanel" aria-labelledby="quote-pro-{{ $pro_index }}-tab">
            <div class="config_handle_paper_pro">
                
                <div class="form-group d-flex mb-2">
                    <label class="min_210 mr-3"></label>
                    @if (!empty($product['id']))
                    <input type="hidden" name="product[{{ $pro_index }}][id]" value="{{ $product['id'] }}">
                    <input type="hidden" name="product[{{ $pro_index }}][ship_price]" value="{{ $product['ship_price'] }}">
                    <input type="hidden" name="product[{{ $pro_index }}][profit]" value="{{ $product['profit'] }}">
                    @if (empty($not_detail))
                        <div class="">
                            <button type="button" 
                            class="main_button color_white bg_red border_red red_btn radius_5 font_bold smooth show_config_handle_quote"
                            proindex = {{ $pro_index }} data-proid = {{ $product['id'] }} data-category = {{ @$product['category'] }}>
                                <i class="fa fa-angle-double-down fs-14 mr-2" aria-hidden="true"></i>
                                <span>Xem chi tiết sản xuất</span>
                            </button>
                        </div>    
                    @endif
                @endif
                </div>
                @include('products.base_field')
                <div class="ajax_product_view_by_category">
                    
                </div>
                
            </div>
            @if (!empty($product['id']))
                @php
                    $histories = \DB::table('n_log_actions')->where(['table_map' => 'products', 'target' => $product['id']])->orderBy('id', 'desc')->get();
                @endphp
                @if (!empty($histories))
                    <div class="history_product">
                        <h3 class="fs-14 text-uppercase border_bot_eb py-3 my-3 text-center">
                            <i class="fa fa-history mr-2 fs-14" aria-hidden="true"></i> Lịch sử đơn hàng
                        </h3>
                        @foreach ($histories as $history)
                            @include('histories.item')
                        @endforeach    
                    </div>
                @endif
            @endif
        </div>
    @endforeach
</div>