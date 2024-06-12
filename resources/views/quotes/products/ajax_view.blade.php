@include('quotes.products.list_tab')
<div class="tab-content" id="quote-pro-tabContent">
    @foreach ($products as $pro_index => $product)
        <div class="tab-pane fade{{ $pro_index == 0 ? ' show active' : '' }} tab_pane_quote_pro" id="quote-pro-{{ $pro_index }}" role="tabpanel" aria-labelledby="quote-pro-{{ $pro_index }}-tab">
            <div class="config_handle_paper_pro">
                @include('products.base_field')
                <div class="ajax_product_view_by_category">
                    
                </div>
                @if (!empty($product['id']))
                    <input type="hidden" name="product[{{ $pro_index }}][id]" value="{{ $product['id'] }}">
                    <input type="hidden" name="product[{{ $pro_index }}][ship_price]" value="{{ $product['ship_price'] }}">
                    <input type="hidden" name="product[{{ $pro_index }}][profit]" value="{{ $product['profit'] }}">
                    @if (empty($not_detail))
                        <div class="text-center">
                            <button type="button" 
                            class="main_button color_white bg_green border_green radius_5 font_bold smooth show_config_handle_quote"
                            proindex = {{ $pro_index }} data-proid = {{ $product['id'] }} data-category = {{ @$product['category'] }}>
                                <i class="fa fa-angle-double-down fs-14 mr-2" aria-hidden="true"></i>
                                <span>Xem chi tiết sản xuất</span>
                            </button>
                        </div>    
                    @endif
                @endif
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
                            @php
                                $user = getDetailDataByID('NUser', $history->user)
                            @endphp
                            <li class=" mb-2 pb-2 border_bot_eb d-flex justify-content-between">
                                <div class="history_content">Thời gian: <span class="color_green font_bold">{{ getDateTimeFormat($history->created_at) }}</span>,
                                {{ getFieldDataById('name', 'n_group_users', $user->group_user).' : ' }}<span class="color_green font_bold">{{ @$user->name }}</span>
                                đã {{ getActionHistory($history->action) }} sản phẩm <strong class="ml-1 color_green">{{ $product['name'] }}</strong></div> 
                                <div class="history_detail">
                                    <button type="button" 
                                            class="btn btn-primary main_button bg_main color_white smooth bg_green border_green radius_5 font_bold smooth ml-3 load_view_popup" 
                                            data-toggle="modal" data-target="#actionModal"
                                            data-src={{ url('history-detail/'.$history->id) }}>
                                    <i class="fa fa-info-circle mr-2 fs-15" aria-hidden="true"></i>Xem chi tiết thay đổi dữ liệu
                                </button>
                                </div>
                            </li>
                        @endforeach    
                    </div>
                @endif
            @endif
        </div>
    @endforeach
</div>