function updateTotalAndFields() {


    const voyageId = document.querySelector("input[name='voyage_id']").value;


    const hotel = document.querySelector("select[name='hotel']").value;


    const activites = [...document.querySelectorAll("select[name='activites[]']")].map(select => select.value);





    const hotelPrice = parseFloat(document.querySelector("select[name='hotel'] option:checked")?.dataset.price || 0);


    const activityPrices = [...document.querySelectorAll("select[name='activites[]']")].map(select => {


        return parseFloat(select.selectedOptions[0]?.dataset.price || 0);


    });





    const basePrice = parseFloat(document.getElementById("montant").value);


    const total = (basePrice * 2) + hotelPrice + activityPrices.reduce((a, b) => a + b, 0);





    document.getElementById("reservations_input").value = JSON.stringify([{


        voyage_id: voyageId,


        hotel: hotel,


        activities: activites


    }]);





    document.getElementById("total_input").value = total.toFixed(2);


    document.getElementById("totalPrice").textContent = total.toFixed(2) + " €";





    document.getElementById("selected_hotel").value = hotel;


    document.getElementById("selected_activities").value = activites.join(', ');


    document.getElementById("hidden_total_price").value = total.toFixed(2);


}





document.querySelector("select[name='hotel']").addEventListener("change", updateTotalAndFields);


document.querySelectorAll("select[name='activites[]']").forEach(select => {


    select.addEventListener("change", updateTotalAndFields);


});





document.getElementById('reservationForm').addEventListener('submit', function () {


    updateTotalAndFields();


});





document.getElementById('addToCartForm').addEventListener('submit', function (e) {


    e.preventDefault();


    updateTotalAndFields();


    setTimeout(() => {


        document.getElementById('addToCartForm').submit();


    }, 100);


});
updateTotalAndFields();