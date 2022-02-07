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

        addCartFromList(name, price) {
            let items = this.carts.filter(cart => cart.name === name && cart.price === price);
            if (items.length) {
                return items[0].amount++;
            }

            this.carts.push({
                id: Date.now(),
                name: name,
                price: price,
                amount: 1
            });
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
