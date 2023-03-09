@php
    $stageName = \App\Constants\OrderConstant::STAGE_PROCESS;
@endphp
@foreach ($listProcess as $process)
<div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
    <label class="mb-0 mr-3 w_150 fs-13 text-capitalize">{{ @$stageName[$process] }}</label>
    @include('orders.products.process_ajax.'.$process)
</div>
@endforeach














