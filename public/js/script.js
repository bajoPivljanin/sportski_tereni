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
// booking form (court reservation)
document.addEventListener("DOMContentLoaded", function() {
    const bookCourtBtn = document.getElementById('book-court-btn');
    const bookingOverlay = document.getElementById('booking-overlay');
    const bookingClose = document.getElementById('booking-close');
    const loginOverlay = document.getElementById('login-overlay');

    if (bookCourtBtn) {
        bookCourtBtn.addEventListener('click', function() {
            if (bookingOverlay) {
                bookingOverlay.classList.add('active');
                document.body.classList.add('no-scroll');
            } else if (loginOverlay) {
                loginOverlay.classList.add('active');
                document.body.classList.add('no-scroll');
            }
        });
    }

    if (bookingClose && bookingOverlay) {
        bookingClose.addEventListener('click', function() {
            bookingOverlay.classList.remove('active');
            document.body.classList.remove('no-scroll');
        });
        bookingOverlay.addEventListener('click', function(event) {
            if (event.target === bookingOverlay) {
                bookingOverlay.classList.remove('active');
                document.body.classList.remove('no-scroll');
            }
        });
    }

    const bookingForm = document.getElementById('booking-form');
    const bookingDurationSelect = document.getElementById('booking-duration');
    const bookingPriceValue = document.getElementById('booking-price-value');

    if (bookingForm && bookingDurationSelect && bookingPriceValue) {
        const initialPrice = parseInt(bookingForm.getAttribute('data-initial-price'), 10);

        const updateBookingPrice = function() {
            const duration = parseInt(bookingDurationSelect.value, 10);
            const totalPrice = Math.round(initialPrice * (duration / 30));
            bookingPriceValue.innerText = totalPrice.toLocaleString('sr-RS') + ' rsd';
        };

        bookingDurationSelect.addEventListener('change', updateBookingPrice);
        updateBookingPrice();

        bookingForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            const bookingMessageDiv = document.getElementById('booking-message');
            const bookingSubmitBtn = document.getElementById('booking-submit-btn');

            bookingMessageDiv.style.display = 'none';
            bookingMessageDiv.className = 'alert';
            bookingSubmitBtn.innerText = 'Slanje...';
            bookingSubmitBtn.disabled = true;

            const requestData = {
                court_id: bookingForm.getAttribute('data-court-id'),
                date: document.getElementById('booking-date').value,
                time: document.getElementById('booking-time').value,
                duration: bookingDurationSelect.value
            };

            try {
                const response = await fetch('api/create-reservation.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(requestData)
                });

                const data = await response.json();

                if (response.ok) {
                    bookingMessageDiv.innerText = data.message;
                    bookingMessageDiv.classList.add('alert-success');
                    bookingMessageDiv.style.display = 'block';
                    bookingForm.reset();
                    updateBookingPrice();
                } else {
                    bookingMessageDiv.innerText = data.message || "Došlo je do greške.";
                    bookingMessageDiv.classList.add('alert-danger');
                    bookingMessageDiv.style.display = 'block';
                }
            } catch (error) {
                console.error("Greška prilikom rezervacije:", error);
                bookingMessageDiv.innerText = "Greška na serveru. Pokušajte ponovo.";
                bookingMessageDiv.classList.add('alert-danger');
                bookingMessageDiv.style.display = 'block';
            } finally {
                bookingSubmitBtn.innerText = 'Potvrdi rezervaciju';
                bookingSubmitBtn.disabled = false;
            }
        });
    }
});

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

// profile.php kod

"use strict";

document.addEventListener('DOMContentLoaded', function() {
    // 1. Forma za lične podatke
    const personalForm = document.getElementById('personal-info-form');
    const personalAlert = document.getElementById('personal-alert-box');

    if (personalForm) {
        personalForm.addEventListener('submit', function(event) {
            event.preventDefault();
            
            // Simulacija uspešnog čuvanja (ovde kasnije ide tvoj Fetch API/AJAX ka backendu)
            personalAlert.innerHTML = `
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 8px;">
                    Personal information successfully updated!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
        });
    }

    // 2. Forma za promenu lozinke
    const passwordForm = document.getElementById('security-password-form');
    const passwordAlert = document.getElementById('password-alert-box');

    if (passwordForm) {
        passwordForm.addEventListener('submit', function(event) {
            event.preventDefault();
            
            const newPassword = document.getElementById('new-password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            
            // Regex: Minimum 8 karaktera, bar jedno veliko slovo i bar jedan broj
            const passwordRegex = /^(?=.*[A-Z])(?=.*\d).{8,}$/;

            // Validacija jačine lozinke
            if (!passwordRegex.test(newPassword)) {
                passwordAlert.innerHTML = `
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 8px;">
                        Password must be at least 8 characters long, contain at least one uppercase letter and one number.
                    </div>
                `;
                return;
            }

            // Validacija poklapanja lozinki
            if (newPassword !== confirmPassword) {
                passwordAlert.innerHTML = `
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 8px;">
                        New passwords do not match!
                    </div>
                `;
                return;
            }

            // Ako je sve u redu, prikazujemo uspeh
            passwordAlert.innerHTML = `
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 8px;">
                    Password successfully changed!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
            passwordForm.reset();
        });
    }
});

