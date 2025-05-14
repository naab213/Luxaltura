document.addEventListener('DOMContentLoaded', function () {
    const hotelSelect = document.querySelector('select[name="hotel"]');
    const activitySelects = document.querySelectorAll('select[name="activites[]"]');
    const selectedHotelInput = document.getElementById('selected_hotel');
    const selectedActivitiesInput = document.getElementById('selected_activities');
    const totalPriceDisplay = document.getElementById('totalPrice');
    const hiddenTotalPrice = document.getElementById('hidden_total_price');
    const basePriceInput = document.getElementById('montant');

    function updateSelections() {

        const hotelName = hotelSelect.value;
        const hotelPrice = parseFloat(hotelSelect.selectedOptions[0].dataset.price || 0);

        const selectedActivities = [];
        let activitiesTotal = 0;
        activitySelects.forEach(select => {
            const opt = select.selectedOptions[0];
            if (opt && opt.value) {
                selectedActivities.push(opt.value);
                activitiesTotal += parseFloat(opt.dataset.price || 0);
            }
        });

        const flightBase = parseFloat(basePriceInput.value || 0);
        const flightTotal = flightBase * 2;

        const total = flightTotal + hotelPrice + activitiesTotal;

        selectedHotelInput.value = hotelName;
        selectedActivitiesInput.value = JSON.stringify(selectedActivities);
        hiddenTotalPrice.value = total.toFixed(2);
        totalPriceDisplay.textContent = total.toFixed(2) + " €";
    }

    hotelSelect?.addEventListener('change', updateSelections);
    activitySelects.forEach(select => select.addEventListener('change', updateSelections));

    updateSelections(); 
});

