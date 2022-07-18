@if (count($listCatons)>0)
	@foreach ($listCatons as $key =>$item)
		<tr>
		<td data-label="Vật tư" class="text-center">Cartons</td>
		<td data-label="STT" class="text-center">{{ $key+1 }}</td>
		<td data-label="SL" class="text-center">{{ (int)@$item['qty_pro'] }}</td>
      	<td data-label="Phí SX" class="font-italic">
      		<p class="d-flex align-items-center mb-1 font_bold">
      			<span class="pro_name">Loại vật tư: {{ getNameTableById('QSupply', @$item['name']) }}</span>
      		</p>
      		<p class="d-flex align-items-center mb-1 font_bold">
      		@php
      			$data_paper = json_decode($item['paper_size']);
	            $data_elevate = json_decode($item['elevate']);
	            $data_peel = json_decode($item['peel']);
	            $data_milling = json_decode($item['milling']);
      		@endphp
      			<span class="pro_name">Định lượng: {{ getNameTableById('QSupplyPrice', @$data_paper->quantative) }}</span>
      		</p>

      		@if (@$data_paper->act==1)
      			<p class="mb-1">
	      			<span class="font_bold mr-1"><i class="fs-10 fa fa-circle mr-1" aria-hidden="true"></i> Vật tư: </span>
      				<span class="font-italic">
	      				{{ number_format($data_paper->total) }} đ
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

      		@if (@$data_milling->act==1)
      			<p class="mb-1">
	      			<span class="font_bold mr-1"><i class="fs-10 fa fa-circle mr-1" aria-hidden="true"></i> Máy phay: </span>
      				<span class="font-italic">
	      				{{ number_format($data_milling->total) }} đ
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

      	</td>
      	<td data-label="T.Tiền(VNĐ)" class="text-center">{{ number_format((int)$item['total_cost']) }} đ</td>
   </tr>
	@endforeach
@endif

@if (count($listFoams)>0)
	@foreach ($listFoams as $key =>$item)
		<tr>
		<td data-label="Vật tư" class="text-center">Mút Xốp định hình</td>
		<td data-label="STT" class="text-center">{{ $key+1 }}</td>
		<td data-label="SL" class="text-center">{{ (int)@$item['qty_pro'] }}</td>
      	<td data-label="Phí SX" class="font-italic">
      		<p class="d-flex align-items-center mb-1 font_bold">
      			<span class="pro_name">Loại vật tư: {{ getNameTableById('QSupply', @$item['name']) }}</span>
      		</p>
      		<p class="d-flex align-items-center mb-1 font_bold">
      		@php
      			$data_paper = json_decode($item['paper_size']);
	            $data_elevate = json_decode($item['elevate']);
	            $data_peel = json_decode($item['peel']);
      		@endphp
      			<span class="pro_name">Định lượng: {{ getNameTableById('QSupplyPrice', @$data_paper->quantative) }}</span>
      		</p>

      		@if (@$data_paper->act==1)
      			<p class="mb-1">
	      			<span class="font_bold mr-1"><i class="fs-10 fa fa-circle mr-1" aria-hidden="true"></i> Vật tư: </span>
      				<span class="font-italic">
	      				{{ number_format($data_paper->total) }} đ
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

      	</td>
      	<td data-label="T.Tiền(VNĐ)" class="text-center">{{ number_format((int)$item['total_cost']) }} đ</td>
   </tr>
	@endforeach
@endif

@if (count($listSilks)>0)
	@foreach ($listSilks as $key =>$item)
		<tr>
		<td data-label="Vật tư" class="text-center">Vật tư lụa</td>
		<td data-label="STT" class="text-center">{{ $key+1 }}</td>
		<td data-label="SL" class="text-center">{{ (int)@$item['qty_pro'] }}</td>
      	<td data-label="Phí SX" class="font-italic">
      		<p class="d-flex align-items-center mb-1 font_bold">
      			<span class="pro_name">Loại vật tư: {{ getNameTableById('QSupplyPrice', @$item['name']) }}</span>
      		</p>
      		@php
      			$data_paper = json_decode($item['paper_size']);
	            $data_hole_price = json_decode($item['hole_price']);
      		@endphp

      		@if (@$data_paper->act==1)
      			<p class="mb-1">
	      			<span class="font_bold mr-1"><i class="fs-10 fa fa-circle mr-1" aria-hidden="true"></i> Vật tư: </span>
      				<span class="font-italic">
	      				{{ number_format((int)$data_paper->total) }} đ
	      			</span>										
	      		</p>
      		@endif

      		@if (@$data_hole_price->act==1)
      			<p class="mb-1">
	      			<span class="font_bold mr-1"><i class="fs-10 fa fa-circle mr-1" aria-hidden="true"></i> Lỗ phủ lụa: </span>
      				<span class="font-italic">
	      				{{ number_format((int)$data_hole_price->total) }} đ
	      			</span>										
      			</p>
      		@endif
      	</td>
      <td data-label="T.Tiền(VNĐ)" class="text-center">{{ number_format((int)$item['total_cost']) }} đ</td>
   </tr>
	@endforeach
@endif

@if (count($listFinishes)>0)
	@foreach ($listFinishes as $key =>$item)
		<tr>
		<td data-label="Vật tư" class="text-center">Bồi hộp & hoàn thiện</td>
		<td data-label="STT" class="text-center">{{ $key+1 }}</td>
		<td data-label="SL" class="text-center">{{ (int)@$data_quotes['qty_pro'] }}</td>
      	<td data-label="Phí SX" class="font-italic">
      		@php
      			$fill_price = json_decode($item['fill_price']);
	            $finish_price = json_decode($item['finish_price']);
      		@endphp
      		@if (@$fill_price->act==1)
      			<p class="mb-1">
	      			<span class="font_bold mr-1"><i class="fs-10 fa fa-circle mr-1" aria-hidden="true"></i> Chi phí bồi hộp: </span>
      				<span class="font-italic">
	      				{{ number_format((int)$fill_price->total) }} đ
	      			</span>										
	      		</p>
      		@endif

      		@if (@$finish_price->act==1)
      			<p class="mb-1">
	      			<span class="font_bold mr-1"><i class="fs-10 fa fa-circle mr-1" aria-hidden="true"></i> Chi phí hoàn thiện: </span>
      				<span class="font-italic">
	      				{{ number_format((int)$finish_price->total) }} đ
	      			</span>										
	      		</p>
      		@endif
      	</td>
      	<td data-label="T.Tiền(VNĐ)" class="text-center">{{ number_format((int)$item['total_cost']) }} đ</td>
   </tr>
	@endforeach
@endif