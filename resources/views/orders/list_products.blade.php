<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="pro-1-tab" data-toggle="tab" href="#pro-1" role="tab" aria-controls="pro-1"
            aria-selected="true">Sản phẩm 1</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="pro-2-tab" data-toggle="tab" href="#pro-2" role="tab" aria-controls="pro-2"
            aria-selected="false">Sản phẩm 2</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active py-3" id="pro-1" role="tabpanel" aria-labelledby="pro-1-tab">
        @include('orders.products.base_informations')
        @include('orders.products.design_commands')
        @include('orders.products.print_commands')
        @include('orders.products.process_commands')
    </div>
    <div class="tab-pane fade" id="pro-2" role="tabpanel" aria-labelledby="pro-2-tab">
        @include('orders.products.base_informations')
        @include('orders.products.design_commands')
        @include('orders.products.print_commands')
        @include('orders.products.process_commands')
    </div>
</div>
