<h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center quote_handle_title">
    <span>Phần thiết kế</span>
</h3>
@php
    $quote_pro_design = [
        'name' => 'product['.$pro_index.'][design]',
        'note' => 'thiết kế',
        'type' => 'linking',
        'other_data' => ['data' => ['table' => 'design_types', 'select' => ['id', 'name']]]
    ]
@endphp
@include('view_update.view', $quote_pro_design)