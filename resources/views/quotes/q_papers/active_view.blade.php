<div class="incredent_header d-flex align-item-centers">
  <label class="base_label mr-2 mb-0 label_quotes fs-14 font_bold d-flex align-item-centers text-uppercase">
    <i class="fa fa-{{ $icon }} mr-2 fs-18" aria-hidden="true"></i>{{ $note }}
  </label>
  <div class="checkbox_module">
    <input type="hidden" name="{{ $key_act }}[act]" value = "{{ @$active?1:0 }}">
    <input type="checkbox" class="toggle mx-auto change_active_stage" {{ @$active?'checked':'' }} />
  </div>   
</div>