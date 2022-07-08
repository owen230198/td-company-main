@php
  $data_paste = @$dataitem['paste']?json_decode($dataitem['paste'], true):array();
@endphp
@include('quotes.q_papers.active_view', ['icon'=>'cubes', 'note'=>'Dán hộp', 'key_act'=>'paste', 'active'=>@$data_paste['act']])
<div class="incredent_content mt-4" style="display: {{ @$data_paste['act']?'block':'' }};">
  @include('quotes.select_devices', ['key_device' => 'paste', 'device'=>@$data_paste['device']]) 
</div> 