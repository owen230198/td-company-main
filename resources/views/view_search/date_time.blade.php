<div class="from_time col-6 mb_30 d-flex align-items-center border_right_eb">
	<label for="from_{{ $field["id"] }}" class="mr-2 d-block mb-0 min_100">{{ $field['note'] }} từ:</label>
	<input type="datetime-local" id="from_{{ $field["id"] }}" class="form-control" name="from_{{ $field["id"] }}" value="{{ @$data_search['from_'.$field["id".'']]?$data_search['from_'.$field["id".'']]:strftime('%Y-%m-%dT%H:%M:%S', Time()) }}">
</div>

<div class="to_time col-6 mb_30 d-flex align-items-center border_right_eb">
	<label for="to_{{ $field['id'] }}" class="mr-2 d-block mb-0 min_100">{{ $field['note'] }} đến:</label>
	<input type="datetime-local" id="to_{{ $field['id'] }}" class="form-control" name="to_{{ $field['id'] }}" value="{{ @$data_search['to_'.$field["id"].'']?$data_search['to_'.$field["id"].'']:strftime('%Y-%m-%dT%H:%M:%S', Time()) }}">
</div>