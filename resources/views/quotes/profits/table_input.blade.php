<h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 handle_title">II. Chi phí vận chuyển & lợi nhuận sản phẩm</h3>
<table class="table table-bordered mb-1 quote_table_profit my-4">
    <thead class="font_bold">
        <tr>
            <th class="w_50">STT</th>
            <th style="min-width: 210px">Sản phẩm</th>
            <th>Chi phí vận chuyển</th>
            <th>Lợi nhuận %</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $key => $product)
            @php
                $base_name = 'product['.$product->id.']';
            @endphp
            <tr>
                <td class="w_50">{{ $key + 1 }}</td>
                <td style="min-width: 210px">{{ $product['name'] }}</td>
                <td>
                    <div class="form-group d-flex mb-2 align-items-center">
                        <input type="number" step="any" class="form-control medium_input" name="{{ $base_name }}[ship_price]" value="{{ @$product->ship_price }}" placeholder="Nhập chi phí vận chuyển (VNĐ)">
                    </div>
                </td>
                <td>
                    <div class="form-group d-flex mb-2 align-items-center">
                        <input type="number" step="any" class="form-control medium_input" name="{{ $base_name }}[profit]" value="{{ @$product->profit }}" placeholder="Nhập lợi nhuận sản phẩm (%)">
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>