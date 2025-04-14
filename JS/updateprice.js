document.addEventListener('DOMContentLoaded', function (){
    const selects = document.querySelectorAll('select');
    const priceDisplay = document.getElementById('totalPrice');
    const montantInput = document.getElementById('montant');
    const basePrice = parseFloat(montantInput.value) || 0;
  
    function updatePrice(){
      let total = basePrice * 2;
  
      selects.forEach(select => {
        const selected = select.options[select.selectedIndex];
        const price = parseFloat(selected.getAttribute('data-price')) || 0;
        total += price;
      });
  
      priceDisplay.textContent = total.toFixed(2) + ' €';
      montantInput.value = total.toFixed(2);
    }
  
    selects.forEach(select => {
      select.addEventListener('change', updatePrice);
    });
  
    updatePrice();
  });
  