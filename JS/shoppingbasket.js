function addToCart(voyage_id, voyage_name, voyage_price){
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    let existingItem = cart.find(item => item.id === voyage_id);

    if(existingItem){
        existingItem.quantity += 1;
    }
    else{
        cart.push({
            id: voyage_id,
            name: voyage_name,
            price: voyage_price,
            quantity: 1
        });
    }

    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartIcon();
}

function updateCartIcon(){
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let totalItems = cart.reduce((acc, item) => acc + item.quantity, 0);
    document.querySelector('.cart-count').textContent = totalItems;
}

window.onload = function(){
    updateCartIcon();
}