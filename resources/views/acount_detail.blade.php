@extends('index')
@section('content')
    <div class=" row">
        <div class="col-6">
            <img src="{{ url('frontend/workers/images/auth_img.png') }}" alt="" class="w-100 mt-lg-4 mt-3">
        </div>
        <div class="col-6">
            <div class="mb-4 pb-4 border_bot_eb">
                <h3 class="fs-15 text-uppercase my-lg-4 my-3 text-center handle_title color_green mx-auto">
                    Cập nhật thông tin
                </h3>
                <form action="{{ url('account-detail') }}" method="POST" class="baseAjaxForm">
                    @csrf
                    @php
                        $arr_field = [
                            [
                                'name' => 'name',
                                'note' => 'Tên',
                                'attr' => ['disable_field' => 1],
                                'value' => @$profile['name']
                            ],
                            [
                                'name' => 'group_user',
                                'note' => 'Bộ phận',
                                'type' => 'linking',
                                'other_data' => ['data' => ['table' => 'n_group_users']],
                                'attr' => ['disable_field' => 1],
                                'value' => @$profile['group_user']
                            ],
                            
                            [
                                'name' => 'phone',
                                'attr' => ['disable_field' => 1],
                                'note' => 'SĐT',
                                'value' => $profile['phone']
                            ],
                            [
                                'name' => 'email',
                                'note' => 'Email',
                                'value' => @$profile['email']
                            ]
                        ]
                    @endphp 
                    @foreach ($arr_field as $field)
                        @include('view_update.view', $field)  
                    @endforeach
                    <div class="mt-lg-4 mt-3 text-right">
                        <button type="submit" disabled class="radius_5 box_shadow_3 main_button smooth mr-2 font_bold text-center bg_green color_white">
                            <i class="fa fa-check fs-14 mr-1" aria-hidden="true"></i> Hoàn tất
                        </button>  
                    </div>
                </form>
            </div>
            <div class="mb-4 pb-4 border_bot_eb">
                <h3 class="fs-15 text-uppercase my-lg-4 my-3 text-center handle_title color_green mx-auto">
                    Thay đổi mật khẩu
                </h3>
                 @include('change_password_base_form')
            </div>
        </div>
    </div>  
@endsection