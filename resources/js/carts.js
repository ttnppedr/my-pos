export default () => ({
    showNewProductModal: false,
    newProductName: null,
    newProductPrice: null,
    newProductNote: null,

    showProductModal: false,
    productId: null,
    productName: null,
    productPrice: null,
    productNote: null,

    carts: [],

    get totalPrice() {
        return this.carts.reduce((accumulator, cart) => {
            return accumulator + cart.price * cart.quantity;
        }, 0);
    },

    get canAddNewToCart() {
        return this.newProductName && this.newProductPrice;
    },

    get canAddToCart() {
        return this.productName && this.productPrice;
    },

    get isCartEmpty() {
        return this.carts.length === 0;
    },

    addNewToCart() {
        let item = this.carts.find(cart => cart.name === this.newProductName && cart.price === +this.newProductPrice && cart.note === this.newProductNote);
        if (item) {
            item.quantity++;
            this.closeNewProductModal();
            return;
        }

        this.carts.push({
            id: null,
            name: this.newProductName,
            price: this.newProductPrice,
            note: this.newProductNote,
            quantity: 1
        });

        this.closeNewProductModal();
    },

    addFromProductList() {
        let item = this.carts.find(cart => cart.name === this.productName && cart.price === this.productPrice && cart.note === this.productNote);
        if (item) {
            this.closeProductModal();
            item.quantity++;
            return;
        }

        this.carts.push({
            id: this.productId,
            name: this.productName,
            price: this.productPrice,
            note: this.productNote,
            quantity: 1
        });

        this.closeProductModal();
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

    openProductModal(product) {
        this.productId = product.id;
        this.productName = product.name;
        this.productPrice = product.price;
        this.productNote = null;
        this.showProductModal = true;
    },

    closeProductModal() {
        this.showProductModal = false;
        this.productName = null;
        this.productPrice = null;
        this.productNote = null;
    },

    closeNewProductModal() {
        this.showNewProductModal = false;
        this.newProductName = null;
        this.newProductPrice = null;
        this.newProductNote = null;
    },

    clearCart() {
        this.carts = [];
    }
});
