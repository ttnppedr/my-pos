export default () =>  ( {
        openNewItemModal: false,
        newCartName: '',
        newCartPrice: '',
        carts: [],

        addCart() {
            if (!this.newCartName || !this.newCartPrice) {
                this.openNewItemModal = false;
                return;
            }

            this.carts.push({
                id: Date.now(),
                name: this.newCartName,
                price: this.newCartPrice,
                amount: 1
            });

            this.openNewItemModal = false;
            this.newCartName = '';
            this.newCartPrice = '';
        },

        cartPlus(cart) {
            cart.amount++;
        },

        cartMinus(cart) {
            cart.amount--;

            if (cart.amount === 0) {
                let position = this.carts.indexOf(cart);
                this.carts.splice(position, 1);
            }
        }
});
