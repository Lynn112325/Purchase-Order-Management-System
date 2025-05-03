document.addEventListener("DOMContentLoaded", function () {
    if (sessionStorage.getItem("targetRestaurant") !== null) {
        sessionStorage.removeItem("targetRestaurant");
        const restaurant = JSON.parse(sessionStorage.getItem("targetRestaurant"));
        renderRestaurantInfo(restaurant.name, restaurant.type, restaurant.address);
        renderStep2();
    }
});

// Check if a valid restaurant is selected
window.isValidRestaurantSelected = function() {
    const restaurantSelect = document.getElementById("target-restaurant");
    const currentSelection = restaurantSelect?.value || ""; 

    const storedSelection = sessionStorage.getItem("targetRestaurant") || "";
    
    // Check if the current selection is empty or if it doesn't match the stored selection
    const targetValue = currentSelection.trim() || storedSelection.trim();
    
    return targetValue.length > 0;
}

// step 1: Confirm Target Restaurant to Order From
function confirmTargetRestaurant() {
    if (!isValidRestaurantSelected()) {
        // console.log("No valid restaurant selected.");
        showToast("Please select a valid restaurant.", "danger");
        return;
    }
    const restaurantInfo = $('#target-restaurant option:selected');

    const targetRestaurant = document.getElementById("target-restaurant").value;
    // save the target restaurant to sessionStorage
// Store target restaurant information as a JSON string
sessionStorage.setItem("targetRestaurant", JSON.stringify({
    id: targetRestaurant,
    name: restaurantInfo.attr('data-name'),
    type: restaurantInfo.attr('data-type'),
    address: restaurantInfo.attr('data-address')
}));
    // alert("Selected restaurant: " + targetRestaurant);

    renderRestaurantInfo(restaurantInfo.attr('data-name'), restaurantInfo.attr('data-type'), restaurantInfo.attr('data-address'));
    renderStep2();
}

function renderRestaurantInfo(name, type, address) {

    // update the target restaurant area with the selected restaurant details
    $("#target-restaurant-area .card-header").empty().append("Target Restaurant");
    $("#target-restaurant-area .card-body").empty().append(
        `<div class="row input-group input-group-sm">
            <div class="col-4">
                <label for="type" class="form-label">Restaurant</label>
                <input type="text" class="form-control" id="target-restaurant" value="${name}" readonly>
            </div>
            <div class="col-2">
                <label for="type" class="form-label">Type</label>
                <input type="text" class="form-control" id="type" value="${type}" readonly>
            </div>
            <div class="col-6">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" value="${address}" readonly>
            </div>
        </div>
        `);

}

function renderStep2() {
    // Update the breadcrumb
    $(".breadcrumb .active").empty().append("Step 2: Add Requested Item(s)");
    // let the addToCartBtns not disabled
    $(".breadcrumb .active").addClass("step2");

    // Enable all add-to-cart buttons after confirming the target restaurant
    $(".add-to-cart").prop("disabled", false)
}

// step 2: Add Requested Item(s)
// when the add-to-cart button is clicked, show a modal to confirm the action
function addToCart(itemId) {

    const itemDetails = []


    const title = '';

    const card = `<div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                            <img src="..." class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">${title}</h5>
                                    <p class="card-text"></p>
                                    <p class="card-text"><small class="text-muted">\</small></p>
                                </div>
                            </div>
                        </div>
                    </div>`;



    showModal({
        title: "Confirm Add to Cart",
        content: `Are you sure you want to add this item to the cart?`,
        buttons: [
            {
                text: "Cancel",
                type: "secondary",
                dismiss: true
            },
            {
                text: "Confirm",
                type: "primary",
                id: "confirm-add-to-cart",
                dismiss: false
            }
        ]
    })

}