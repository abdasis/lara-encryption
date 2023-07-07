import './bootstrap';
import "@tabler/core/src/js/tabler.js"
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
window.Alpine = Alpine;

Alpine.plugin(focus);

Alpine.start();
