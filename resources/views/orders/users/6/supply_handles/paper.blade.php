@extends('orders.users.6.supply_handles.supplies')
@section('process')
    @include('quotes.products.papers.supply_print', ['no_exc' => 1])
    <div class="process_paper_plan">
        @include('orders.users.6.supply_handles.handle', [
            'where_size_supp' => [
                    'type' => 'paper',
                    'supp_price' => @$supply_size['supply_price'],
                    'status' => 'imported'
            ],
            'table_type' => 'print_warehouses',
            'no_elevate_handle' => true,
            'compen_percent' => getDataConfig('QuoteConfig', 'COMPEN_PERCENT')
        ])
    </div>    
@endsection