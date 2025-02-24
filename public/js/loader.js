document.addEventListener('DOMContentLoaded', function() {
    const loader = document.querySelector('.page-loader');
    
    // Tampilkan loader saat akan berpindah halaman
    document.addEventListener('click', function(e) {
        const link = e.target.closest('a');
        if (link && !link.hasAttribute('data-no-loader') && !e.ctrlKey && !e.shiftKey && !e.metaKey && !e.altKey) {
            loader.classList.add('active');
        }
    });

    // Tampilkan loader saat form submit
    document.addEventListener('submit', function(e) {
        const form = e.target;
        if (!form.hasAttribute('data-no-loader')) {
            loader.classList.add('active');
        }
    });

    // Sembunyikan loader saat halaman selesai dimuat
    window.addEventListener('load', function() {
        loader.classList.remove('active');
    });

    // Sembunyikan loader saat navigasi dibatalkan
    window.addEventListener('pageshow', function(e) {
        if (e.persisted) {
            loader.classList.remove('active');
        }
    });
}); 