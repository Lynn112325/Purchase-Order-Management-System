// Purpose: To handle the selection of target restaurant
// display the type and address of the selected restaurant
let inventory = []; // Initialize inventory variable
let category = "all"; // Initialize category variable

document.getElementById("target-restaurant").addEventListener("change", function () {
    const selectedRestaurant = this.options[this.selectedIndex];
    const restaurantType = selectedRestaurant.getAttribute("data-type");
    const restaurantAddress = selectedRestaurant.getAttribute("data-address");
    document.getElementById("type").value = restaurantType;
    document.getElementById("address").value = restaurantAddress;
});

async function loadInventory(restaurantId) {

    if (!isValidRestaurantSelected()) {
        // alert("Please select a valid restaurant.");
        showToast("Please select a valid restaurant.", "danger");
        return;
    }

    const inventoryTbody = document.getElementById("inventory");
    try {
        // const response = await fetch(`/inventory/${restaurantId}`);

        const BASE_URL = "/centralizedProcurementSystem/";
        const response = await fetch(`${BASE_URL}inventory/${restaurantId}`, {
            method: "GET",
        });

        // display loading spinner while fetching data
        inventoryTbody.innerHTML =
            '<tr><td colspan="7" class="text-center"><div class="spinner-border" role="status"></div></td></tr>';

        if (!response.ok) {
            throw new Error(`HTTP ERROR: ${response.status}`);
        } else {
            inventory = await response.json();

            // console.log("inventory: ", inventory);

            updateInventoryDisplay(category);
        }
    } catch (error) {
        inventoryTbody.innerHTML =
            '<tr><td colspan="7" class="text-center text-danger">Failed to load inventory</td></tr>';
        console.error("Error Request:", error);
        showErrorModal(error.message);
    }
}

// Function to handle inventory display based on selected category
function updateInventoryDisplay(categoryName) {

    category = categoryName; // Update the global category variable
    const inventoryTbody = document.getElementById("inventory");
    inventoryTbody.innerHTML = "";

    // 確保 showErrorModal 不會在元素不存在時被調用
    if (document.getElementById("error-modal")) {
        showErrorModal(error.message);
    }

    let isValidAddToCart = "disabled";

    // is valid add-to-cart button
    if ($(".breadcrumb .active").hasClass("step2") ) {
        isValidAddToCart = "";
    }

    inventory.forEach((item) => {
        if (categoryName !== item.categoryName && categoryName !== "all") {
            return; // Skip items that don't match the selected category
        }
        const row = document.createElement("tr");
        row.innerHTML = `<td>${item.itemId}</td>
            <td>${item.itemName}</td><td>
            <img src="static/image/${item.imgUrl
            }" alt="Item Image" style="max-width: 60px; height: auto;">
            <td>${item.specifications ?? "--"}</td>
            <td>${item.stock}</td>
            <td >
                <button class="btn add-to-cart btn-primary" ${isValidAddToCart} onclick="addToCart('${item.itemId}')">
                    <i class='bx bx-cart-add'></i>
                </button>
            </td>
        `;
        inventoryTbody.appendChild(row);
    });
}

function showErrorModal(message) {
    const modal = document.getElementById("error-modal");
    const modalBody = modal.querySelector(".modal-body");
    modalBody.textContent = message;
    modal.classList.add("show");
}
