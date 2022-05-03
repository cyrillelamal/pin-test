import {Product} from "./Product";
import {Data} from "./Data";

export class Form extends HTMLElement {
    /**
     * Custom attributes.
     * @private {Data}
     */
    _data;

    constructor() {
        super();

        this._data = new Data(this.querySelector('.js-product-data'));
    }

    /**
     * Get the form data.
     * @return {Product}
     */
    collect() {
        return new Product({
            article: this.article,
            name: this.name,
            status: this.status,
            data: this.data,
        });
    }

    // reset() {
    //     this.querySelector('input[name="article"]').value = '';
    //     this.querySelector('input[name="name"]').value = '';
    //     this.querySelector('select[name="status"] option[selected]').selected = true;
    //
    //     this._data.reset();
    //
    //     return this;
    // }

    get article() {
        return this.querySelector('input[name="article"]').value;
    }

    get name() {
        return this.querySelector('input[name="name"]').value;
    }

    get status() {
        return this.querySelector('select[name="status"]').value;
    }

    get data() {
        return this._data.collect();
    }
}
