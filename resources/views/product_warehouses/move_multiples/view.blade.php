@extends('index')
@section('content')
    <div class="dashborad_content config_content base_content p-0 pb-5">
        <form action="{{ url($action_url) }}" method="POST" class="mb-0 baseAjaxForm">
            <div class="__multiple_product_warehouse_module py-3">
                <div class="table_base_view position-relative">
                    <table class="table table-bordered mb-2 table_responsive">
                        <thead>
                            <tr>
                                @foreach ($fields as $field)
                                    <th class="font-bold fs-13">
                                        {{ $field['note'] }}
                                    </th>
                                @endforeach
                                <th class="font-bold fs-13">
                                    #
                                </th>
                            </tr>
                        </thead>
                        <tbody class="__list_product_move_warehouse">
                            @include('product_warehouses.move_multiples.json_item')
                        </tbody>
                    </table>
                </div>
                <div class="text-center my-3">
                    <button type="button" class="main_button color_white bg_green border_green radius_5 font_bold sooth __add_item_move_warehouse" data-table="product_warehouses">
                        <i class="fa fa-plus mr-2 fs-14" aria-hidden="true"></i> Thêm
                    </button>
                </div>
            </div>
            <div class="group_btn_action_form text-center w-100">
                <button type="submit" disabled class="main_button color_white bg_green border_green radius_5 font_bold smooth mr-2">
                    <i class="fa fa-check mr-2 fs-14" aria-hidden="true"></i>Hoàn tất
                </button>
                <button type="button" class="main_button bg_red color_white radius_5 font_bold smooth red_btn close_action_popup">
                    <i class="fa fa-times mr-2 fs-14" aria-hidden="true"></i>Hủy
                </button>
            </div>
        </form>  
    </div>
@endsection
@push('bottom-scripts')
    <script src="{{ asset('frontend/admin/script/order.js') }}"></script>
@endpush
