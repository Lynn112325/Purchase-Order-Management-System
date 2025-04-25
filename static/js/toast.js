document.addEventListener("DOMContentLoaded", function () {
    // initialize Bootstrap Toast
    initializeExistingToasts();
});

// initialize Bootstrap Toast for existing elements
function initializeExistingToasts() {
    var toastElList = [].slice.call(document.querySelectorAll(".toast"));
    toastElList.forEach(function (toastEl) {
        var toast = new bootstrap.Toast(toastEl);
        toast.show(); // show the toast
    });
}

// showToast function
function showToast(message, type) {
    const toast = createToastElement(message, type);

    const container = getToastContainer();
    container.appendChild(toast);

    const bsToast = initializeExistingToasts(toast);

    setupAutoCleanup(toast, bsToast);
}

window.showToast = showToast;

// createToastElement function
function createToastElement(message, type) {

    // create a new toast element
    const toast = document.createElement("div");
    toast.className = `toast align-items-center text-white bg-${type} border-1 d-flex`;
    toast.setAttribute("role", "alert");
    toast.setAttribute("aria-live", "assertive");
    toast.setAttribute("aria-atomic", "true");

    // set data attributes for Bootstrap Toast
    toast.dataset.bsAutohide = "true";
    toast.dataset.bsDelay = type === "danger" ? "5000" : "3000"; // 危险类型显示更久

    // create message body
    const toastBody = document.createElement("div");
    toastBody.className = "d-flex";

    const bodyDiv = document.createElement("div");
    bodyDiv.className = "toast-body d-flex align-items-center";
    bodyDiv.innerHTML = `
        <i class="${getIconClass(type)} me-2"></i>
        ${message}
    `;

    // create close button
    const closeButton = createCloseButton();

    // assemble elements
    toastBody.append(bodyDiv);
    toast.appendChild(toastBody);
    toast.appendChild(closeButton);

    return toast;
}

// createCloseButton function
function createCloseButton() {
    const button = document.createElement("button");
    button.type = "button";
    button.className = "btn-close btn-close-white me-2 m-auto";
    button.setAttribute("data-bs-dismiss", "toast");
    button.setAttribute("aria-label", "Close");
    return button;
}

// This function creates a toast container if it doesn't exist
function getToastContainer() {
    let container = document.getElementById("toast-container");

    if (!container) {
        container = document.createElement("div");
        container.id = "toast-container";
        container.className = `d-flex justify-content-center align-items-center`;
        document.body.appendChild(container);
    }

    return container;
}

// This function initializes the Bootstrap Toast instance
function initBootstrapToast(toastElement) {
    return new bootstrap.Toast(toastElement, {
        animation: true,
        autohide: true,
        delay: parseInt(toastElement.dataset.bsDelay),
    });
}

// This function sets up the auto-cleanup for the toast element
function setupAutoCleanup(toastElement, bsInstance) {
    toastElement.addEventListener("hidden.bs.toast", () => {
        toastElement.remove();

        const container = document.getElementById("toast-container");
        if (container && container.children.length === 0) {
            container.remove();
        }
    });
}

// This function returns the icon class based on the type of toast
function getIconClass(type) {
    const icons = {
        success: "bi bi-check-circle-fill",
        danger: "bi bi-x-circle-fill",
        warning: "bi bi-exclamation-triangle-fill",
        info: "bi bi-info-circle-fill",
    };
    return icons[type] || "bi bi-info-circle-fill";
}
