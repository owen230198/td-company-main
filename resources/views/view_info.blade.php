
<div class="form-group d-flex mb-1 pb-1 border_bot_eb_dashed">
    <label 
    class="mb-0 min_210 fs-13 text-capitalize justify-content-end mr-3 d-flex base_label_input" 
    style="{{ !empty($min_label) ? 'min-width:'.$min_label.'px' : '' }}">
        {{ $name }} : 
    </label>
    <p class="color_green font_nold">
        {{ $value }}
    </p>
</div>