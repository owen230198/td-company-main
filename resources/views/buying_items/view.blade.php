@extends('index')
@section('content')
    <div class="dashborad_content position-relative">
        <form action="{{ $action_url }}" method="POST" class="config_content baseAjaxForm" enctype="multipart/form-data">
            @csrf
            @include('supply_buyings.supply_item', [
                'index' => 0,
                'supp_type' => $dataItem->type,
                'value' => $dataItem,
                'field_injects' => $field_exts,
                'no_suggest' => !empty($no_suggest)
            ])
            @include('action.list_button')
        </form>
    </div>
@endsection