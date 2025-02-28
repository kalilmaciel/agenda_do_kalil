@if (session('error'))
    <script>
        $(document).ready(function() {
            Aviso.fire({
                icon: "error",
                title: "{{ session('error') }}",
            });
        });
    </script>
@endif

@if (session('success'))
    <script>
        $(document).ready(function() {
            Aviso.fire({
                icon: "success",
                title: "{{ session('success') }}",
            });
        });
    </script>
@endif

@foreach ($errors->all() as $e)
    <script>
        $(document).ready(function() {
            Aviso.fire({
                icon: "error",
                title: "{{ $e }}",
            });
        });
    </script>
@endforeach

