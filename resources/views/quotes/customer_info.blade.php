@include('quotes.base_field', ['fields' => $customer_fields, 'data_field' => $customer])
<div class="d-flex align-items-end form-group mb-2">
    <label class="mb-0 min_210 fs-13 text-capitalize justify-content-end mr-3 d-flex align-items-center"></label>
    <div class="infor form-control border-none p-0">
        <ul>
            @foreach ($represents as $represent)
                <li class="represent_item __choose_represent p-1 mb-1 radius_5 smooth {{ $represent->id == @$dataItem->represent ? 'active' : '' }}" data-id = {{ $represent->id }}>
                    <p class="font_bold"><i class="fa fa-user-circle mr-1 mb-1" aria-hidden="true"></i>Người liên hệ: {{ $represent->name }}</p> 
                    <p>
                        <i class="fa fa-users mr-1 mb-1" aria-hidden="true"></i>
                        @php
                            $sales = !empty($represent->sale) ? json_decode($represent->sale) : [$represent->created_by];
                            $users = '';
                            $txt = '';
                            foreach ($sales as $key => $sale_id) {
                                $txt = getFieldDataById('name', 'n_users', $sale_id);
                                if ($key != array_key_last($sales)) {
                                    $txt .= ', ';
                                }
                                $users .= $txt;
                            }
                        @endphp
                        {{ $users }}
                    </p>
                </li>
            @endforeach
        </ul>
    </div>
</div>
<div class="__ajax_represent_info">
    @if (!empty($dataItem))
        @include('quotes.represent_info')
    @endif
</div>

