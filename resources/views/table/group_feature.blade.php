<div class="d-flex align-center justify-content-end my-3">
    <button type="submit"
        class="main_button bg_main color_white smooth bg_green border_green radius_5 font_bold smooth mr-2"
        form="form-search" value="submit">
        <i class="fa fa-filter mr-2 fs-15" aria-hidden="true"></i>Tìm kiếm
    </button>
    @if (@$tableItem['export'] == 1)
        <button data-table = {{ @$tableItem['name'] }}
            class="main_button bg_main color_white smooth bg_green border_green radius_5 font_bold smooth mr-2 __base_export_btn">
            <i class="fa fa-file-excel-o mr-2 fs-15" aria-hidden="true"></i>Export Excel
        </button>
    @endif
    @if (@$tableItem['import'] == 1)
        <div class="__import_excel_module possition-relative">
            <input type="file" name="file" class="__import_table_input d-none" data-table = {{ @$tableItem['name'] }}>
            <button class="main_button bg_main color_white smooth bg_green border_green radius_5 font_bold smooth mr-2 __import_button_btn">
                <i class="fa fa-upload mr-2 fs-15" aria-hidden="true"></i>Import Excel
            </button>
        </div>
    @endif
    @if (@$tableItem['insert'] == 1)
        @php
            $insert_url = url('insert/' . @$tableItem['name'].''.@$param_action)
        @endphp
        @if (hasNoSidebarParam())
            <button type="button" data-src = "{{ !empty($param_action) ? $insert_url.'&nosidebar=1' : $insert_url.'?nosidebar=1' }}" 
            class="btn btn-primary main_button bg_main color_white smooth bg_green border_green radius_5 font_bold smooth ml-2 load_view_popup mr-2" 
            data-toggle="modal" data-target="#actionModal">
                <i class="fa fa-plus mr-2 fs-15" aria-hidden="true"></i>Thêm mới
            </button>   
        @else
        <a href="{{ $insert_url }}"
            class="main_button bg_main color_white smooth bg_green border_green radius_5 font_bold smooth mr-2">
            <i class="fa fa-plus mr-2 fs-15" aria-hidden="true"></i>Thêm mới
        </a>
        @endif
    @endif
    @if (@$tableItem['remove'])
        <button class="main_button bg_red color_white smooth radius_5 font_bold smooth red_btn d-lg-block d-none" data-toggle="modal"
            data-target="#multiDeleteModal">
            <i class="fa fa-trash mr-2 fs-15" aria-hidden="true"></i>Xóa
        </button>
    @endif
    <button type="button" data-src = "{{ url('view/n_log_actions?default_data=%7B"table_map"%3A"'.@$tableItem['name'].'"%7D&nosidebar=1') }}" 
    class="btn btn-primary main_button bg_main color_white smooth bg_green border_green radius_5 font_bold smooth ml-2 load_view_popup" 
    data-toggle="modal" data-target="#actionModal">
        <i class="fa fa-history mr-2 fs-15" aria-hidden="true"></i>Lịch sử
    </button>
    @if (!empty(@$tableItem['ext_fucn']))
        @php
            $arr_action_btns = json_decode(@$tableItem['ext_fucn'], true);
        @endphp
        @foreach ($arr_action_btns as $action_btn)
            <button type="button" data-src = "{{ url($action_btn['link']) }}" data-size="{{ @$action_btn['size_popup']  }}"
            class="btn btn-primary main_button bg_main color_white smooth bg_green border_green radius_5 font_bold smooth ml-2 load_view_popup" 
            data-toggle="modal" data-target="#actionModal">
                <i class="fa fa-{{ $action_btn['icon'] }} mr-2 fs-15" aria-hidden="true"></i>{{ $action_btn['note'] }}
            </button>  
        @endforeach
    @endif
    <a href="javascript:void(0)" class="main_button bg_main color_white smooth bg_green border_green radius_5 font_bold smooth ml-2 d-lg-block d-none">
        <i class="fa fa-book mr-2 fs-15" aria-hidden="true"></i>Trợ giúp
    </a>
</div>