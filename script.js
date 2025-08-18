
// Dark mode toggle
const toggleBtn = document.getElementById('darkModeToggle');
if (toggleBtn) {
    toggleBtn.addEventListener('click', () => {
        document.body.classList.toggle('light-mode');
        document.body.classList.toggle('dark-mode');
        localStorage.setItem('theme', document.body.classList.contains('light-mode') ? 'light' : 'dark');
    });
    // Load theme from storage
    window.addEventListener('load', () => {
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme) {
            document.body.classList.remove('light-mode', 'dark-mode');
            document.body.classList.add(savedTheme + '-mode');
        }
    });
}

// AJAX contact form submission
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');
    const contactResult = document.getElementById('contactResult');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(contactForm);
            fetch('contact.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                contactResult.innerHTML = data;
                contactForm.reset();
            })
            .catch(error => {
                contactResult.innerHTML = 'An error occurred. Please try again.';
            });
        });
    }
});
