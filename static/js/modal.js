document.addEventListener("DOMContentLoaded", function () {
    initializeExistingModals();
});

// initialize Bootstrap modal for existing elements
function initializeExistingModals() {
    const modalElList = [].slice.call(document.querySelectorAll(".modal"));
    modalElList.forEach(modalEl => {
        initBootstrapModal(modalEl);
    });
}

// showModal function
window.showModal = function (config) {
    const modalElement = createModalElement(config);
    const modalInstance = initBootstrapModal(modalElement);
    
    document.body.appendChild(modalElement);
    modalInstance.show();
    
    setupModalCleanup(modalElement, modalInstance);
}


// create a modal element by inputting the title, content and buttons
function createModalElement({
    title = 'Notification',
    content = '',
    buttons = { text: 'Cancel', type: 'secondary', dismiss: true }
}) {
    const modal = document.createElement('div');
    modal.className = 'modal fade';
    modal.tabIndex = -1;
    modal.innerHTML = `
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">${title}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">${content}</div>
                <div class="modal-footer">${createFooterContent(buttons)}</div>
            </div>
        </div>
    `;

    return modal;
}

// create footer content
function createFooterContent(buttons) {
    return buttons.map(btn => `
        <button 
            type="button" 
            class="btn btn-${btn.type}" 
            ${btn.dismiss ? 'data-bs-dismiss="modal"' : ''}
            ${btn.id ? `id="${btn.id}"` : ''}
        >
            ${btn.text}
        </button>
    `).join('');
}

// init Bootstrap modal
function initBootstrapModal(modalEl) {
    return new bootstrap.Modal(modalEl, {
        backdrop: 'static',
        keyboard: false,
        focus: true
    });
}

// setup modal cleanup
function setupModalCleanup(modalEl, instance) {
    modalEl.addEventListener('hidden.bs.modal', () => {
        instance.dispose();
        modalEl.remove();
    });
}