<div class="form-group d-flex align-items-center mb-4"> 
  <label class="base_label mr-2 mb-0 label_quotes">Tên sản phẩm báo giá</label>
  <input class="form-control" type="text" name="name" value="{{ @$dataitem['name']?$dataitem['name']:'' }}" required>
</div>
<div class="form-group d-flex align-items-center mb-4"> 
<label class="base_label mr-2 mb-0 label_quotes">Xuất file báo giá</label>
<div class="checkbox_module">
  <input type="hidden" name="main" value = "{{ @$dataitem['main']?1:0 }}">
  <input type="checkbox" class="toggle mx-auto change_active_stage" {{ @$dataitem['main']?'checked':'' }} />
</div>
</div>
@include('quotes.tables.general_field', ['key_plus_paper'=>'PLUS_PAPER'])
@include('quotes.q_papers.configs.papers')
