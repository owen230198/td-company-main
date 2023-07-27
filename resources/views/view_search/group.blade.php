<div class="group_class_view {{ @$other_data['group_class'] }} col-{{ @$other_data['width'] ?? '12' }}" {{ @$other_data['inject_attr'] }}>
    <div class="row">
        @foreach ($child as $field_child)
            <div class="col-{{ @$other_data['width_child'] ?? '6' }} align-self-center">
                @include('view_search.view', ['field' => $field_child])
            </div>
        @endforeach  
    </div> 
</div>