function simulateUpdate(button) {
    
    button.disabled = true;
    button.textContent = "Update...";

    
    setTimeout(() => {
        
        button.disabled = false;
        button.textContent = "Modifier";

        
        alert("Update simulated with success!");
    }, 3000); 
}
