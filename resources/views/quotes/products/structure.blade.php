@if (count($elements) > 1)
    <ul class="nav nav-pills mb-3 quote_pro_strct_nav_link" id="quote-pro-{{ $j }}-struct-tab" role="tablist">
        @foreach ($elements as $key => $element)
            <li class="nav-item">
                <a class="nav-link{{ $key == 0 ? ' active' : '' }}" id="quote-pro-{{ $j }}-struct-{{ $element['key'] }}-tab" data-toggle="pill" href="#quote-pro-{{ $j }}-struct-{{ $element['key'] }}" 
                role="tab" aria-controls="quote-pro-{{ $j }}-struct-{{ $element['key'] }}" aria-selected="true">{{ $element['note'] }}</a>
            </li>   
        @endforeach
    </ul>

    <div class="tab-content" id="quote-pro-{{ $j }}-struct-tabContent">
        @foreach ($elements as $key => $element)
            <div class="tab-pane fade{{ $key == 0 ? ' show active' : '' }} tab_pane_quote_pro" id="quote-pro-{{ $j }}-struct-{{ $element['key'] }}" role="tabpanel" aria-labelledby="quote-pro-{{ $j }}-struct-{{ $element['key'] }}-tab">
                @include('quotes.products.'.$element['key'].'.view', ['pindex' => 0])
            </div>
        @endforeach
    </div>
@else
    @include('quotes.products.papers.view', ['pindex' => 0])
@endif