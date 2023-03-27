<div class="d-flex align-items-center mb-2 fs-13 size_param_module">
    <label class="mb-0 min_180 text-capitalize text-right mr-3">
        <span class="fs-15 mr-1">*</span>Kích thước chiều 1
    </label>
    <div class="d-flex justify-content-between align-items-center">
        <input type="number" name = 'product[{{ $j }}][{{ $supp_key }}][{{ $pindex }}][size][length][param]' placeholder="Chiều 1 (cm)" 
        class="form-control medium_input" step="any"> 
        <span class="mx-3">X</span>
        <input type="number" name = 'product[{{ $j }}][{{ $supp_key }}][{{ $pindex }}][size][length][nqty]' placeholder="Số bát cần" 
        class="form-control medium_input" step="any">
        <span class="mx-2">=</span> 
        <input type="number" name = 'product[{{ $j }}][{{ $supp_key }}][{{ $pindex }}][size][length][ex_param]' placeholder="KT chiều 1" 
        class="form-control medium_input" step="any" readonly>
        <span class="mx-2">+ 1.2cm +</span>
        <input type="number" name = 'product[{{ $j }}][{{ $supp_key }}][{{ $pindex }}][size][length][margin]' placeholder="Thừa lề" 
        class="form-control medium_input" step="any"> 
        <span class="ml-2 color_red font-italic">Khớp chiều {{ $with_size1 }}cm</span>
    </div>
</div>

<div class="d-flex align-items-center mb-2 fs-13 size_param_module">
    <label class="mb-0 min_180 text-capitalize text-right mr-3">
        <span class="fs-15 mr-1">*</span>Kích thước chiều 2
    </label>
    <div class="d-flex justify-content-between align-items-center">
        <input type="number" name = 'product[{{ $j }}][{{ $supp_key }}][{{ $pindex }}][size][width][param]' placeholder="KT Chiều 2 (cm)" 
        class="form-control medium_input" step="any"> 
        <span class="mx-3">X</span>
        <input type="number" name = 'product[{{ $j }}][{{ $supp_key }}][{{ $pindex }}][size][width][nqty]' placeholder="Số bát cần" 
        class="form-control medium_input" step="any">
        <span class="mx-2">=</span> 
        <input type="number" name = 'product[{{ $j }}][{{ $supp_key }}][{{ $pindex }}][size][width][ex_param]' placeholder="KT chiều 2" 
        class="form-control medium_input" step="any" readonly>
        <span class="mx-2">+ 1.2cm +</span>
        <input type="number" name = 'product[{{ $j }}][{{ $supp_key }}][{{ $pindex }}][size][length][margin]' placeholder="Thừa lề" 
        class="form-control medium_input" step="any"> 
        <span class="ml-2 color_red font-italic">Khớp chiều {{ $with_size2 }}cm</span>
    </div>
</div>