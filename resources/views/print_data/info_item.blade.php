<div class="col-4 mb-2 pb-2 border_bot_eb">
    <p class="d-flex align-items-start">
        <span class="d-block w_max_content text-nowrap"><i class="fa fa-circle mr-1 fs-14 color_yellow" aria-hidden="true"></i>{{ $name }}</span>
        <span class="ml-1 text-lowercase">: {{ $info }}</span>
    </p>
    @if (!empty($note))
        <p class="d-flex align-items-start">
            <span class="d-block w_max_content text-nowrap"><i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>Ghi chú</span> 
            <span class="ml-1 text-lowercase font-weight-normal font-italic">: {{ $note }}</span>
        </p> 
    @endif   
</div>   