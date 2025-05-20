document.addEventListener('DOMContentLoaded', function () {
    const body = document.body;
    const logo = document.getElementById('logo');
    const darkTitle = document.getElementById('dark-title');
    const toggleBtn = document.getElementById('toggle-theme');
    const icon = document.getElementById('theme-icon');

    function updateHeader() {
        if (body.classList.contains('dark-mode')) {
            logo.src = "/logo-white.png"; // ✅ white logo for dark mode
            // darkTitle.classList.remove('d-none');
            icon.classList.remove('fa-moon');
            icon.classList.add('fa-sun');
            icon.style.color = '#FFD700'; // golden sun
        } else {
            logo.src = "/logo.png";
            // darkTitle.classList.add('d-none');
            icon.classList.remove('fa-sun');
            icon.classList.add('fa-moon');
            icon.style.color = 'black'; // black moon
        }
    }

    if (localStorage.getItem('theme') === 'dark') {
        body.classList.add('dark-mode');
    }

    updateHeader();

    toggleBtn.addEventListener('click', function () {
        body.classList.toggle('dark-mode');
        localStorage.setItem('theme', body.classList.contains('dark-mode') ? 'dark' : 'light');
        updateHeader();
    });
});
