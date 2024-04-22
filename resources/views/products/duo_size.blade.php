<div class="d-flex align-items-center">
    <div class="size_item_pro_structure">
        <p class="text-center color_gray">1</p>
        <div class="d-flex justify-content-between align-items-center">
            <input type="number" name = 'product[{{ $pro_index }}][length]' 
            placeholder="Dài" class="form-control short_input text-center __size_suggest_input __length_input" step="any"
            value="{{ @$product['length'] }}">
        </div>
        <p class="text-center color_gray"><i class="fa fa-arrows-h fs-18" aria-hidden="true"></i></p>
    </div>
    <span class="mx-3">X</span>
    <div class="size_item_pro_structure">
        <p class="text-center color_gray">2</p>
        <div class="d-flex justify-content-between align-items-center height_input">
            <input type="number" name = 'product[{{ $pro_index }}][height]' 
            placeholder="Cao" class="form-control short_input text-center __size_suggest_input __height_input" step="any"
            value="{{ @$product['height'] }}">
            <p class="text-center ml-1 color_gray"><i class="fa fa-arrows-v fs-18" aria-hidden="true"></i></p>
            <p class="text-center ml-1 color_gray">cm</p>
        </div>
    </div>
</div>