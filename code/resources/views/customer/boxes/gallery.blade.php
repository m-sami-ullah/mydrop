<div class="row g-2">
    @foreach ($gallery as $image)
    <div class="col-sm-4">
      <img src="{{ $image->url() }}" width="100%">
    </div>
    @endforeach
  </div>