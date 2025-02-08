@php
    $value = !empty($value) ? json_decode($value, true) : [];
@endphp
@if (!empty($value['print']) || !empty($value['handle']))
    @if (!empty($value['print']))
        <div class="mb-2 fs-12">
            <i class="fa fa-asterisk mr1" aria-hidden="true"></i>
            Ghi chú khâu in: 
            {{ getFieldDataById('name', 'print_notes', $value['print']) }}
        </div>
    @endif
    @if (!empty($value['handle']))
        <div class="mb-2 fs-12">
            <i class="fa fa-asterisk mr1" aria-hidden="true"></i>
            Ghi chú gia công: 
            {{ $value['handle'] }}
        </div>
    @endif
@else
    <p class="font-italic">Chưa có ghi chú !</p>    
@endif