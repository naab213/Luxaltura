document.getElementById('signin').addEventListener('submit', function (e) {
  const password = document.getElementById('password');
  let isValid = true;

 
  if (password.value.length > password.maxLength) {
      showError(password, `Le mot de passe ne doit pas dépasser ${password.maxLength} caractères.`);
      isValid = false;
  } else {
      clearError(password);
  }

  
  if (!isValid) {
      e.preventDefault();
  }
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


document.querySelectorAll('input[data-counter]').forEach(input => {
    const counter = document.getElementById(input.dataset.counter); 
    input.addEventListener('input', () => {
        counter.textContent = `${input.value.length}/${input.maxLength}`; 
    });
});


document.querySelectorAll('.pw-toggle').forEach(icon => {
    icon.addEventListener('click', () => {
        // Trouver le champ password associé
        const passwordInput = icon.parentElement.querySelector(
            'input[type="password"], input[type="text"]'
        );

        
        const isPassword = passwordInput.type === 'password';
        passwordInput.type = isPassword ? 'text' : 'password';

       
        icon.classList.toggle('uil-eye-slash');
        icon.classList.toggle('uil-eye');

        
        icon.style.transform = 'translateY(-50%) scale(1.1)';
        setTimeout(() => {
            icon.style.transform = 'translateY(-50%) scale(1)';
        }, 200);
    });
});
