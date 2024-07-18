@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            $('document').ready(() => showToast('success', "{{ session('success') }}"));
        })
    </script>
@endif

@if (session('error'))
    <script>
        showToast('error', "{{ session('error') }}")
    </script>
@endif
