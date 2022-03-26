require('./bootstrap');

import Alpine from 'alpinejs';
import cartApp from './carts';

Alpine.data('cartApp', cartApp);

window.Alpine = Alpine;

Alpine.start();
