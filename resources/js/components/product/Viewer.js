/**
 * Product viewer VM.
 */
export class Viewer extends HTMLElement {
    /**
     * Callback invoked when the user clicks on Edit button.
     * @param evt the original callback event.
     */
    edit = (evt) => evt;

    /**
     * Callback invoked when the user clicks on Destroy button.
     * @param evt the original callback event.
     */
    destroy = (evt) => evt;

    /**
     * Callback invoked when the user clicks on Hide button.
     * @param evt the original callback event.
     */
    hide = (evt) => evt;

    constructor() {
        super();

        this._articleFields = this.querySelectorAll('.js-product-article');
        this._nameFields = this.querySelectorAll('.js-product-name');
        this._statusFields = this.querySelectorAll('.js-product-status');
        this._dataFields = this.querySelectorAll('.js-product-data');

        this.querySelector('.js-edit').addEventListener('click', this.#edit);
        this.querySelector('.js-destroy').addEventListener('click', this.#destroy);
        this.querySelector('.js-hide').addEventListener('click', this.#hide);
    }

    /**
     * Display the product card.
     * @param {Product} product
     */
    display(product) {
        this._articleFields.forEach((field) => field.innerText = product.article);
        this._nameFields.forEach((field) => field.innerText = product.name);
        this._statusFields.forEach((field) => field.innerText = product.status);
        this._dataFields.forEach((field) => {
            field.innerHTML = '';
            for (const [key, value] of Object.entries(product.data)) {
                const pair = document.createElement('div');
                pair.innerText = `${key}: ${value}`;
                field.append(pair);
            }
        });
    }

    #edit = (evt) => this.edit(evt);

    #destroy = (evt) => this.destroy(evt);

    #hide = (evt) => this.hide(evt);
}
