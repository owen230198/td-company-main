@php
    $class_price_input = '__provider_price_suggest_module';
    if (!$readonly) {
        $class_price_input .= ' __buying_price_input __buying_change_input';
    }
    $provider_prices = [
        [
            'name' => $provider_name,
            'type' => 'linking',
            'note' => 'Tên NCC',
            'value' => @$value['provider'],
            'other_data' => [
                'config' => ['search' => 1],
                'data' => [
                    'table' => 'provider_prices',
                    'where' => !empty($origin) ? ['origin' => $origin] : []
                ]
            ],
            'attr' => [
                'nolabel' => 1,
                'readonly' => $readonly,
                'inject_class' => '__provider_suggest_module'
            ]
        ],
        [
            'name' => $price_name,
            'type' => 'text',
            'note' => 'Đơn giá',
            'value' => @$value['price'],
            'attr' => [
                'nolabel' => 1,
                'readonly' => $readonly,
                'type_input' => 'price',
                'inject_class' => $class_price_input
            ]
        ]
    ];
@endphp
<div class="d-flex mb-2">
    <label class="mr-3 text-right mt-1" style="min-width:175px">{{ $note }}</label>
    <div class="position-relative row row-5 module_sugest_provider_buying">
        @foreach ($provider_prices as $provider_price)
            <div class="col-6">
                @include('view_update.view', $provider_price)
            </div>
        @endforeach   
    </div>
</div>