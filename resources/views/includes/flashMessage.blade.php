@if ($message = Session::get('success'))
    <div class="flash-message-success" data-flashmessage="{{ $message }}">

    </div>
@endif