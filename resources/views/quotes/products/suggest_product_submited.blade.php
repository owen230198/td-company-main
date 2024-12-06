@if (empty($list_data))
    <p class="fs-15 font-italic color_red text-center mb-3">Chưa có sản phẩm cùng kích thước khuôn đã sản xuất !</p>
@else
    @php
        $viewTechFile = \App\Models\Product::canViewTechFile();
        $isSale = \GroupUser::isAdmin() || \GroupUser::isSale();
    @endphp
    <div class="table_base_view position-relative mb-3">
        <table class="table table-bordered table_main table_responsive">
            <theader>
                <tr>
                    <th class="font-bold fs-13 text-center parentth">#</th>
                    <th class="font-bold fs-13 text-center parentth">Tên</th>
                    <th class="font-bold fs-13 text-center parentth">Nhóm sản phẩm</th> 
                    <th class="font-bold fs-13 text-center parentth">Kích thước</th> 
                    <th class="font-bold fs-13 text-center parentth">File khuôn (kinh doanh)</th> 
                    <th class="font-bold fs-13 text-center parentth">File khuôn (kỹ thuật)</th> 
                    @if ($viewTechFile)
                        <th class="font-bold fs-13 text-center parentth">File TK</th> 
                        <th class="font-bold fs-13 text-center parentth">File đã bình</th>
                        <th class="font-bold fs-13 text-center parentth">Khuôn ép nhũ, in UV</th>            
                    @endif  
                    @if ($isSale)
                        <th class="font-bold fs-13 text-center parentth">Chức năng</th>         
                    @endif  
                </tr>
            </theader>
            <tbody>
                @foreach ($list_data as $key => $data)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $data->name }}</td>
                        <td>
                            {{ getFieldDataById('name', 'product_categories', $data->category) . ' - ' .  getFieldDataById('name', 'product_styles', $data->product_style) }}
                        </td>
                        <td>{{ getSizeTitleProduct($data) }}</td>
                        <td>
                            @include('view_table.file', ['value' => $data->sale_shape_file])
                        </td>
                        <td>
                            @include('view_table.file', ['value' => $data->tech_shape_file])
                        </td>
                        @if ($viewTechFile)
                            <td>
                                @include('view_table.file', ['value' => $data->design_file])
                            </td>
                            <td>
                                @include('view_table.file', ['value' => $data->design_shape_file])
                            </td>
                            <td>
                                @include('view_table.file', ['value' => $data->handle_shape_file])
                            </td>      
                        @endif
                        @if ($isSale)
                            <td>
                                <div class="list_table_func d-flex align-items-center justify-content-center">
                                    <a href="{{ asset('clone/products/'.$data->id) }}" class="table-btn mr-2 mb-2 __clone_item_confirm" 
                                        title="Tạo đơn hàng với sản phẩm này" data-name = '{{ $data->name }}'>
                                        <i class="fa fa-plus fs-14" aria-hidden="true"></i>
                                    </a>
                                    <a href="{{ asset('create-quote-by-products?id='.$data->id) }}" class="table-btn mr-2 mb-2 __clone_item_confirm" 
                                        title="Tạo báo giá với sản phẩm này" data-name = '{{ $data->name }}'>
                                        <i class="fa fa-plus-circle fs-14" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="paginate_view d-flex align-center justify-content-between mb-3">
        {!! $list_data->appends(request()->input())->links('pagination::bootstrap-4') !!}
    </div>
@endif