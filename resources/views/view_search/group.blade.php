<div class="group_class_view {{ @$other_data['group_class'] }}" {{ @$other_data['inject_attr'] }}>
    <div class="row">
        @foreach ($child as $field_child)
            <div class="col-12 align-self-center">
                @include('view_search.view', ['field' => $field_child])
            </div>
        @endforeach  
    </div> 
</div>