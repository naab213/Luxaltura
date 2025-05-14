function updateTotalAndFields() {
    const voyageId = document.querySelector("input[name='voyage_id']").value;
    const hotel = document.querySelector("select[name='hotel']").value;
    const activites = [...document.querySelectorAll("select[name='activites[]']")].map(select => select.value);

    fetch('updateprice.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            voyage_id: voyageId,
            hotel: hotel,
            activities: activites
        })
    })
    .then(response => response.text())
    .then(text => {

        try {
            const jsonResponse = JSON.parse(text);
            console.log("Response JSON:", jsonResponse);

            document.getElementById("totalPrice").textContent = jsonResponse.total + " €";
            document.getElementById("total_input").value = jsonResponse.total;
        } catch (error) {
            console.error("Request error:", error);
        }
    })
    .catch(error => {
        console.error("Request error:", error);
    });
}

document.querySelector("select[name='hotel']").addEventListener("change", updateTotalAndFields);
document.querySelectorAll("select[name='activites[]']").forEach(select => {
    select.addEventListener("change", updateTotalAndFields);
});

updateTotalAndFields();
