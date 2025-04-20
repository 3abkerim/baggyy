import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file is bundled via Webpack Encore and loaded using
 * {{ encore_entry_script_tags('app') }} in base.html.twig.
 */
import './styles/app.css';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();
