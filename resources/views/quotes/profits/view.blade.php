<div class="px-3 py-4 bg_white radius_5">
	<div class="quote_model py-lg-5 py-4">
		<div class="quote_content px-lg-5 position-relative">
			<div class="quote_bg_content">
				<div class="table_quote my-lg-4 my-3">
					@include('quotes.profits.supply_tables')
				    <div class="text-center p-2 border_grey">
				    	<p class="fs-23 color_red font_bold">TỔNG GIÁ : {{ number_format($data_quotes['total_cost']) }} VNĐ</p>
				    </div>
				</div>
			</div>
		</div>	
	</div>
	<form action="config-profits/{{ $data_quotes['id'] }}" class="formActionS possition-relative" method="POST">
		@csrf
		<div class="form-group mb-3 d-md-flex flex-wrap align-items-center">
			<label class="base_label mr-2 label_quotes">Chi phí vận chuyển</label>
			<div class="d-flex align-items-center">
				<input class="form-control fs-13 short_input" type="number" name="ship_price" value="{{ @$data_quotes['ship_price']?(int)$data_quotes['ship_price']:'' }}" min="0" step="any" required>
			</div> 	
		</div>
		<div class="form-group mb-3 d-md-flex flex-wrap align-items-center">
			<label class="base_label mr-2 label_quotes">Lợi nhuận đơn (%)</label>
			<div class="d-flex align-items-center">
				<input class="form-control fs-13 short_input" type="number" name="profit" value="{{ @$data_quotes['profit']?(int)$data_quotes['profit']:'' }}" min="0" step="any" required>
			</div> 	
		</div>
		<div class="d-flex justify-content-center mt-4">
		    <button type="submit" class="station-richmenu-main-btn-area mr-2">
		      <i class="fa fa-check mr-1 fs-17" aria-hidden="true"></i>Hoàn tất
		    </button>
		    <a href="{{ url('') }}" class="station-richmenu-main-btn-area red_button">
		      <i class="fa fa-times mr-1 fs-17" aria-hidden="true"></i>Thoát
		    </a>
		</div>
	</form>
</div>