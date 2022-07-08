<ul class="nav nav-tabs q_tab_action" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id=" general-info-tab" data-toggle="tab" href="#general-info" role="tab" aria-controls="general-info" aria-selected="true">Thông tin chung</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="detail-config-tab" data-toggle="tab" href="#detail-config" role="tab" aria-controls="detail-config" aria-selected="true">Vật tư & sản xuất</a>
  </li>
</ul>
<div class="tab-content px-3 py-4 bg_white content_form" id="myTabContent">
  <div class="tab-pane fade show active" id="general-info" role="tabpanel" aria-labelledby="general-info-tab">
    @include('quotes.q_papers.general', ['some' => 'data'])
  </div>
  <div class="tab-pane fade" id="detail-config" role="tabpanel" aria-labelledby="detail-config-tab">
    @include('quotes.q_papers.configs')
  </div>
</div>