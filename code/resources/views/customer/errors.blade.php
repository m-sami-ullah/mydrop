@if(session('message'))
    <div class="post-alert alert alert-success">{{ session('message') }}</div>
@endif
@if(session('error'))
    <div class="post-alert alert alert-danger">{{ session('error') }}</div>
@endif