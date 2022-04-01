export default () => ({
    showNewProductModal: false,
    newProductName: null,
    newProductPrice: 300,
    test: true,
    carts: [],

    get totalPrice() {
        return this.carts.reduce((accumulator, cart) => {
            return accumulator + cart.price * cart.quantity;
        }, 0);
    },

    get canAddNewToCart() {
        return this.newProductName && this.newProductPrice;
    },

    get isCartEmpty() {
        return this.carts.length === 0;
    },

    addNewToCart() {
        let item = this.carts.find(cart => cart.name === this.newProductName && cart.price === +this.newProductPrice);
        if (item) {
            item.quantity++;
            this.closeNewProductModal();
            return;
        }

        this.carts.push({
            id: null,
            name: this.newProductName,
            price: this.newProductPrice,
            quantity: 1
        });

        this.closeNewProductModal();
    },

    addFromProductList(product) {
        let item = this.carts.find(cart => cart.name === product.name && cart.price === product.price);
        if (item) {
            this.closeNewProductModal();
            item.quantity++;
            return;
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
    },

    closeNewProductModal() {
        this.showNewProductModal = false;
        this.newProductName = null;
        this.newProductPrice = null;
    },

    clearCart() {
        this.carts = [];
    }
});
