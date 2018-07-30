<div class="row">
    @php
        $messages = Session::get('flash_frontend_messages', []) 
    @endphp

    @foreach ($messages as $message)
        <div class="alert alert-{{ $message['type'] }} alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4>{{ $message['title'] }}</h4>
            <p>{{ $message['message'] }}</p>
        </div>
    @endforeach
</div>
