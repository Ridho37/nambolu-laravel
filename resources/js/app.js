// Import Flowbite agar bisa digunakan
import 'flowbite';

// Script Intersection Observer untuk Navigasi Aktif
document.addEventListener('DOMContentLoaded', function () {
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('#main-nav a.nav-link');

    if (!sections.length || !navLinks.length) return;

    const removeAllActiveClasses = () => {
        navLinks.forEach(link => {
            link.classList.remove('text-rose-600', 'font-bold');
        });
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const sectionId = entry.target.id;
                removeAllActiveClasses();
                const activeLink = document.querySelector(`#main-nav a[data-target-id="${sectionId}"]`);
                if (activeLink) {
                    activeLink.classList.add('text-rose-600', 'font-bold');
                }
            }
        });
    }, {
        threshold: 0.5
    });

    sections.forEach(section => {
        observer.observe(section);
    });
});