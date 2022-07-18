<table class="table table-striped fs-17 mb-0 table_configs">
	<thead>
	    <tr>
		    <th scope="col" class="text-center color_red">Loại vật tư</th>
	    	<th scope="col" class="text-center color_red">STT</th>
		    <th scope="col" class="text-center color_red">SL</th>
		    <th scope="col" class="text-center color_red">Chi phí</th>
		    <th scope="col" class="text-center color_red">T.Tiền</th>
	    </tr>
	</thead>
  	<tbody class="fs-17 font-italic">
  		@if (count($listPapers)>0)
  			@foreach ($listPapers as $key =>$item)
  				<tr>
		    		<td data-label="Vật tư" class="text-center">Tờ bồi</td>
		    		<td data-label="STT" class="text-center">{{ $key+1 }}</td>
		    		<td data-label="SL" class="text-center">{{ $item['qty_pro'] }}</td>
			      	<td data-label="Phí SX" class="font-italic">
			      		<p class="d-flex align-items-center mb-1 font_bold">
			      			<span class="pro_name">{{ $item['name'] }}</span>
			      		</p>
			      		@php
			      			$data_paper = json_decode($item['paper_size']);
				            $data_print = json_decode($item['print']);
				            $data_skin = json_decode($item['skin']);
				            $data_metalai = json_decode($item['metalai']);
				            $data_compress = json_decode($item['compress']);
				            $data_uv = json_decode($item['uv']);
				            $data_elevate = json_decode($item['elevate']);
				            $data_peel = json_decode($item['peel']);
				            $data_design = json_decode($item['design_model']);
				            $data_plus = json_decode($item['plus']);
			      		@endphp
			      		@if (@$data_paper->act==1)
			      			<p class="mb-1">
				      			<span class="font_bold mr-1"><i class="fs-10 fa fa-circle mr-1" aria-hidden="true"></i> Vật tư: </span>
			      				<span class="font-italic">
				      				{{ number_format($data_paper->total) }} đ
				      			</span>										
				      		</p>
			      		@endif

			      		@if (@$data_print->act==1)
			      			<p class="mb-1">
				      			<span class="font_bold mr-1"><i class="fs-10 fa fa-circle mr-1" aria-hidden="true"></i> In offset: </span>
			      				<span class="font-italic">
				      				{{ number_format($data_print->total) }} đ
				      			</span>										
				      		</p>
			      		@endif

			      		@if (@$data_skin->act==1)
			      			<p class="mb-1">
				      			<span class="font_bold mr-1"><i class="fs-10 fa fa-circle mr-1" aria-hidden="true"></i> Cán láng: </span>
			      				<span class="font-italic">
				      				{{ number_format($data_skin->total) }} đ
				      			</span>										
				      		</p>
			      		@endif

			      		@if (@$data_metalai->act==1)
			      			<p class="mb-1">
				      			<span class="font_bold mr-1"><i class="fs-10 fa fa-circle mr-1" aria-hidden="true"></i> Cán metalai: </span>
			      				<span class="font-italic">
				      				{{ number_format($data_metalai->total) }} đ
				      			</span>										
				      		</p>
			      		@endif

			      		@if (@$data_compress->act==1)
			      			<p class="mb-1">
				      			<span class="font_bold mr-1"><i class="fs-10 fa fa-circle mr-1" aria-hidden="true"></i> Ép nhũ: </span>
			      				<span class="font-italic">
				      				{{ number_format($data_compress->total) }} đ
				      			</span>										
				      		</p>
			      		@endif

			      		@if (@$data_uv->act==1)
			      			<p class="mb-1">
				      			<span class="font_bold mr-1"><i class="fs-10 fa fa-circle mr-1" aria-hidden="true"></i> In UV: </span>
			      				<span class="font-italic">
				      				{{ number_format($data_uv->total) }} đ
				      			</span>										
				      		</p>
			      		@endif

			      		@if (@$data_elevate->act==1)
			      			<p class="mb-1">
				      			<span class="font_bold mr-1"><i class="fs-10 fa fa-circle mr-1" aria-hidden="true"></i> Máy bế: </span>
			      				<span class="font-italic">
				      				{{ number_format($data_elevate->total) }} đ
				      			</span>										
				      		</p>
			      		@endif

			      		@if (@$data_peel->act==1)
			      			<p class="mb-1">
				      			<span class="font_bold mr-1"><i class="fs-10 fa fa-circle mr-1" aria-hidden="true"></i> Bóc lề: </span>
			      				<span class="font-italic">
				      				{{ number_format($data_peel->total) }} đ
				      			</span>										
				      		</p>
			      		@endif

			      		@if (@$data_design->act==1)
				      		<p class="mb-1">
				      			<span class="font_bold mr-1"><i class="fs-10 fa fa-circle mr-1" aria-hidden="true"></i> Chi phí TK: </span>
			      				<span class="font-italic">
				      				{{ number_format((int)@$data_design->total) }} đ
				      			</span>										
				      		</p>
			      		@endif

			      		@if (@$data_plus->act==1)
			      			<p class="mb-1">
				      			<span class="font_bold mr-1"><i class="fs-10 fa fa-circle mr-1" aria-hidden="true"></i> Chi phí phát sinh: </span>
			      				<span class="font-italic">
				      				{{ number_format((int)@$data_plus->total) }}
				      			</span>										
				      		</p>
			      		@endif
			      	</td>
			      	<td data-label="T.Tiền(VNĐ)" class="text-center">{{ number_format((int)$item['total_cost']) }} đ</td>
			    </tr>
  			@endforeach
  		@endif

  		@if ($data_quotes['group_product']== \App\Constants\NameConstant::HARDBOX)
  			@include('quotes.profits.hardbox_supplies')
  		@endif
  	</tbody>
</table>