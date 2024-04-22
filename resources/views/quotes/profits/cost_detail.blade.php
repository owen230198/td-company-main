<div class="quote_table_stage mb-4">
    <table class="table table-bordered mb-1 quote_table_profit">
        <thead>
            <tr>
                <th class="w_50">#</th>
                <th>Sản phẩm</th>
                @foreach ($supply_fields as $th)
                    <th>{{ @$th['note'] }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $key => $product)
                <tr>
                    <td class="w_50">{{ $key + 1 }}</td>
                    <td>{{ $product['name'] }}</td>
                    @php
                        $supply_product = \TDConst::HARD_ELEMENT;
                    @endphp
                    @foreach ($supply_product as $supply)
                        <td>
                            @php
                                $where = ['act' => 1, 'product' => $product['id']];
                                if ($supply['table'] == 'supplies') {
                                    $where['type'] = $supply['pro_field'];
                                }
                                $data_supply = \DB::table($supply['table'])
                                    ->where($where)
                                    ->get();
                                    if ($supply['table'] == 'papers') {
                                        $outside_products = \DB::table('products')->where('parent', $product['id'])->get();
                                        if ($outside_products->isNotEmpty()) {
                                            $data_supply = $data_supply->concat($outside_products)->toArray();
                                        }else{
                                            $data_supply = $data_supply->toArray();
                                        }
                                    }
                                if (!empty($supply['device'])) {
                                    $insert_device = ['size' => 'Vật tư'];
                                    if ($supply['table'] == 'papers') {
                                        $insert_device['print'] = 'Máy in';
                                        $supply['device'] = $insert_device + $supply['device'];
                                        $supply['device']['ext_price'] = 'Phát sinh';
                                    }
                                    if ($supply['table'] == 'supplies') {
                                        $supply['device'] = $insert_device + $supply['device'];
                                    }
                                    if ($supply['table'] == 'fill_finishes') {
                                        $supply['device'] = \TDConst::FILL_FINISH_STAGE;
                                    }
                                }
                            @endphp
                            <ul class="list_supplies">
                                @foreach ($data_supply as $key_supp => $item)
                                    @include('quotes.profits.item')
                                @endforeach
                            </ul>
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>