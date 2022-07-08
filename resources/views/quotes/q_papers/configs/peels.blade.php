@php
  $data_peel = @$dataitem['peel']?json_decode($dataitem['peel'], true):array();
@endphp
@include('quotes.q_papers.active_view', ['icon'=>'american-sign-language-interpreting', 'note'=>'Bóc lề', 'key_act'=>'peel', 'active'=>@$data_peel['act']])
<div class="incredent_content mt-4" style="display: {{ @$data_peel['act']?'block':'' }};">
  @include('quotes.select_devices', ['key_device' => 'peel', 'device'=>@$data_peel['device']])
</div> 