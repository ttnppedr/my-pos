require('./bootstrap');

import Alpine from 'alpinejs';
import carts from './carts';

Alpine.data('carts', carts);

Alpine.start();
