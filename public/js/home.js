// Trip type selection
const tripTypes = document.querySelectorAll('.trip-type');
tripTypes.forEach(type => {
    type.addEventListener('click', () => {
        tripTypes.forEach(t => t.classList.remove('active'));
        type.classList.add('active');
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const airplane = document.querySelector('.airplane-3d');
    const clouds = document.querySelectorAll('.cloud');
    let isFlying = false;
    let lastScrollY = window.scrollY;
    let scrollTimeout;

    // Initial animation
    airplane.style.animation = 'initialFlight 2s cubic-bezier(0.23, 1, 0.32, 1)';
    
    // Scroll animation
    window.addEventListener('scroll', () => {
        const currentScroll = window.scrollY;
        
        // Mulai animasi saat scroll minimal 10px
        if (currentScroll > 10 && !isFlying) {
            isFlying = true;
            
            // Animasi pesawat ke kanan
            airplane.style.transform = `
                translate(-50%, -50%)
                rotate3d(0, 1, 0, 10deg)
                translate3d(200px, 0, 100px)
            `;

            // Animasi awan ke kiri
            clouds.forEach((cloud, index) => {
                const delay = index * 100;
                setTimeout(() => {
                    cloud.style.transform = 'translateX(-100px)';
                    cloud.style.opacity = '0.6';
                }, delay);
            });
        }
        
        // Reset posisi saat scroll kembali ke atas
        if (currentScroll <= 10) {
            isFlying = false;
            
            airplane.style.transform = 'translate(-50%, -50%) rotate3d(0, 0, 0, 0deg)';
            
            clouds.forEach(cloud => {
                cloud.style.transform = 'translateX(0)';
                cloud.style.opacity = '1';
            });
        }
    });

    // Mouse move effect
    document.addEventListener('mousemove', (e) => {
        if (!isFlying) {
            const { clientX, clientY } = e;
            const { innerWidth, innerHeight } = window;
            
            const rotateX = ((clientY / innerHeight) - 0.5) * 30;
            const rotateY = ((clientX / innerWidth) - 0.5) * 30;
            const translateZ = Math.abs(rotateX + rotateY) * 2;

            airplane.style.transform = `
                translate(-50%, -50%)
                rotateX(${-rotateX}deg)
                rotateY(${rotateY}deg)
                translateZ(${translateZ}px)
            `;
        }
    });

    // Reset transform on mouse leave
    document.addEventListener('mouseleave', () => {
        if (!isFlying) {
            airplane.style.transform = 'translate(-50%, -50%) rotate3d(0, 0, 0, 0deg)';
        }
    });
});

// Swap functionality
document.querySelector('.swap-icon').addEventListener('click', function() {
    const fromSelect = document.getElementById('from');
    const toSelect = document.getElementById('to');
    const tempValue = fromSelect.value;
    fromSelect.value = toSelect.value;
    toSelect.value = tempValue;
});

// Deals Swiper initialization
document.addEventListener('DOMContentLoaded', function() {
    var dealsSwiper = new Swiper(".dealsSwiper", {
        slidesPerView: 1,
        spaceBetween: 20,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
            },
            768: {
                slidesPerView: 3,
            },
            1024: {
                slidesPerView: 4,
            },
        },
    });
}); 

