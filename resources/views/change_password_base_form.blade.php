<form action="{{ @$action_url ?? url('change-password') }}" method="POST" class="baseAjaxForm">
    @csrf
    @php
        $arr_field = [
            [
                'name' => 'old_pass',
                'note' => 'Mật khẩu cũ',
                'attr' => ['type_input' => 'password']
            ],
            [
                'name' => 'new_pass',
                'note' => 'Mật khẩu mới',
                'attr' => ['type_input' => 'password']
            ],
            [
                'name' => 'confirm_pass',
                'note' => 'Xác nhận mật hẩu mới',
                'attr' => ['type_input' => 'password']
            ],
        ]
    @endphp 
    @foreach ($arr_field as $field)
        @include('view_update.view', $field)  
    @endforeach
    <div class="mt-lg-4 mt-3 text-right">
        <button type="submit" class="radius_5 box_shadow_3 main_button smooth mr-2 font_bold text-center bg_green color_white">
            <i class="fa fa-check fs-14 mr-1" aria-hidden="true"></i> Hoàn tất
        </button>  
        <a href="{{ url('/Worker') }}" class="radius_5 box_shadow_3 main_button smooth font_bold text-center bg_red color_white">
            <i class="fa fa-check fs-14 mr-1" aria-hidden="true"></i> Hủy
        </a> 
    </div>
</form>