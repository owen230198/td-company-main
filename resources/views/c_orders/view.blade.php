@extends('index')
@section('content')
    <div class="dashborad_content position-relative">
        <form action="{{ $action_url }}" method="POST" class="config_content baseAjaxForm" enctype="multipart/form-data">
            @csrf
            <div class="__c_order_action">
                <div class="__type_c_order_select">
                    @foreach ($field_customers as $fieldst)
                        @php
                            $name = $fieldst['name'];
                            $arr = processArrField($fieldst);
                            $arr['value'] = @$dataItem[$name];
                            $arr['attr']['readonly'] = $check_readonly;
                        @endphp
                        @include('view_update.view', $arr)
                    @endforeach
                </div>
                <div class="__ajax_field_c_order_field">
                    @if (!empty($dataItem->order))
                        @php
                            $field_ordered = \App\Models\COrder::getFieldOrdered($dataItem);
                            $field_ordered['value'] = $dataItem->order; 
                        @endphp
                        @include('view_update.view', $field_ordered)   
                    @endif    
                </div>
                <div class="__cost_c_order_module">
                    @foreach ($field_costs as $fieldnd)
                        @php
                            $name = $fieldnd['name'];
                            $arr = processArrField($fieldnd);
                            $arr['value'] = @$dataItem[$name];
                        @endphp
                        @include('view_update.view', $arr)
                    @endforeach  
                </div>
            </div>
            @if (!empty($dataItem))
                @php
                    $bill_field = [
                        'note' => 'Phiếu xuất kho',
                        'type' => 'filev2',
                        'name' => 'receipt',
                        'value' => @$dataItem['receipt'],
                        'other_data' => ['role_update' => [\GroupUser::PRODUCT_WAREHOUSE]] 
                    ]
                @endphp
                @include('view_update.view', $bill_field)
            @endif
            @include('action.list_button')
        </form>
    </div>
@endsection