import { sendRequest } from "./sendRequest";

const switchs = document.querySelectorAll('.form-switch-visibility');

switchs.forEach(switchVisibility => {
    switchVisibility.addEventListener('change', (e) => {
        const id = e.currentTarget.dataset.id;
        sendRequest(`/admin/categories/${id}/visibility`, e.currentTarget);
    });
});