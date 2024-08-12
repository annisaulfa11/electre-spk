import './bootstrap';
import "flowbite";
import "tw-elements";
import Alpine from 'alpinejs';
import { Tooltip, Select, initTE} from "tw-elements";
initTE({ Tooltip, Select});

import { Modal } from 'flowbite';
const modalEl = document.getElementById('info-popup');
const privacyModal = new Modal(modalEl, {
    placement: 'center'
});

const openModalLink = document.getElementById('open-modal');
    openModalLink.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default behavior of the link
        privacyModal.show();
    });

const closeModalEl = document.getElementById('close-modal');
closeModalEl.addEventListener('click', function() {
    privacyModal.hide();
});

const acceptPrivacyEl = document.getElementById('confirm-button');
acceptPrivacyEl.addEventListener('click', function() {
    privacyModal.hide();
});


window.Alpine = Alpine;

Alpine.start();


