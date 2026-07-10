//register form
const registerTrigger = document.getElementById('register-trigger');
const registerOverlay = document.getElementById('register-overlay');
const registerClose = document.getElementById('register-close');

if (registerTrigger && registerOverlay && registerClose) {
    registerTrigger.addEventListener('click', function (event) {
        event.preventDefault();
        registerOverlay.classList.add('active');
        document.body.classList.add('no-scroll');
    });
    registerClose.addEventListener('click', function () {
        registerOverlay.classList.remove('active');
        document.body.classList.remove('no-scroll');
    });
    registerOverlay.addEventListener('click', function (event) {
        if (event.target === registerOverlay) {
            registerOverlay.classList.remove('active');
            document.body.classList.remove('no-scroll');
        }
    });
}
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
                    alert("Uspešno ste se registrovali! Proverite vaš email za aktivacioni link.");

                    registerForm.reset();

                    const overlay = document.getElementById("register-overlay");
                    if (overlay) {
                        overlay.style.display = "none";
                    }
                } else {
                    alert("Greska: " + responseData.message);
                }
            } catch (error) {
                console.error("Greska prilikom komunikacije sa APIjem:", error);
                alert("Doslo je do greske na serveru. Pokusajte ponovo kasnije.");
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

//login form
document.addEventListener('DOMContentLoaded', function() {
    const loginTrigger = document.getElementById('login-trigger');
    const loginOverlay = document.getElementById('login-overlay');
    const loginClose = document.getElementById('login-close');

    if (loginTrigger && loginOverlay && loginClose) {
        loginTrigger.addEventListener('click', function(event) {
            event.preventDefault();
            loginOverlay.classList.add('active');
            document.body.classList.add('no-scroll');
        });

        loginClose.addEventListener('click', function() {
            loginOverlay.classList.remove('active');
            document.body.classList.remove('no-scroll');
        });

        loginOverlay.addEventListener('click', function(event) {
            if (event.target === loginOverlay) {
                loginOverlay.classList.remove('active');
                document.body.classList.remove('no-scroll');
            }
        });
    }
    const loginForm = document.getElementById('login-form');
    const errorMessageDiv = document.getElementById('login-error-message');

    if (loginForm) {
        loginForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            if (errorMessageDiv) {
                errorMessageDiv.style.display = 'none';
                errorMessageDiv.innerText = '';
            }

            const email = document.getElementById('login-email').value;
            const password = document.getElementById('login-password').value;

            try {
                const response = await fetch('api/login.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        email: email,
                        password: password
                    })
                });

                const data = await response.json();

                if (response.ok) {
                    window.location.reload();
                } else {
                    if (errorMessageDiv) {
                        errorMessageDiv.innerText = data.message;
                        errorMessageDiv.style.display = 'block';
                    } else {
                        alert(data.message);
                    }
                }
            } catch (error) {
                console.error("Greška prilikom konekcije:", error);
                if (errorMessageDiv) {
                    errorMessageDiv.innerText = "Došlo je do greške na serveru. Pokušajte ponovo.";
                    errorMessageDiv.style.display = 'block';
                } else {
                    alert("Došlo je do greške na serveru.");
                }
            }
        });
    }
});
// modal for forgot password
const forgotPasswordTrigger = document.getElementById('forgot-password-trigger');
const forgotPasswordOverlay = document.getElementById('forgot-password-overlay');
const forgotPasswordClose = document.getElementById('forgot-password-close');
const backToLoginTrigger = document.getElementById('back-to-login-trigger');
const loginOverlay = document.getElementById('login-overlay');

// click on forgot password
if (forgotPasswordTrigger && forgotPasswordOverlay && loginOverlay) {
    forgotPasswordTrigger.addEventListener('click', function(event) {
        event.preventDefault();
        loginOverlay.classList.remove('active'); // Gasi login modal
        forgotPasswordOverlay.classList.add('active'); // Pali reset modal
    });
}

// close on X
if (forgotPasswordClose) {
    forgotPasswordClose.addEventListener('click', function() {
        forgotPasswordOverlay.classList.remove('active');
        document.body.classList.remove('no-scroll');
    });
}

// back to login form
if (backToLoginTrigger) {
    backToLoginTrigger.addEventListener('click', function(event) {
        event.preventDefault();
        forgotPasswordOverlay.classList.remove('active');
        loginOverlay.classList.add('active');
    });
}

// Klik na crnu pozadinu
if (forgotPasswordOverlay) {
    forgotPasswordOverlay.addEventListener('click', function(event) {
        if (event.target === forgotPasswordOverlay) {
            forgotPasswordOverlay.classList.remove('active');
            document.body.classList.remove('no-scroll');
        }
    });
}

// reset password
const forgotPasswordForm = document.getElementById('forgot-password-form');
const forgotMessageDiv = document.getElementById('forgot-password-message');
const forgotSubmitBtn = document.getElementById('forgot-submit-btn');

if (forgotPasswordForm) {
    forgotPasswordForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        //sending request and locking button
        forgotMessageDiv.style.display = 'none';
        forgotMessageDiv.className = 'alert';
        forgotSubmitBtn.innerText = 'Slanje...';
        forgotSubmitBtn.disabled = true;

        const email = document.getElementById('forgot-email').value;

        try {
            const response = await fetch('api/forgot-password.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ email: email })
            });

            const data = await response.json();

            if (response.ok) {
                forgotMessageDiv.innerText = data.message;
                forgotMessageDiv.classList.add('alert-success');
                forgotMessageDiv.style.display = 'block';
                forgotPasswordForm.reset();
            } else {
                forgotMessageDiv.innerText = data.message || "Došlo je do greške.";
                forgotMessageDiv.classList.add('alert-danger');
                forgotMessageDiv.style.display = 'block';
            }
        } catch (error) {
            console.error("Greška pri slanju reseta:", error);
            forgotMessageDiv.innerText = "Greška na serveru. Pokušajte ponovo.";
            forgotMessageDiv.classList.add('alert-danger');
            forgotMessageDiv.style.display = 'block';
        } finally {
            forgotSubmitBtn.innerText = 'Pošalji link';
            forgotSubmitBtn.disabled = false;
        }
    });
}
// code for filters on courts page
// Kod za filtere na stranici terena
document.addEventListener("DOMContentLoaded", function() {
    const filterButtons = document.querySelectorAll('.court-filter-btn');
    const courtItems = document.querySelectorAll('.court-item');

    if (filterButtons.length > 0 && courtItems.length > 0) {
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // 1. Skini 'active' klasu sa svih dugmića
                filterButtons.forEach(btn => btn.classList.remove('active'));

                // 2. Dodaj 'active' klasu na dugme koje je kliknuto
                this.classList.add('active');

                // 3. Uzmi vrednost filtera i pretvori u mala slova
                const filterValue = this.getAttribute('data-filter').trim().toLowerCase();

                // 4. Prođi kroz sve terene i prikaži/sakrij ih
                courtItems.forEach(item => {
                    // Uzmi sport iz baze i pretvori u mala slova
                    const itemSport = item.getAttribute('data-sport').trim().toLowerCase();

                    if (filterValue === 'svi' || filterValue === itemSport) {
                        item.style.display = 'block'; // Prikaži
                    } else {
                        item.style.display = 'none';  // Sakrij
                    }
                });
            });
        });
    }
});