function edit(fieldId){
            const inputField = document.getElementById(fieldId);
            inputField.disabled = !inputField.disabled;
        }

        function updateForm(){
            const fields = {
                lastname: document.getElementById('lastname').value,
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                age: document.getElementById('age').value,
                password: document.getElementById('pw').value
            };

            fetch('update_user.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(fields)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Profile updated successfully!');
                } else {
                    alert('Error updating profile: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating the profile.');
            });

            const inputFields = document.querySelectorAll('input');
            inputFields.forEach(field => field.disabled = true);
        }

        function logout(){
            fetch('logout.php', { method: 'POST' })
                .then(() => {
                    window.location.href = 'sign_in.php';
                })
                .catch(error => {
                    console.error('Error during logout:', error);
                });
        }