<ul class="nav nav-tabs tab_product_list" id="myTab" role="tablist">
    @for($i=0; $i<$proQuantity; $i++)
        <li class="nav-item button_item_config_product" data-target="pro-{{ $i }}">
            <a class="nav-link {{ $i==0?'active':'' }} pro-{{ $i }}-label" id="pro-{{ $i }}-tab" data-toggle="tab" href="#pro-{{ $i }}" role="tab" aria-controls="pro-{{ $i }}"
                aria-selected="true">{{ $proName.' '. $i+1 }}</a>
        </li>
    @endfor
</ul>
<div class="tab-content" id="myTabContent">
    @for($key=0; $key < $proQuantity; $key++)
        <div class="tab-pane {{ $key==0?'fade show active':'' }} py-3" id="pro-{{ $key }}" role="tabpanel" 
        aria-labelledby="pro-{{ $key }}-tab">
            @include('orders.products.base_informations')
            @include('orders.products.design_commands')
            @include('orders.products.process_commands')
        </div>
    @endfor
</div>
