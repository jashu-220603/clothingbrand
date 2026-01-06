document.querySelectorAll('a[href^="#"]').forEach(link => {
    link.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href'))
            .scrollIntoView({ behavior: 'smooth' });
    });
});
window.addEventListener('scroll', () => {
    const nav = document.querySelector('.top-header');
    if (window.scrollY > 50) {
        nav.classList.add('scrolled');
    } else {
        nav.classList.remove('scrolled');
    }
});
document.querySelectorAll('.product-card').forEach(card => {
    card.addEventListener('mouseenter', () => {
        card.style.transform = 'scale(1.05)';
    });
    card.addEventListener('mouseleave', () => {
        card.style.transform = 'scale(1)';
    });
});
const form = document.querySelector(".contact-form");

form.addEventListener("submit", function (event) {
    event.preventDefault();

    const name = form.querySelector("input[type='text']").value;
    const email = form.querySelector("input[type='email']").value;
    const message = form.querySelector("textarea").value;

    if (name === "" || email === "" || message === "") {
        alert("Please fill all the fields!");
    } else {
        alert("Thank you, " + name + "! Your Suggestionhas been submitted.");
        form.reset();
    }
});
const heroText = document.querySelector('.hero-content h1');
heroText.style.opacity = 0;

window.addEventListener('load', () => {
    heroText.style.transition = '3s';
    heroText.style.opacity = 1;
});
function updateYear() {
    const year = new Date().getFullYear();
    document.getElementById("year").textContent = year;
}
updateYear();


