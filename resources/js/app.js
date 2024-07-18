import './bootstrap';
import Alpine from 'alpinejs'
import 'bootstrap-table';
import './app/toast';

Alpine.start()

window.Alpine = Alpine

document.addEventListener('DOMContentLoaded', function () {
    const requiredElement = document.querySelectorAll('[required]');
    const submitButtons = document.querySelectorAll('button[type="submit"]');

    requiredElement.forEach(element => {
        const elementName = element.getAttribute('name');
        const label = element.closest('form').querySelector(`label[for="${elementName}"]`);

        label.classList.add('required-label');
    })

    submitButtons.forEach(button => button.addEventListener('click', disabledButton));

    function disabledButton(e) {
        e.target.disabled = true;
        e.target.closest('form').submit();
    }

    $(function () {
        $("[data-bs-toggle='tooltip']").tooltip()
    });
});





