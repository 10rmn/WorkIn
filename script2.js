document.addEventListener("DOMContentLoaded", function () {
    const contactForm = document.getElementById("contact-form");
    const nameInput = document.getElementById("name");
    const emailInput = document.getElementById("email");
    const messageInput = document.getElementById("message");
    const thankYouMessage = document.getElementById("thank-you-message");
    
    
    contactForm.addEventListener("submit", function (event) {
        event.preventDefault(); 
        
        
        if (validateForm(nameInput, emailInput, messageInput)) {
           
            contactForm.style.display = "none";
            thankYouMessage.style.display = "block";
        }
    });

   
    function validateForm(name, email, message) {
        let isValid = true;

        
        if (name.value.trim() === "") {
            alert("Name is required.");
            isValid = false;
        }

        
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!emailPattern.test(email.value.trim())) {
            alert("Please enter a valid email.");
            isValid = false;
        }

        
        if (message.value.trim() === "") {
            alert("Message cannot be empty.");
            isValid = false;
        }

        return isValid;
    }
});