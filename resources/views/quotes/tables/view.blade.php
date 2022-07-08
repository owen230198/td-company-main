@extends('index')
@section('content')
<form action="do-{{ $action }}-detail/{{ $tableItem['name'] }}/{{ $quote_id }}{{ @$dataitem['id']?'/'.$dataitem['id']:'' }}" method="POST" class="popupActionForm formActionS p-3 pb-5 possition-relative">
  @csrf
  <div class="modal-header mb-4 p-0 pb-2">
    <h3 class="modal-title fs-17 font_bold text-capitalize" id="exampleModalLongTitle">{{ @$title?$title:'' }}</h3>
  </div>
  @include('quotes.'.$tableItem['name'].'.view')
  <div class="group_btn_action_form popup">
    <button type="submit" class="station-richmenu-main-btn-area">
      <i class="fa fa-check mr-2 fs-18" aria-hidden="true"></i>Hoàn tất
    </button>
  </div>
</form>
@endsection

@section('script')
  <script src="{{ asset('frontend/admin/script/quote.js') }}" defer></script>
@endsection