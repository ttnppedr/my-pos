export default () => ({
    openNewItemModal: false,
    newCartName: '',
    newCartPrice: '',
    carts: [],

    get totalPrice() {
        return this.carts.reduce((accumulator, cart) => {
            return accumulator + cart.price * cart.quantity;
        }, 0);
    },

    addCart() {
        if (!this.newCartName || !this.newCartPrice) {
            this.openNewItemModal = false;
            return;
        }

        this.carts.push({
            id: null,
            name: this.newCartName,
            price: this.newCartPrice,
            quantity: 1
        });

        this.openNewItemModal = false;
        this.newCartName = '';
        this.newCartPrice = '';
    },

    addFromProductList(product) {
        let item = this.carts.find(cart => cart.name === product.name && cart.price === product.price);
        if (item) {
            return item.quantity++;
        }

        this.carts.push({
            id: product.id,
            name: product.name,
            price: product.price,
            quantity: 1
        });
    },

    cartPlus(cart) {
        cart.quantity++;
    },

    cartMinus(cart) {
        cart.quantity--;

        this.carts = this.carts.filter(cart => cart.quantity > 0);
    },

    cartRemove(cart) {
        this.carts = this.carts.filter(candidate => candidate !== cart);
    }
});
