<header class="header">
  <div class="header-logo">
    <a href="{{url('')}}" class="header-logo_lnk d-inline-block py-2">
      <img src="{{ asset('frontend/admin/images/logo.jpg') }}" />
    </a>
  </div>
  <div class="header-menu">
    <div class="header-menu-user">
      <p class="header-menu-user__name">{{ $user_login['user']['name'] }}<img src="{{ asset('frontend/admin/images/arow-donw.png') }}" /></p>
      <ul class="header-menu-user-all">
        <li class="header-menu-user__list">
          <a href="{{ asset('profile') }}" class="header-menu-user__lnk">Profile</a>
        </li>
        <li class="header-menu-user__list">
          <a href="{{ asset('logout') }}" class="header-menu-user__lnk">Đăng xuất</a>
        </li>
      </ul>
      <span class="header-menu-user__avatar">
        <img src="{{ asset('frontend/admin/images/avatar.jpg') }}" />
      </span>
    </div>
  </div>
</header>