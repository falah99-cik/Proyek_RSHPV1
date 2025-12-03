<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"></script>

<script src="{{ asset('assets/adminlte/js/adminlte.min.js') }}"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const sb = document.querySelector('.sidebar-wrapper');
    if (sb) {
        OverlayScrollbarsGlobal.OverlayScrollbars(sb, {
            scrollbars: {
                autoHide: 'leave'
            }
        });
    }
});
</script>
