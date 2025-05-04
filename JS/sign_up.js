document.querySelectorAll('.pw-toggle').forEach(icon => {
    icon.addEventListener('click', function () {
      const input = this.parentElement.querySelector('input');
      const isPassword = input.type === 'password';
  
     
      input.type = isPassword ? 'text' : 'password';
  
    
      this.classList.toggle('uil-eye-slash');
      this.classList.toggle('uil-eye');
  
      
      this.style.transform = 'translateY(-50%) scale(1.1)';
      setTimeout(() => {
        this.style.transform = 'translateY(-50%)';
      }, 200);
    });
  });

document.querySelector('form').addEventListener('submit', function (e) {
    const lastname = document.getElementById('lastname');
    const name = document.getElementById('name');
    const age = document.getElementById('age');
    const email = document.getElementById('email');
    const emailConf = document.getElementById('emailconf');
    const password = document.querySelector('input[name="pass"]');
    const passwordConf = document.querySelector('input[name="passwordconf"]');
    let isValid = true;

    
    if (lastname.value.trim() === "") {
        showError(lastname, 'Le nom de famille est requis.');
        isValid = false;
    } else {
        clearError(lastname);
    }

    
    if (name.value.trim() === "") {
        showError(name, 'Le prénom est requis.');
        isValid = false;
    } else {
        clearError(name);
    }

   
    if (age.value <= 0 || isNaN(age.value)) {
        showError(age, 'Veuillez entrer un âge valide.');
        isValid = false;
    } else {
        clearError(age);
    }

    
    if (email.value !== emailConf.value) {
        showError(emailConf, 'Les emails ne correspondent pas.');
        isValid = false;
    } else {
        clearError(emailConf);
    }


    if (password.value !== passwordConf.value) {
        showError(passwordConf, 'Les mots de passe ne correspondent pas.');
        isValid = false;
    } else {
        clearError(passwordConf);
    }

    
    if (!isValid) {
        e.preventDefault();
    }
});

document.querySelectorAll('input[maxlength]').forEach(input => {
    const counterId = input.getAttribute('data-counter');
    const counter = document.getElementById(counterId);

    input.addEventListener('input', () => {
        counter.textContent = `${input.value.length}/${input.maxLength}`;
    });
});

function showError(input, message) {
    const parent = input.parentElement;
    let error = parent.querySelector('.error-message');
    if (!error) {
        error = document.createElement('span');
        error.className = 'error-message';
        parent.appendChild(error);
    }
    error.textContent = message;
    input.classList.add('error');
}

function clearError(input) {
    const parent = input.parentElement;
    const error = parent.querySelector('.error-message');
    if (error) {
        parent.removeChild(error);
    }
    input.classList.remove('error');
}
