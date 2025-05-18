document.addEventListener("DOMContentLoaded", () => {
    const params = new URLSearchParams(window.location.search);
    const voyageId = params.get("id");
    const departureInput = document.getElementById("departure");
    const returnInput = document.getElementById("return");
    const hotelSelect = document.querySelector("select[name='hotel']");
    const activityContainers = document.querySelectorAll("select[name='activites[]']");

    if (!voyageId) {
        alert("Trip ID is missing.");
        return;
    }

    fetch('dataJSON/fly.json')
        .then(res => res.json())
        .then(data => {
            const voyage = data.find(v => v.id == voyageId);
            if (!voyage) {
                alert("Trip not found.");
                return;
            }

            // Inject hotels
            hotelSelect.innerHTML = '';
            voyage.hotels.forEach(hotel => {
                const option = document.createElement("option");
                option.value = hotel.nom;
                option.textContent = `${hotel.nom} - ${hotel.prix} €`;
                option.dataset.price = hotel.prix;
                hotelSelect.appendChild(option);
            });

            // Inject activities
            const activites = [
                voyage.activite1,
                voyage.activite2,
                voyage.activite3,
                voyage.activite4
            ];

            activityContainers.forEach((select, index) => {
                select.innerHTML = '';
                activites[index].forEach(activity => {
                    const option = document.createElement("option");
                    option.value = activity.nom;
                    option.textContent = `${activity.nom} - ${activity.prix} €`;
                    option.dataset.price = activity.prix;
                    select.appendChild(option);
                });
            });

            // Update return date when departure changes
            departureInput.addEventListener("change", () => {
                const departureDate = new Date(departureInput.value);
                if (!isNaN(departureDate)) {
                    const returnDate = new Date(departureDate);
                    returnDate.setDate(returnDate.getDate() + 8);
                    returnInput.value = returnDate.toISOString().split('T')[0];
                }
            });

            // Trigger return date calculation initially
            if (departureInput.value) {
                departureInput.dispatchEvent(new Event("change"));
            }

            // Update total price if needed
            if (typeof updateTotalAndFields === "function") {
                updateTotalAndFields();
            }
        })
        .catch(err => {
            console.error("Failed to load voyage data:", err);
            alert("Unable to load trip details.");
        });

    const addToCartForm = document.getElementById("addToCartForm");
    if (addToCartForm) {
        addToCartForm.addEventListener("submit", function (e) {
            // Récupère les valeurs sélectionnées
            const hotelSelect = document.querySelector("select[name='hotel']");
            const activityContainers = document.querySelectorAll("select[name='activites[]']");
            const selectedHotel = hotelSelect ? hotelSelect.value : "";
            const selectedActivities = Array.from(activityContainers).map(sel => sel.value);

            // Calcul du total (adapte selon ton besoin)
            let total = 0;
            const basePrice = parseFloat(document.querySelector("input[name='base_price']").value) || 0;
            total += basePrice;
            const hotelOption = hotelSelect && hotelSelect.selectedOptions[0];
            if (hotelOption) total += parseFloat(hotelOption.dataset.price) || 0;
            activityContainers.forEach(sel => {
                const opt = sel.selectedOptions[0];
                if (opt) total += parseFloat(opt.dataset.price) || 0;
            });

            // Remplit les champs cachés
            document.getElementById("selected_hotel").value = selectedHotel;
            document.getElementById("selected_activities").value = JSON.stringify(selectedActivities);
            document.getElementById("hidden_total_price").value = total;
        });
    }
});
