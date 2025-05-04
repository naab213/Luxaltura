document.addEventListener('DOMContentLoaded', function () {
  const selects = document.querySelectorAll('select');
  const priceDisplay = document.getElementById('totalPrice');
  const montantInput = document.getElementById('montant');
  const totalPriceHiddenInput = document.getElementById('hidden_total_price');
  const cartForm = document.getElementById('addToCartForm');
  const selectedHotelInput = document.getElementById('selected_hotel');
  const selectedActivitiesInput = document.getElementById('selected_activities');

  const basePrice = parseFloat(montantInput.value) || 0;

  function updatePrice() {
      let total = basePrice * 2;

      selects.forEach(select => {
          const selected = select.options[select.selectedIndex];
          const price = parseFloat(selected.getAttribute('data-price')) || 0;
          total += price;
      });

      const totalFormatted = total.toFixed(2) + ' €';
      priceDisplay.textContent = totalFormatted;
      montantInput.value = total.toFixed(2);
      if (totalPriceHiddenInput) {
          totalPriceHiddenInput.value = total.toFixed(2);
      }
  }

  selects.forEach(select => {
      select.addEventListener('change', updatePrice);
  });

  updatePrice();

  if (cartForm) {
      cartForm.addEventListener('submit', function () {
          const hotelSelect = document.querySelector('select[name="hotel"]');
          const hotel = hotelSelect ? hotelSelect.value : '';

          const activites = Array.from(document.querySelectorAll('select[name="activites[]"]'))
              .map(select => select.value);

          if (selectedHotelInput) selectedHotelInput.value = hotel;
          if (selectedActivitiesInput) selectedActivitiesInput.value = JSON.stringify(activites);
      });
  }
});
