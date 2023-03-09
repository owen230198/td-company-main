<div class="sidebar admin_sidebar">
  <ul class="sidebar_menu">
    <li>
      <a href="{{url('')}}">
        Trang chủ
      </a>
    </li>
    @foreach ($group_modules as $key_group => $group)
        <li>
          <a href="javascript:void(0)">
            {{ $group }}
          </a>
          <i class="fa fa-angle-right fs-14" aria-hidden="true"></i>
          <ul>
            @foreach ($modules as $module)
              @if(@$module['parent'] && $module['parent'] == $key_group)
                <li>
                  <a href="{{ asset($module['link']) }}">{{ $module['name'] }}</a>
                </li>
              @endif 
            @endforeach
          </ul>
        </li> 
    @endforeach
  </ul>
</div>