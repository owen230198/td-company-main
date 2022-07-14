@php
	$action = @$dataitem['id']?'update':'insert';
@endphp
<form action="do-{{ $action }}-detail/q_finishes/{{ $data_quotes['id'] }}{{ @$dataitem['id']?'/'.$dataitem['id']:'' }}" method="POST" class="formActionS possition-relative">
	@csrf
	<div class="px-3 py-4 bg_white radius_5">
		<div class="d-flex align-items-center mb-4">
		  	<label class="base_label mr-2 mb-0 label_quotes">Đơn giá bồi:</label>
		  	@php
		    	$data_fill = @$dataitem['fill_price']?json_decode($dataitem['fill_price'], true):array();
		  	@endphp
		  	<input type="hidden" name="fill_price[act]" value="1">
			<input class="form-control fs-15 short_input mr-3" placeholder="Nhập giá" type="number" name="fill_price[price]" value="{{ @$data_fill['price']?$data_fill['price']:'' }}" min="0" required step="any">
		</div>
		<div class="d-flex align-items-center mb-4">
		  	<label class="base_label mr-2 mb-0 label_quotes">Đơn giá hoàn thiện:</label>
		  	@php
		    	$data_finishes = @$dataitem['finish_price']?json_decode($dataitem['finish_price'], true):array();
		  	@endphp
		  	<input type="hidden" name="finish_price[act]" value="1">
			<input class="form-control fs-15 short_input mr-3" placeholder="Nhập giá" type="number" name="finish_price[price]" value="{{ @$data_finishes['price']?$data_finishes['price']:'' }}" min="0" required step="any">
		</div>
		<div class="d-flex justify-content-center">
		    <button type="submit" class="station-richmenu-main-btn-area mr-2">
		      <i class="fa fa-check mr-1 fs-17" aria-hidden="true"></i>Hoàn tất
		    </button>
		    <a href="config-profits/{{ $data_quotes['id'] }}" class="station-richmenu-main-btn-area">
		      <i class="fa fa-step-forward mr-1 fs-17" aria-hidden="true"></i>Bỏ qua
		    </a>
		</div>
	</div>
</form>