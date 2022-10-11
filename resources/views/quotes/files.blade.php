@extends('index')
@section('content')
{!! getBreadcrumb('quotes', 0, 'File báo giá') !!}
	<div class="position-relative">
		<div class="dashborad_content bg_white">
		 	<div class="quote_model py-lg-5 py-4">
				<div class="header_quote pb-2 mb-lg-4 mb-3 quote_content">
					<div class="row jusify-content-center">
						<div class="col-4">
							<a class="quote_logo d-inline-block" href="system">
								<img src="frontend/admin/images/logo.png" class="w-100 mb-1">	
							</a>	
						</div>
						<div class="col-8">
							<div class="row">
								<div class="col-6 border_right_dashed">
									<h2 class="ml-2 headr_title fs-21 mb-2 color_red font_w_bold font-italic">Văn phòng giao dịch</h2>
									<p class="ml-2 fs-20 mb-1"><span class="font_w_bold color_red font-italic">A : </span>	{{ getDataConfigs('QConfig', 'OFFICE_ADD') }}</p>
									<p class="ml-2 fs-20 mb-1"><span class="font_w_bold color_red font-italic">T : </span>{{ getDataConfigs('QConfig', 'OFFICE_PHONE') }}</p>
									<p class="ml-2 fs-20 mb-1"><span class="font_w_bold color_red font-italic">H : </span>{{ getDataConfigs('QConfig', 'OFFICE_TEL') }}</p>
								</div>
								<div class="col-6">
									<h2 class="ml-2 headr_title fs-21 mb-2 color_red font_w_bold font-italic">Nhà máy sản xuất</h2>
									<p class="ml-2 fs-20 mb-1"><span class="font_w_bold color_red font-italic">A : </span></span>{{ getDataConfigs('QConfig', 'FACT_ADD') }}</p>
									<p class="ml-2 fs-20 mb-1"><span class="font_w_bold color_red font-italic">T : </span></span>{{ getDataConfigs('QConfig', 'FACT_PHONE') }}</p>
									<p class="ml-2 fs-20 mb-1"><span class="font_w_bold color_red font-italic">H : </span>{{ getDataConfigs('QConfig', 'FACT_TEL') }}</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="px-lg-5 position-relative quote_content">
					<div class="quote_bg_content">
						<h1 class="text-uppercase fs-39 font_w_bold text-center mb-3">bảng báo giá</h1>
						<p class="fs-17 ml-lg-5 ml-md-3 mb-1">Kính gửi : <span class="font-italic"><span class="company">{{ $data_quotes['company_name'] }}</span></span></p>
						<p class="fs-17 ml-lg-5 ml-md-3 mb-1">Người liên hệ : <span class="font-italic">{{ $data_quotes['contacter'] }}</span></p>
						<p class="fs-17 ml-lg-5 ml-md-3 mb-1">Địa chỉ : <span class="font-italic">{{ $data_quotes['address'] }}</span></p>
						<p class="fs-17 ml-lg-5 ml-md-3 mb-1">Tel : <span class="font-italic">{{ $data_quotes['phone'] }}</span></p>
						<p class="fs-17 ml-lg-5 ml-md-3 mb-1">Email : {{ $data_quotes['email'] }}</p>
						<p class="fs-21 text-center font-italic"></span>{!! getDataConfigs('QConfig', 'QUOTE_WISH') !!}</p>

						<div class="table_quote my-lg-4 my-3">
							<table class="table table-striped fs-15 mb-0 table_configs">
								<thead>
								    <tr>
									   <th scope="col" class="text-center color_red max_content">THÔNG SỐ SẢN PHẨM</th>
									   <th scope="col" class="text-center color_red">ĐVT</th>
									   <th scope="col" class="text-center color_red">SL</th>
									   <th scope="col" class="text-center color_red">ĐG</th>
									   <th scope="col" class="text-center color_red">TT</th>
								    </tr>
								</thead>
							  	<tbody class="fs-17 font-italic">
							    	<tr>
								      	<td data-label="Nội dung" class="font-italic quote_content_section max_content">
							      			<p class="d-flex align-items-center mb-1 font_w_bold">
								      			<span class="pro_name fs-15 text-uppercase">{{ @$data_tables['name'] }}</span>
								      		</p>
								      		<p class=" mb-1">
								      			<span class="font_w_bold mr-1"><i class="fs-10 fa fa-circle mr-1" aria-hidden="true"></i> Chất liệu giấy: </span>
								      			{{ @$data_quotes['paper_materal'] }}	
								      		</p>
								      		<p class=" mb-1">
								      			<span class="font_w_bold mr-1"><i class="fs-10 fa fa-circle mr-1" aria-hidden="true"></i> Kích thước: </span> 
								      			<span class="">
								      				{{ $data_quotes['size'] }} mm
								      			</span>	
								      		</p>
								      		<p class=" mb-1">
								      			<span class="font_w_bold mr-1"><i class="fs-10 fa fa-circle mr-1" aria-hidden="true"></i> Mẫu thiết kế do: </span>
								      			{{ @$data_tables['design_model']==2?'Khách hàng cung cấp':'BB Tuấn Dung cung cấp' }}	
								      		@php
								      			$print = json_decode(@$data_tables['print']);
								      			$skin = json_decode(@$data_tables['skin']);
								      			$pressed = json_decode(@$data_tables['pressed']);
								      			$uv = json_decode(@$data_tables['uv']);
								      			$elevate = json_decode(@$data_tables['elevate']);
								      		@endphp
								      		@if (@$print->act == 1)	
									      		<p class="d-flex align-items-center mb-1 font_w_bold">
									      			<span class="mr-1">
									      				<i class="fs-10 fa fa-circle mr-1" aria-hidden="true"></i> 
									      				In: In {{ @$print->device==1?'print':'uv' }} theo {{ @$data_quotes['print_model']==1?'file đã sản xuất':'file thiết kế mới' }}
									      			</span>	
									      		</p>
								      		@endif
								      		<p class=" mb-1">
								      			<span class="font_w_bold mr-1"><i class="fs-10 fa fa-circle mr-1" aria-hidden="true"></i> Hoàn thiện: </span>
								      			<span class="font-italic">
								      				@if (@$skin->act==1)
								      					{{ getNameTableById('QLaminateMateral', @$skin->materal).' '.$skin->num_face.' mặt ' }}
								      				@endif

								      				@if (@$pressed->act==1)
								      					+ ép nhũ theo maket
								      				@endif

								      				@if (@$uv->act==1)
								      					+ {{ getNameTableById('QDevice', @$uv->device) }} theo maket	
								      				@endif
									      			
									      			@if (@$elevate->float)
									      				+ Thúc nổi sản phẩm
									      			@endif	
								      			</span>
								      		</p>

								      		@if (@@$data_tables['note']!='')
								      			<p class="mb-1">
									      			<span class="font_w_bold mr-1"><i class="fs-10 fa fa-circle mr-1" aria-hidden="true"></i> Ghi chú: </span>
									      				<span class="font-italic">
										      				{{ @$data_tables['note'] }}
										      			</span>										
									      		</p>
								      		@endif
								      	</td>
								      	<td data-label="DVT" class="text-center">Sản phẩm</td>
								      	<td data-label="SL" class="text-center">{{ $data_quotes['qty_pro'] }}</td>
								      	@php
								      		$price = (int)$data_quotes['total_amount'];
								      		$e_price = @$data_quotes['qty_pro']?ceil($price/$data_quotes['qty_pro']):0; 
								      	@endphp
								      	<td data-label="ĐG" class="text-center">{{ number_format($e_price) }} đ</td>
								      	<td data-label="T.Tiền(VNĐ)" class="text-center">{{ number_format($price) }} đ</td>
								   	</tr>
							  	</tbody>
							</table>	
						    <div class="text-center p-2 border_grey">
						    	<p class="fs-23 color_red font_w_bold mb-1">TỔNG GIÁ : 	{{ number_format((int)$data_quotes['total_amount']) }} VNĐ</p>
						    	<p class="fs-15 font-italic">(Tổng cộng chưa VAT 10%)</p>
						    </div>
						</div>
						<div class="footer_quote fs-17 font-italic pb_375">
							<p class="d-flex align-items-center mb-1 font_w_bold font-italic">Ghi chú:</p>
							<div class="ml-md-3">
								</span>{!! getDataConfigs('QConfig', 'ATTENTION') !!}
							</div>
							@php
								$quote_admin = getDetailDataByID('NUser', $data_quotes['n_user_id'])
							@endphp
							<div class="text-right mt-3 font-italic">
								<p class="mb-0 font_w_bold">Người lập báo giá.</p>
								<p class="mb-0 font_w_bold">{{ @$quote_admin['name'] }}</p>
								<p class="mb-0 font_w_bold">{{ @$quote_admin['phone'] }}</p>		
							</div>
						</div>
						<img src="frontend/admin/images/footer_quote.jpg" class="footer_quote_img w-100">
					</div>
				</div>	
			</div>
			<div class="group_btn_action_form">
			    <button type="button" class="station-richmenu-main-btn-area print_quotes">
			      <i class="fa fa-download mr-2 fs-15" aria-hidden="true"></i>Xuất file
			    </button>
			    <a href="" class="station-richmenu-main-btn-area print_quotes">
			      <i class="fa fa-paper-plane mr-2 fs-15" aria-hidden="true"></i>Gửi báo giá
			    </a>
			    <a href="{{ url('') }}" class="station-richmenu-main-btn-area red_button">
			      <i class="fa fa-times mr-1 fs-17" aria-hidden="true"></i>Thoát
			    </a>
			</div>  
		</div>
	</div>
@endsection

@section('script')
	<script type="text/javascript" src="frontend/admin/script/quote.js"></script>
@endsection