<ul class="nav nav-pills mb-3 pro_nav_link" id="quote-pro-tab" role="tablist" {{ request()->has('nosidebar') ? 'style=top:40px' : '' }}>
    <label class="mb-0 min_210 mr-3"></label>
    @foreach ($products as $i => $product)
        <li class="nav-item">
            <a class="nav-link{{ $i == 0 ? ' active' : '' }}" id="quote-pro-{{ $i }}-tab" data-toggle="pill" href="#quote-pro-{{ $i }}" 
            role="tab" aria-controls="quote-pro-{{ $i }}" aria-selected="true">
                {{ @$product['name'] }}
            </a>
        </li>
    @endforeach
</ul>