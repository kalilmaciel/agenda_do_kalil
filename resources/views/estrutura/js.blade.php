<script>
    const base_url = '{{ env('APP_URL') }}';
    const assets = '{{ asset('') }}';
    const _token = '{{ csrf_token() }}';
</script>
<script src="{{ asset('assets/js/libraries.js') }}"></script>
