@extends('index')
@section('content')
<div class="base_content_view">
    <div class="row">
        <div class="col-2">
            <ul class="supply_list_cate">
                @foreach ($supply_list as $supply_cate)
                    <li>
                        <a href="{{ url('supply-origin-management?type='.$supply_cate['type']) }}"
                         class="supply_cate_menu_item smooth {{ $cate_type == $supply_cate['type'] ? 'active' : '' }}">
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
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="{{ $list_data->count() + 1 }}" class="text-center font_bold fs-15 color_green w_220">{{ $cate_name }}</td>
                            </tr>
                            @foreach ($list_data as $key => $item)
                                <tr>
                                    <td class="w_50">{{ $key + 1 }}</td>
                                    <td>
                                        <button data-src="{{ url('view/supply_origins?type='.$cate_type.'&parent='.$item->id.'&nosidebar=1') }}" 
                                        class="color_main py-1 radius_5 mb-0 text-center load_view_popup d-block" 
                                        data-toggle="modal" data-target="#actionModal">
                                            {{ $item->name }}
                                        </button>
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