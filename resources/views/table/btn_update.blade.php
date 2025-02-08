@php
    $url_update = asset('update/'.$tableItem['name'].'/'.$data->id.''.@$param_action);
    $update_title = "Chi tiết ".$tableItem['note'];
@endphp
@if (hasNoSidebarParam())
    <button type="button" data-src = "{{ !empty($param_action) ? $url_update.'&nosidebar=1' : $url_update.'?nosidebar=1' }}" 
    class="btn btn-primary table-btn mr-2 mb-2 load_view_popup" 
    data-toggle="modal" data-target="#actionModal" title="{{ $update_title }}">
        <i class="fa fa-pencil-square-o fs-14" aria-hidden="true"></i>
    </button>      
@else
    <a href="{{ $url_update }}" class="table-btn mr-2 mb-2" title="{{ $update_title }}">
        <i class="fa fa-pencil-square-o fs-14" aria-hidden="true"></i>
    </a>
@endif