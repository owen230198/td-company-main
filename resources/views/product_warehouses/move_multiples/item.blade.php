@php
    $warehouse_take = [
        'name' => 'warehouse_take',
        'note' => 'Xuất tại kho',
        'type' => 'linking',
        'other_data' => [
            'config' => ['search' => 1], 
            'data'=> [
                'table' => 'supply_extends',
                'where' => ['type' => 'warehouse_type']
            ]
        ],
        'value' => @$product->warehouse_type
    ],
    $fields = [
        [
            'name' => 'id',
            'note' => 'Thành phẩm',
            'type' => 'linking',
            'other_data' => ['config' => ['search' => 1], 'data'=> ['table' => 'product_warehouses']],
            'attr' => ['readonly' => @$product->id ? 1 : 0],
            'value' => @$product->id
        ],
        [
            'name' => 'qty',
            'note' => 'Số lượng chuyển kho',
            'type' => 'text',
            'attr' => ['type_input' => 'number'],
            'value' => @$product->qty
        ],
        [
            'name' => 'warehouse_to',
            'note' => 'Nhập tại kho',
            'type' => 'linking',
            'other_data' => [
                'config' => ['search' => 1], 
                'data'=> [
                    'table' => 'supply_extends',
                    'where' => ['type' => 'warehouse_type']
                ]
            ],
            'value' => @$product->warehouse_type
        ],
        [
            'name' => 'note',
            'note' => 'Ghi chú',
            'type' => 'textarea',
            'value' => 'Chuyển thành phẩm '.@$product->name
        ],
        [
            'name' => 'receipt',
            'note' => 'Phiếu chuyển kho',
            'type' => 'filev2',
            'other_data' => ['role_update' => [\GroupUser::ACCOUNTING]] 
        ]
    ];
@endphp