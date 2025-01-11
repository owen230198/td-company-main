@extends('index')
@section('content')
<div class="base_content_view">
    <div class="row">
        <div class="col-2">
            <ul class="supply_list_cate">
                @foreach ($supply_list as $supply_cate)
                    <li>
                        <a href="{{ url('supply-origin-management?type='.$supply_cate['type']) }}"
                         class="supply_cate_menu_item smooth {{ @$cate_type == $supply_cate['type'] ? 'active' : '' }}">
                            {{ @$supply_cate['note'] }}
                        </a>  
                    </li>  
                @endforeach
            </ul>
        </div>
        @if (!empty($list_data))
            <div class="col-9">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" class="w_220">Nhóm vật tư</th>
                                <th scope="col" class="w_50">STT</th>
                                <th scope="col">Tên vật tư</th>
                                <th scope="col">DS định lượng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="{{ $list_data->count() + 1 }}" class="text-center font_bold fs-15 color_green w_220">{{ $cate_name }}</td>
                            </tr>
                            @foreach ($list_data as $key => $item)
                                @php
                                    $link_provider = 'view/supply_prices?default_data=%7B"type"%3A"'.$cate_type.'","supply_id":"'.$item->id.'"%7D&nosidebar=1';
                                @endphp
                                <tr>
                                    <td class="w_50">{{ $key + 1 }}</td>
                                    <td>
                                        <button data-src="{{ url('update/'.$table_parent.'/'.$item->id.'?nosidebar=1') }}" 
                                        class="color_main py-1 radius_5 mb-0 text-center load_view_popup d-block" 
                                        data-toggle="modal" data-target="#actionModal">
                                            {{ $item->name }}
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        @include('action.popupbtn', [
                                            'url' => $link_provider, 
                                            'note' => 'Bảng giá định lượng',
                                            'icon' => 'list-ul'
                                            ])
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection