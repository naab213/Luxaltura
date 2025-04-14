let voyages = [];

const packLabels = {
    "default": null,
    "Buisness": 1,
    "Military": 2,
    "Adrenaline": 3,
    "Future": 4
};

document.getElementById('search').addEventListener('submit', function (e){
    const date = document.getElementById('date').value;
    const continent = document.getElementById('continent').value;
    const airplane = document.getElementById('airplane').value;
    const priceRange = document.getElementById('tranch-price').value;
    const search = document.getElementById('request').value.trim();

    if(!date || (continent === 'default' && airplane === 'default' && priceRange === 'default' && !search)){
        e.preventDefault();
        alert('Please select at least one filter (search term, continent, airplane type, or price range) along with the date.');
        return;
    }

    e.preventDefault();
    applyFilters();
});

document.addEventListener("DOMContentLoaded", () => {
    fetch('dataJSON/fly.json')
        .then(res => res.json())
        .then(data => {
            voyages = data;
        });
});

function applyFilters(){
    const searchText = document.getElementById("request").value.toLowerCase();
    const pack = packLabels[document.getElementById("airplane").value];
    const continent = document.getElementById("continent").value;
    const priceRange = document.getElementById("tranch-price").value;

    const filtered = voyages.filter(v => {
        const matchSearch = v.nom?.toLowerCase().includes(searchText);
        const matchPack = (pack === null) || v.pack == pack;
        const matchContinent = (continent === "default") || v.continent === continent;
        const matchPrice = matchPriceRange(v.prix, priceRange);
        return matchSearch && matchPack && matchContinent && matchPrice;
    });

    if(searchText || pack !== null || continent !== 'default' || priceRange !== 'default'){
        document.getElementById("default-table").style.display = "none";
        document.getElementById("results-section").style.display = "block";
    }
    else{
        document.getElementById("default-table").style.display = "block";
        document.getElementById("results-section").style.display = "none";
    }

    displayVoyages(filtered);
}

function matchPriceRange(price, rangeLabel){
    const priceNum = parseInt(price) * 2;

    switch (rangeLabel) {
        case "price1": return priceNum >= 1200 && priceNum <= 4000;
        case "price2": return priceNum >= 4100 && priceNum <= 7000;
        case "price3": return priceNum >= 7100 && priceNum <= 16000;
        case "price4": return priceNum >= 16100 && priceNum <= 56000;
        default: return true;
    }
}

function displayVoyages(voyages){
    const container = document.getElementById("search-results");
    container.innerHTML = "";

    if(voyages.length === 0){
        container.innerHTML = "<tr><td colspan='3'><center>No trips found.</center></td></tr>";
        return;
    }

    voyages.forEach(v => {
        const row = document.createElement("tr");
        row.id = "line";

        row.style.cursor = "pointer";

        row.onclick = () => {
            const url = `detail.php?id=${v.id}&date=${document.getElementById('date').value}&pays=${encodeURIComponent(v.pays ?? v.nom)}`;
            window.location.href = url;
        };

        row.innerHTML = `
            <td>
                <div class="image-container">
                    <img src="${v.image}" width="150" height="100">
                </div>
            </td>
            <td>
                <p>${v.ville ?? ""} ${v.pays ?? v.nom}</p>
                <p>${packName(v.pack)}</p>
            </td>
            <td class="price">
                ${v.prix * 2}€
                <span class="price-note">Round trip</span>
            </td>
        `;

        container.appendChild(row);
    });
}

function packName(id){
    const packs = {
        1: "Business Elite✨",
        2: "Military Experience✈️",
        3: "Adrenaline Flight🎢",
        4: "Future Sky🚀"
    };
    return packs[id] ?? "Not defined";
}
