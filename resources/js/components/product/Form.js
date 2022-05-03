import {displayElement, hideElement, shutUpEvent} from "../../dom-utils";
import {Product} from "./Product";
import {Data} from "./Data";

/**
 * Rather form controls because it controls the button and the form.
 * TODO: rename and refactor.
 */
export class Form extends HTMLElement {
    constructor() {
        super();

        this._showFormButton = this.querySelector('.js-show');
        this._showFormButton.addEventListener('click', this.#show);

        this._form = this.querySelector('form');
        hideElement(this._form);
        this._data = new Data(this._form.querySelector('.js-product-data')).handle();

        this.querySelector('.js-hide').addEventListener('click', this.#hide);

        this.addEventListener('submit', this.#submit);
    }

    /**
     * Get the form data
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
    //     this._form.querySelector('input[name="article"]').value = '';
    //     this._form.querySelector('input[name="name"]').value = '';
    //     this._form.querySelector('select[name="status"] option[selected]').selected = true;
    //
    //     this._data.reset();
    //
    //     return this;
    // }

    get article() {
        return this._form.querySelector('input[name="article"]').value;
    }

    get name() {
        return this._form.querySelector('input[name="name"]').value;
    }

    get status() {
        return this._form.querySelector('select[name="status"]').value;
    }

    get data() {
        return this._data.collect();
    }

    #submit = (evt) => {
        shutUpEvent(evt);

        axios.post('/products', this.collect())
            .then(() => location.reload()) // TODO: append row or sth else
            .catch(console.error); // TODO: indicate errors
    }

    #show = (evt) => {
        shutUpEvent(evt);

        hideElement(this._showFormButton);
        displayElement(this._form)
    }

    #hide = (evt) => {
        shutUpEvent(evt);

        hideElement(this._form);
        displayElement(this._showFormButton);
    }
}
