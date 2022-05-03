import {Product} from "./Product";
import {Form} from "./Form";

export class Editor extends Form {
    /**
     * Callback invoked when the user clicks on Hide button.
     * @param evt the original callback event.
     */
    hide = (evt) => evt;

    /**
     * Callback invoked when the edit form is submitted.
     * @param evt the original callback event.
     */
    submit = (evt) => evt;

    constructor() {
        super();

        this.querySelector('.js-hide').addEventListener('click', this.#hide);
        this.querySelector('button[type="submit"]').addEventListener('click', this.#submit);
    }

    /**
     * @param {Product} product
     */
    fill(product) {
        this.querySelector('input[name="article"]').value = product.article;
        this.querySelector('input[name="name"]').value = product.name;
        this.querySelector('select[name="status"]').value = product.status_value;

        this._data.reset();

        for (const [key, value] of Object.entries(product.data)) {
            this._data.addRow(key, value);
        }
    }

    #hide = (evt) => this.hide(evt);

    #submit = (evt) => this.submit(evt);
}
