<div class="modal fade show" id="worker-{{ $m_name }}-modal" tabindex="-1" role="dialog" aria-labelledby="worker-{{ $m_name }}-modal-title"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered {{ $m_name }}" role="document">
        @include('Worker::commands.'.$form)
    </div>
</div>
