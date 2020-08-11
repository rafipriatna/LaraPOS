@if ($message = Session::get('success'))
    <div class="flash-message-success" data-flashmessage="{{ $message }}">

    </div>
@endif

@if ($message = Session::get('fail'))
    <div class="flash-message-fail" data-flashmessage="{{ $message }}">

    </div>
@endif