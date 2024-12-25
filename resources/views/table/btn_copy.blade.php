@php
    $url_clone = asset('clone/'.$tableItem['name'].'/'.$data->id.''.@$param_action);
    $update_title = "Chi tiết ".$tableItem['note'];
    $clone_name = (@$data->code ?? @$data->seri) ?? @$data->name;
@endphp
@if (hasNoSidebarParam())
    <button type="button" data-src = "{{ !empty($param_action) ? $url_clone.'&nosidebar=1' : $url_clone.'?nosidebar=1' }}" 
    class="btn btn-primary table-btn mr-2 mb-2  {{ $tableItem['copy'] == 2 ? '__clone_item_confirm' : 'load_view_popup' }}" 
    data-toggle="modal" data-target="#actionModal" title="{{ $update_title }}">
        <i class="fa fa-clone fs-14" aria-hidden="true"></i>
    </button>    
@else
    <a href="{{ $url_clone }}" 
        class="table-btn mr-2 mb-2 {{ $tableItem['copy'] == 2 ? '__clone_item_confirm' : '' }}" 
        title="{{ $tableItem['note'] }}" data-name = {{ $clone_name }}>
        <i class="fa fa-clone fs-14" aria-hidden="true"></i>
    </a>	
@endif