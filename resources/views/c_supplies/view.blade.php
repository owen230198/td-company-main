@extends('index')
@section('content')
    <div class="dashborad_content position-relative">
        <form action="{{ $action_url }}" method="POST" class="config_content baseAjaxForm" enctype="multipart/form-data">
            @csrf
            @if (!empty($dataItem['supply']))
                <input type="hidden" name="supply" value="{{ $dataItem['supply'] }}">
            @endif
            <div class="__c_supply_warehouse">
                <div class="__type_supply_select">
                    @foreach ($field_type as $field)
                        @php
                            $name = $field['name'];
                            $arr = processArrField($field);
                            $arr['value'] = @$dataItem[$name];
                            $arr['attr']['readonly'] = \GroupUser::isAdmin() || \GroupUser::isPlanHandle() ? 0 : 1;
                        @endphp
                        @include('view_update.view', $arr)
                    @endforeach
                </div>
                <div class="__ajax_qty_type">
                    @if ($dataItem['qty'] != '' && !empty($dataItem['supp_type']))
                        @include('view_update.c_supply_qty', ['type' => $dataItem['supp_type'], 'value' => $dataItem['qty']])
                    @endif
                </div>
                @foreach ($field_action as $action)
                    @php
                        $name = $action['name'];
                        $arr = processArrField($action);
                        $arr['value'] = @$dataItem[$name];
                        $arr['attr']['readonly'] = \GroupUser::isAdmin() || \GroupUser::isPlanHandle() ? 0 : 1;
                    @endphp
                    @include('view_update.view', $arr)
                @endforeach
            </div>
            @if (!empty($dataItem))
                @php
                    $bill_field = [
                        'note' => 'Phiếu xuất kho',
                        'type' => 'filev2',
                        'name' => 'bill',
                        'value' => @$dataItem['bill'],
                        'other_data' => ['role_update' => [\GroupUser::WAREHOUSE]] 
                    ]
                @endphp
                @include('view_update.view', $bill_field)
            @endif
            @include('action.list_button')
        </form>
    </div>
@endsection