<!-- @if(count($errors))
    @foreach($errors->all() as $error)
        <div class="alert alert-danger"> {{ $error }} </div>
    @endforeach()
@endif -->
@if(session('message'))
<script type="text/javascript">
toastr.success("{{ session('message') }}", 'Success');
</script>
@endif
@if(session('error'))
<script type="text/javascript">
toastr.error("{{ session('error') }}", 'Error');
</script>
@endif