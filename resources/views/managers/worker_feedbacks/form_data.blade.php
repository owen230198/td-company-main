<input type="hidden" name="id" value="{{ @$data_command->id }}">
<input type="hidden" name="type" value="{{ @$data_command->type }}">
@php
    $type = @$data_command->type;
    $path = 'managers.worker_feedbacks.types.'.$type;
    $factor = @$value['factor'] ?? (@$data_command->factor ?? 1);
@endphp
@if (view()->exists($path))
    @include($path, ['value' => $value])  
@endif
<div class="form-group d-flex mb-2">
    <label class="mb-0 min_150 fs-13 text-capitalize justify-content-end mr-3 d-flex mt-1">
        Hệ số lượt đúng
    </label>
    <select name="factor" class="form-control">
        @for ($i = 1; $i <= 6;  $i++)
            <option value="{{ $i }}" {{ $factor == $i ? 'selected' : '' }}>{{ $i }}</option>
        @endfor
    </select>
    
</div>
<div class="form-group d-flex mb-2">
    <label class="mb-0 min_150 fs-13 text-capitalize justify-content-end mr-3 d-flex mt-1">
        Ghi chú
    </label>
    <textarea name="note" class="form-control">{{ @$value['note'] }}</textarea>
</div>