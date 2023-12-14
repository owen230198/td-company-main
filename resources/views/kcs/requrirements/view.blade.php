@extends('index')
@section('content')
    @include('title_base_page')
    <div class="dashborad_content">
        <div class="d-flex justify-content-center flex-wrap p-1  radius_5 box_shadow_3">
            <p class="m-2">Mã đơn: <strong class="ml-1 color_green">{{ $data_product->code }},</strong></p>
            <p class="m-2">Tên sản phẩm: <strong class="ml-1 color_green">{{ $data_product->name }},</strong></p>
            <p class="m-2">Số lượng: <strong class="ml-1 color_green">
                {{ $data_product->qty }},
            </strong></p>
            <p class="m-2">Nhóm sản phẩm: <strong class="ml-1 color_green">
                {{ getFieldDataById('name', 'product_categories', $data_product->category) }},
            </strong></p>
            <p class="m-2">Phụ trách: <strong class="ml-1 color_green">
                {{ getFieldDataById('name', 'n_users', $data_product->created_by) }},
            </strong></p>
            <p class="m-2">Hoàn thành SX: <strong class="ml-1 color_green">
                {{ date('d/m/Y H:i', strtotime($data_product->updated_at)) }}
            </strong></p>
        </div>
    </div>
@endsection