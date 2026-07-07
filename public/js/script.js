
const registerTrigger = document.getElementById('register-trigger');
const registerOverlay = document.getElementById('register-overlay');
const registerClose = document.getElementById('register-close');

registerTrigger.addEventListener('click', function(event) {
    event.preventDefault(); 
    registerOverlay.classList.add('active');
});
registerClose.addEventListener('click', function() {
    registerOverlay.classList.remove('active'); 
});
registerOverlay.addEventListener('click', function(event) {
    if (event.target === registerOverlay) {
        registerOverlay.classList.remove('active');
    }
});
//register form
document.addEventListener("DOMContentLoaded", function() {
    const registerForm = document.querySelector(".register-form");

    if (registerForm) {
        registerForm.addEventListener("submit", async function(e) {
            e.preventDefault();

            const submitBtn = registerForm.querySelector(".register-submit-btn");
            const originalBtnText = submitBtn.innerText;
            submitBtn.innerText = "Registracija u toku...";
            submitBtn.disabled = true;

            const firstName = document.getElementById("first-name").value.trim();
            const lastName = document.getElementById("last-name").value.trim();
            const email = document.getElementById("email").value.trim();
            const phone = document.getElementById("phone").value.trim();
            const password = document.getElementById("password").value;

            const passwordRegex = /^(?=.*\d)(?=.*[A-Z]).{8,}$/;
            if (!passwordRegex.test(password)) {
                alert("Lozinka mora imati najmanje 8 karaktera, jedno veliko slovo i jedan broj.");
                submitBtn.innerText = originalBtnText;
                submitBtn.disabled = false;
                return;
            }

            const requestData = {
                first_name: firstName,
                last_name: lastName,
                email: email,
                phone_number: phone,
                password: password
            };

            try {
                const response = await fetch("api/register.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(requestData)
                });
                const responseData = await response.json();

                if (response.status === 201) {
                    alert("Uspešno ste se registrovali! Proverite vaš email sandučić za aktivacioni link.");

                    registerForm.reset();

                    const overlay = document.getElementById("register-overlay");
                    if (overlay) {
                        overlay.style.display = "none";
                    }
                } else {
                    alert("Greška: " + responseData.message);
                }
            } catch (error) {
                console.error("Greška prilikom komunikacije sa API-jem:", error);
                alert("Došlo je do greške na serveru. Pokušajte ponovo kasnije.");
            } finally {
                submitBtn.innerText = originalBtnText;
                submitBtn.disabled = false;
            }
        });
    }

    const closeBtn = document.getElementById("register-close");
    if (closeBtn) {
        closeBtn.addEventListener("click", function() {
            document.getElementById("register-overlay").style.display = "none";
        });
    }
});