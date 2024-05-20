@extends('index')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/admin/css/quote.css') }}">
@endsection
@section('content')
    <div class="dashborad_content">
        <form action="{{ $link_search }}" method="GET" class="mb-0 inventoryFormAjax" id="form-search">
            <input type="hidden" name="is_ajax" value="1">
            <div class="row align-items-end my-3 justify-content-between">
                <div class="inventory_form_search col-6">
                    @if (!empty($is_detail) && !empty($data_item))
                        <input type="hidden" name="is_ajax" value="1">
                        <input type="hidden" name="is_detail" value="1">
                        @foreach ($data_item as $key => $value)
                            @if ($key != 'created_at')
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}"> 
                            @endif   
                        @endforeach
                    @endif
                    @foreach ($fields as $field)
                        @include('view_search.view', ['field' => $field])
                    @endforeach
                    <div class="inventory_ajax_field_search">
                        
                    </div>
                </div>
                <div class="inventory_form_btn col-6">
                    <button type="submit"class="main_button bg_main color_white smooth bg_green border_green radius_5 font_bold smooth mr-2"
                        form="form-search" value="submit">
                        <i class="fa fa-filter mr-2 fs-15" aria-hidden="true"></i>Hoàn tất
                    </button>
                    <a href="javascript:void(0)" class="main_button bg_main color_white smooth bg_green border_green radius_5 font_bold smooth inventory_export_excel">
                        <i class="fa fa-file-excel-o mr-2 fs-15" aria-hidden="true"></i>Export excel
                    </a>
                </div>
            </div>
        </form>
        <div class="ajax_data_inventory">
            @if (!empty($is_detail))
                @include('inventories.detail')
            @endif    
        </div>
    </div>
    @include('table/action_popup')
@endsection
@section('script')
    <script src="{{ asset('frontend/admin/script/order.js') }}"></script>
@endsection
