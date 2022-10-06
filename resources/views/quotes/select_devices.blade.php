@php
  $list_devices = getDataTable('q_devices', 'id, name', array(
    ['key'=>'act', 'compare'=>'=', 'value'=>1], 
    ['key'=>'key_device', 'compare'=>'=', 'value'=>$key_device]), 0, 'ord', 'asc');
  $list_devices = $list_devices!=null?$list_devices:array();
@endphp
<div class="d-flex align-items-center">
  @if (!@$hide_label)
    <label class="base_label mr-2 mb-0 label_quotes">Thiết bị</label>
  @endif
  <div class="d-flex align-items-center fs-13 mr-3 mb-md-0 mb-3">
    <div class="form-group d-flex align-items-center mb-0">
      <select class="form-control short_input" name="{{ $key_device }}[device]">
        <option value="0" {{ @$device==0?'selected':'' }}>Chọn thiết bị</option>
        @foreach ($list_devices as $item)
          <option value="{{ $item->id }}" {{ @$device==$item->id?'selected':'' }}>{{ $item->name }}</option>
        @endforeach
      </select>
    </div>
  </div>
</div> 