<header class="header d-flex justify-content-between align-items-center bg_white">
    <div class="header_logo">
        <a href="{{ url('') }}" class="header_logo d-inline-block py-1">
            <img src="{{ asset('frontend/admin/images/logo.png') }}" />
        </a>
    </div>
    <div class="d-flex justify-content-end">
        @if (isHome())
            <div class="header_menu_user d-flex align-items-center position-relative cursor_pointer mr-3 pr-3 border_right_green color_green">
                <div class="user_name __noftify_bell_icon mr-1 font_bold position-relative">
                    <p class="__noftify_count notify_style">{{ $noftify_count }}</p>
                    <i class="fa fa-bell fs-40 __bell_icon {{ $noftify_count > 0 ? 'tada_animate' : '' }}" aria-hidden="true"></i>
                </div>
                <ul class="header_menu_user_list" style="display:none">
                    <li>
                        <a href="{{ asset('account-detail') }}">Profile</a>
                    </li>
                    <li>
                        <a href="{{ asset('logout') }}">Đăng xuất</a>
                    </li>
                </ul>
            </div>
        @endif
        <div class="header_menu_user d-flex align-items-center position-relative cursor_pointer">
            <p class="user_name mr-1 font_bold">
                <span class="mr-1">{{ $user_login['user']['name'] }}</span>
                <i class="fa fa-angle-down fs-14" aria-hidden="true"></i>
            </p>
            <ul class="header_menu_user_list" style="display:none">
                <li>
                    <a href="{{ asset('account-detail') }}">Profile</a>
                </li>
                <li>
                    <a href="{{ asset('logout') }}">Đăng xuất</a>
                </li>
            </ul>
            <span class="header_menu_user_avatar">
                <img src="{{ asset('frontend/admin/images/avatar.png') }}" />
            </span>
        </div>
    </div>
</header>
