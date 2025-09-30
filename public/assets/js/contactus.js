function validateContactForm() {
    const form = document.getElementById('contact_us_quote-form');

    const name = form.name.value.trim();
    const email = form.email.value.trim();
    const phone = form.phone.value.trim();
    const message = form.message.value.trim();
    const hp = form.hp.value;

    // Honeypot check
    if (hp !== '') {
        return false; // block bots
    }

    // Name validation
    if (name.length === 0 || name.length > 255) {
        alert("Name is required and must be less than 255 characters.");
        return false;
    }

    // Email validation (HTML5 already handles it, this is extra)
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email) || email.length > 255) {
        alert("Please enter a valid email address (max 255 characters).");
        return false;
    }

    // Phone validation
    const phoneRegex = /^[0-9]{11}$/;
    if (!phoneRegex.test(phone)) {
        alert("Phone number must be exactly 11 digits.");
        return false;
    }

    // Message validation
    if (message.length === 0 || message.length > 2000) {
        alert("Message is required and must be less than 2000 characters.");
        return false;
    }

    return true;
}