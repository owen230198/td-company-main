@extends('index')
@section('content')
    @include('title_base_page')
    <div class="dashborad_content">
        @include('base_title', ['text' => '1. Thông tin sản phẩm'])
        <div class="d-flex justify-content-center flex-wrap p-1  radius_5 box_shadow_3 mb-4">
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
    @include('base_title', ['text' => '2. Yêu cầu kế toán nhập kho'])
    <div class="p-3  radius_5 box_shadow_3 mb-4">
        @php
            $arr_fields = [
                [
                    'name' => '',
                    'note' => 'Sản phẩm',
                    'type' => 'text',
                    'attr' => ['disable_field' => 1],
                    'value' => $data_product->name
                ],
                [
                    'name' => '',
                    'note' => 'Số lượng đã sản xuất',
                    'type' => 'text',
                    'attr' => ['disable_field' => 1],
                    'value' => $data_product->qty
                ],
                [
                    'name' => 'status',
                    'note' => 'Tình trạng nhập kho',
                    'type' => 'select',
                    'attr' => ['inject_class' => '__expertise_status_select'],
                    'other_data' => ['data' => ['options' => $status_exper_option]]
                ]
            ];
            $expertise_qty = [
                'name' => 'qty',
                'note' => 'Số lượng yêu cầu nhập kho',
                'type' => 'text',
                'attr' => ['type_input' => 'number'],
                'value' => $data_product->qty
            ]
        @endphp
        <form action="{{ url('kcs-take-in-req/'.$data_product->id) }}" method="POST" class="config_content baseAjaxForm" enctype="multipart/form-data">
            @csrf
            @foreach ($arr_fields as $field)
                @include('view_update.view', $field)
            @endforeach
        </form>
    </div>
@endsection