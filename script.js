// 1. Smooth Scrolling for Navigation
document.querySelectorAll('a[href^="#"]').forEach(link => {
    link.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            window.scrollTo({
                top: target.offsetTop - 80, // Offset for navbar
                behavior: 'smooth'
            });
        }
    });
});

// 2. Dynamic Navbar Background Change
const navbar = document.querySelector('.top-header');
window.addEventListener('scroll', () => {
    if (window.scrollY > 100) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

// 3. Contact Form Submission (Mock Logic)
const contactForm = document.querySelector(".contact-form");
if (contactForm) {
    contactForm.addEventListener("submit", function (e) {
        e.preventDefault();
        const name = this.querySelector("input[type='text']").value;
        const email = this.querySelector("input[type='email']").value;
        const message = this.querySelector("textarea").value;

        if (name && email && message) {
            // Simulate success message
            const btn = this.querySelector("button");
            const originalText = btn.innerHTML;
            btn.innerHTML = "Submitting...";
            btn.disabled = true;

            setTimeout(() => {
                alert(`Thank you, ${name}! We have received your message and will get back to you soon.`);
                btn.innerHTML = originalText;
                btn.disabled = false;
                this.reset();
            }, 1000);
        } else {
            alert("Please fill in all the required fields.");
        }
    });
}

// 4. Update Footer Year
function updateYear() {
    const yearEl = document.getElementById("year");
    if (yearEl) {
        yearEl.textContent = new Date().getFullYear();
    }
}
updateYear();

// 5. Hero Text Fade-In Animation
window.addEventListener('DOMContentLoaded', () => {
    const heroH1 = document.querySelector('.hero-content h1');
    const heroP = document.querySelector('.hero-content p');
    
    if (heroH1) heroH1.style.opacity = "1";
    if (heroP) heroP.style.opacity = "1";
});