// moje_rezervacije akcije

"use strict";

/**
 * TASK 3: Handles the asynchronous cancellation UI logic.
 * Changes the status badge to "Otkazano" without page refresh.
 */
function cancelBooking(bookingId) {
  const confirmAction = confirm("Da li ste sigurni da želite da otkažete ovu rezervaciju?");
  
  if (confirmAction) {
    const row = document.getElementById(`booking-row-${bookingId}`);
    if (row) {
      const statusCell = row.querySelector('.status-cell');
      
      // Update cell content directly to red bootstrap pill badge without reload
      statusCell.innerHTML = `
        <span class="badge rounded-pill status-cancelled bg-danger text-white px-3 py-2">
          Otkazano
        </span>
      `;
      
      // Disable all action buttons in the row after successful cancellation
      const buttons = row.querySelectorAll('.action-btn');
      buttons.forEach(function(btn) {
        btn.disabled = true;
      });
    }
  }
}

/**
 * TASK 4: Handles opening the Bootstrap 5 modal window.
 * Prefills the input fields with current row data before showing up.
 */
function openEditModal(bookingId) {
  const row = document.getElementById(`booking-row-${bookingId}`);
  if (!row) {
    return;
  }

  // Extract date-time and duration stored inside data-* attributes
  const datetime = row.querySelector('.reservation-time-cell').getAttribute('data-datetime');
  const duration = row.querySelector('.reservation-duration-cell').getAttribute('data-duration');

  // Inject extracted data straight into modal input elements
  document.getElementById('edit-booking-id').value = bookingId;
  document.getElementById('edit-date-time').value = datetime;
  document.getElementById('edit-duration').value = duration;

  // Initialize and show the Bootstrap modal window dynamically
  const modalElement = document.getElementById('edit-booking-modal');
  const modalInstance = new bootstrap.Modal(modalElement);
  modalInstance.show();
}

/**
 * Modal form submit logic setup
 */
document.addEventListener('DOMContentLoaded', function() {
  const editForm = document.getElementById('edit-booking-form');
  
  if (editForm) {
    editForm.addEventListener('submit', function(event) {
      event.preventDefault();
      
      const bookingId = document.getElementById('edit-booking-id').value;
      const newDatetime = document.getElementById('edit-date-time').value;
      const newDuration = document.getElementById('edit-duration').value;
      
      const row = document.getElementById(`booking-row-${bookingId}`);
      if (row) {
        // Parse and format chosen local datetime to standard format
        const dateObject = new Date(newDatetime);
        const day = String(dateObject.getDate()).padStart(2, '0');
        const month = String(dateObject.getMonth() + 1).padStart(2, '0');
        const year = dateObject.getFullYear();
        const hours = String(dateObject.getHours()).padStart(2, '0');
        const minutes = String(dateObject.getMinutes()).padStart(2, '0');
        
        const formattedDisplay = `${day}.${month}.${year}. u ${hours}:${minutes}h`;
        
        // Asynchronously update row display text and values without complete reload
        const timeCell = row.querySelector('.reservation-time-cell');
        timeCell.textContent = formattedDisplay;
        timeCell.setAttribute('data-datetime', newDatetime);
        
        const durationCell = row.querySelector('.reservation-duration-cell');
        durationCell.textContent = `${newDuration} min`;
        durationCell.setAttribute('data-duration', newDuration);
        
        // Safely hide modal instance after dynamic table modification
        const modalElement = document.getElementById('edit-booking-modal');
        const modalInstance = bootstrap.Modal.getInstance(modalElement);
        if (modalInstance) {
          modalInstance.hide();
        }
      }
    });
  }
});