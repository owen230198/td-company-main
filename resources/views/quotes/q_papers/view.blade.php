@extends('index')
@section('content')
<div class="modal-header">
    <h2 class="modal-title fs-20 font_bold" id="exampleModalLongTitle">{{ @$title?$title:'' }}</h2>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="group_btn_action_form popup">
    <button type="submit" class="station-richmenu-main-btn-area">
      <i class="fa fa-check mr-2 fs-18" aria-hidden="true"></i>Hoàn tất
    </button>
    <button class="station-richmenu-main-btn-area btn-secondary" type="button" data-dismiss="modal">
      <i class="fa fa-times mr-2 fs-18" aria-hidden="true"></i>Hủy
    </button>
</div>
@endsection