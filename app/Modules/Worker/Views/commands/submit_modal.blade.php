<div class="modal fade" id="worker-{{ $m_name }}-modal" tabindex="-1" role="dialog" aria-labelledby="worker-{{ $m_name }}-modal-title"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        @include('Worker::commands.'.$form)
    </div>
</div>
