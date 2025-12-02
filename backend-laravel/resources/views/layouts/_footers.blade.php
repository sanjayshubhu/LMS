<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>
    @if(session('success'))
        showToast("{{ session('success') }}", "success");
    @endif

    @if(session('error'))
        showToast("{{ session('error') }}", "error");
    @endif
</script>

</body>
</html>