document.addEventListener('DOMContentLoaded', function() {
    const loader = document.querySelector('.page-loader');
    
    // Tampilkan loader saat akan berpindah halaman
    document.addEventListener('click', function(e) {
        const link = e.target.closest('a');
        
        // Cek apakah link valid dan bukan dropdown toggle atau menu item
        if (link && 
            !link.hasAttribute('data-no-loader') && 
            !link.classList.contains('dropdown-toggle') &&
            !link.classList.contains('dropdown-item') &&
            !link.hasAttribute('data-bs-toggle') &&
            !e.ctrlKey && !e.shiftKey && !e.metaKey && !e.altKey) {
            
            // Cek apakah link mengarah ke halaman yang sama
            const isSamePageLink = link.getAttribute('href') === '#' || 
                                 link.getAttribute('href') === '' ||
                                 link.getAttribute('href') === window.location.href;
            
            if (!isSamePageLink) {
                loader.classList.add('active');
            }
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

    // Tambahkan event listener untuk dropdown menu
    const dropdownMenus = document.querySelectorAll('.dropdown-menu');
    dropdownMenus.forEach(menu => {
        menu.addEventListener('click', function(e) {
            // Hentikan event bubbling untuk mencegah loader muncul
            e.stopPropagation();
        });
    });
}); 