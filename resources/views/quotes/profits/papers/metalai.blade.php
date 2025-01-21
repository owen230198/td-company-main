<h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 handle_title">I.Cán metalai</h3>
@include('quotes.profits.papers.membrane', ['name' => 'metalai'])
@if (!empty($stage_cover))
    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 handle_title">II.Cán phủ trên</h3>
    @include('quotes.profits.papers.membrane', ['name' => 'phủ trên', 'stage' => $stage_cover])    
@endif