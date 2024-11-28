@php
    $object_name = @$object['name'] ?? getFieldDataById('name', 'product_warehouses', @$object['id']);
@endphp
<td>{{ getCleanString($object_name) }}</td>
<td>{{ $object['qty'] }}</td>
<td>{{ !empty($is_export) ? (float) $object['price'] : number_format($object['price']) }}</td>
<td>{{ !empty($is_export) ? (float) $object['total'] : number_format($object['total']) }}</td>