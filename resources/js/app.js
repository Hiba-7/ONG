import "./bootstrap";
import Alpine from "alpinejs";
import intlTelInput from "intl-tel-input";
import Focus from "@alpinejs/focus";
import FormsAlpinePlugin from "../../vendor/filament/forms/dist/module.esm";
import NotificationsAlpinePlugin from "../../vendor/filament/notifications/dist/module.esm";

Alpine.plugin(Focus);
Alpine.plugin(FormsAlpinePlugin);
Alpine.plugin(NotificationsAlpinePlugin);
window.Alpine = Alpine;
Alpine.start();

// Initialize the IntlTelInput plugin
const input = document.querySelector("#phone");
intlTelInput(input, {
    utilsScript:
        "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js",
    autoPlaceholder: "polite",
    initialCountry: "dz",
});
