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
                {{ getDateTimeFormat($data_product->updated_at) }}
            </strong></p>
        </div>
    </div>
    @include('base_title', ['text' => '2. Yêu cầu kế toán nhập kho'])
    <div class="p-3  radius_5 box_shadow_3 mb-4 pb-5">
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
                    'name' => 'take_status',
                    'note' => 'Trạng thái nhập kho',
                    'type' => 'select',
                    'attr' => ['inject_class' => '__expertise_status_select'],
                    'other_data' => ['data' => ['options' => $status_exper_option]]
                ],
                [
                    'name' => 'note',
                    'note' => 'Ghi chú',
                    'type' => 'textarea'
                ]
            ];
            $problem_handle_fields = [
                [
                    'name' => 'qty',
                    'note' => 'SL đủ tiêu chuẩn nhập kho',
                    'type' => 'text',
                    'attr' => ['type_input' => 'number', 'inject_class' => '__expertise_qty']
                ],
                [
                    'name' => 'handle_problem',
                    'note' => 'Xử lí sản phẩm lỗi',
                    'type' => 'select',
                    'other_data' => ['data' => ['options' => $prob_handle_option]]
                ]
            ];
        @endphp
        <form action="{{ url('kcs-take-in-req/'.$data_product->id) }}" method="POST" class="config_content baseAjaxForm" enctype="multipart/form-data">
            @csrf
            @foreach ($arr_fields as $field)
                @include('view_update.view', $field)
            @endforeach
            <div class="problerm_module" style="display:{{ @$data_command->status == \App\Models\Cexpertise::PROBLEM ? 'block' : 'none' }}">
                @foreach ($problem_handle_fields as $p_field)
                    @include('view_update.view', $p_field)
                @endforeach
            </div>
            <div class="group_btn_action_form text-center w-100">
                <button type="submit" disabled class="main_button color_white bg_green border_green radius_5 font_bold smooth mr-3">
                    <i class="fa fa-check mr-2 fs-14" aria-hidden="true"></i>Hoàn tất
                </button>
                <button class="main_button bg_red color_white radius_5 font_bold smooth red_btn __close_modal_action">
                    <i class="fa fa-times mr-2 fs-14" aria-hidden="true"></i>Hủy
                </button>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script src="{{ asset('frontend/admin/script/order.js') }}"></script>
@endsection