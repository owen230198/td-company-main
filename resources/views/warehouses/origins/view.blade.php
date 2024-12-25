@extends('index')
@section('content')
<div class="base_content_view">
    <div class="row">
        <div class="col-2">
            <ul class="supply_list_cate">
                @foreach ($supply_list as $supply_cate)
                    <li>
                        <a href="{{ url('supply-origin-management?type='.$supply_cate['type']) }}"
                         class="supply_cate_menu_item smooth {{ request()->type == $supply_cate['type'] ? 'active' : '' }}">
                            {{ @$supply_cate['note'] }}
                        </a>  
                    </li>  
                @endforeach
            </ul>
        </div>
    </div>
@endsection