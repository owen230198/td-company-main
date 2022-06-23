<div class="d-flex align-items-center w-100">
	@php
		$id = $field['id']
	@endphp
	<label class="mr-2 d-block mb-0 min_100">{{ $field['note'] }}:</label>
	<input type="text" name="{{ $id }}" class="form-control station-richmenu-main-search__set" placeholder="Nhập thông tin {{ $field['note'] }}" value = "{{ @$data_search[$id]?$data_search[$id]:'' }}"/>
</div>