@extends('index')
@section('content')
    <div class="dashborad_content position-relative pb-5 base_content pl-0 pt-3">
        <form action="{{ $action_url }}" method="POST" class="config_content baseAjaxForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="nosidebar" value="{{ !empty($nosidebar) }}">
            <div class="__c_order_action">
                <div class="__type_c_order_select">
                    @foreach ($field_customers as $fieldst)
                        @php
                            $name = $fieldst['name'];
                            $arr = processArrField($fieldst);
                            $value = @$dataItem->{$name};
                            $arr['value'] = $value;
                            $arr['attr']['readonly'] = $name == 'type' && !empty($value)  ? 1 : $check_readonly;
                        @endphp
                        @include('view_update.view', $arr)
                    @endforeach
                </div>
                <div class="__ajax_view_c_order_by_type">
                    @if (!empty($dataItem->type))
                        @php
                            $fiels = \App\Models\COrder::getFieldAjaxByType($dataItem->type, $dataItem)
                        @endphp
                        @include('c_orders.view_types.ajax',['fields' => $fiels])
                    @endif
                </div>
            </div>
            @if (!empty($dataItem))
                @php
                    $bill_field = [
                        'note' => 'Phiếu giao dịch',
                        'type' => 'filev2',
                        'name' => 'receipt',
                        'value' => @$dataItem['receipt'],
                        'other_data' => ['role_update' => [\GroupUser::PRODUCT_WAREHOUSE, \GroupUser::ACCOUNTING]] 
                    ]
                @endphp
                @include('view_update.view', $bill_field)
            @endif
            @include('action.list_button')
        </form>
    </div>
@endsection