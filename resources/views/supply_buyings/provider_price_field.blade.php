@php
    $provider_prices = [
        [
            'name' => $provider_name,
            'type' => 'linking',
            'note' => 'Tên NCC',
            'other_data' => [
                'config' => ['search' => 1],
                'data' => [
                    'table' => 'provider_prices'
                ]
            ],
            'attr' => [
                'nolabel' => 1,
                'readonly' => $readonly
            ]
        ],
        [
            'name' => $price_name,
            'type' => 'text',
            'note' => 'Đơn giá',
            'attr' => [
                'nolabel' => 1,
                'readonly' => $readonly,
                'type_input' => 'price'
            ]
        ]
    ];
@endphp
<div class="d-flex mb-2">
    <label class="mr-3 text-right mt-1" style="min-width:175px">{{ $note }}</label>
    <div class="position-relative row row-5">
        @foreach ($provider_prices as $provider_price)
            <div class="col-6">
                @include('view_update.view', $provider_price)
            </div>
        @endforeach   
    </div>
</div>