<div class="cogfig_print_command bg_eb mb-4">
    <h3 class="color_main font_inter font_bold fs-15 text-uppercase justify-content-center 
    mb-4 d-flex align-items-center command_title">
        Cấu hình lệnh in
    </h3>
    <div class="p-3 config_detail">
        <div class="row command_config_detail">
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">SL cần lấy</label>
                <input type="number" class="form-control print_req_qty_field" name="c_print[0]['req_qty']" value="0" min="0">
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">SL bù hao</label>
                <input type="number" class="form-control print_commpen_qty_field" name="c_print[0]['compen_qty']" value="0" min="0">
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Tổng số cho bài in</label>
                <input type="number" class="form-control disable_field print_amount_qty_field" name="c_print[0]['amount_qty']" value="" min="0">
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Định lượng giấy</label>
                <input type="number" class="form-control" name="c_print[0]['quantative']" value="" min="0">
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Loại giấy</label>
                <select name="c_print[0]['num_face']" class="form-control">
                    <option value="0">Chọn loại giấy</option>
                    <option value="1">C</option>
                    <option value="1">OF</option>
                    <option value="1">DUPLEX</option>
                    <option value="1">IVOLY</option>
                    <option value="1">CACBON</option>
                    <option value="1">Bãi Bằng</option>
                    <option value="1">DECAN</option>
                    <option value="1">Giấy ngoại</option>
                    <option value="1">Bạt hiplex</option>
                </select>
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4 align-items-center">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Khổ giấy in</label>
                <input type="number" class="form-control" name="c_print[0]['length']" value="" placeholder="Dài" min="0">
                <span class="mx-2">X</span>
                <input type="number" class="form-control" name="c_print[0]['width']" value="" placeholder="Rộng" min="0">
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Quy cách in</label>
                <select name="c_print[0]['style']" class="form-control">
                    <option value="0">Chọn quy cách in</option>
                    <option value="1">In 1 mặt</option>
                    <option value="2">Nó trở nó</option>
                    <option value="3">Nó trở khác</option>
                    <option value="4">Nó trở lật</option>
                </select>
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Ngày đặt in</label>
                <input type="text" name="c_print[0]['order_expired']" value="" 
                class="form-control max_w_200 inputDatePicker">
            </div>
            <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">Ngày hoàn thành</label>
                <input type="text" name="c_print[0]['expired']" value="" 
                class="form-control max_w_200 inputDatePicker">
            </div>
            <div class="form-group d-flex border_bot_eb col-12">
                <label class="mb-0 mr-3 w_125 fs-13 text-capitalize align-items-start">Ghi chú</label>
                <textarea class="form-control" name="c_print[0]['note']"></textarea>
            </div>
        </div>
    </div>
</div>