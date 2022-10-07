<div class="d-flex align-items-center w-100">
	@php
		$id = $field['id']
	@endphp
	<label class="mr-2 d-block mb-0 min_100">{{ $field['note'] }}:</label>
	<input type="text" autocomplete="off" name="{{ $id }}" class="form-control station-richmenu-main-search__set dateRangeInput" placeholder="Chọn thời gian" value = "{{ @$data_search[$id]?$data_search[$id]:'' }}"/>
</div>