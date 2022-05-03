/**
 * MV for data lists of products.
 * Data lists are also known as product attributes.
 */
import {shutUpEvent} from "../../dom-utils";

export class Data {
    /**
     * You have to activate the element via the method handle.
     *
     * @param {HTMLElement} container data field container.
     * Each container must provide three components:
     * 1. ".js-container": the place where new attributes are appended.
     * 2. ".js-more": the button used to request more attribute rows.
     * 3. ".js-row-template": used as template for new attribute rows.
     */
    constructor(container) {
        this._moreDataButton = container.querySelector('.js-more');
        this._rowContainer = container.querySelector('.js-container');

        this._rowTemplate = container.querySelector('.js-row-template');
    }

    /**
     * Activate the element.
     */
    handle() {
        this._moreDataButton.addEventListener('click', this.addEmptyRow);

        // TODO: prefill row

        return this;
    }

    addEmptyRow = (evt = undefined) => {
        shutUpEvent(evt);

        return this.addRow();
    }

    addRow(key = '', value = '') {
        const row = this._rowTemplate.cloneNode(true);

        row.querySelector('input[name="key[]"]').value = key;
        row.querySelector('input[name="value[]"]').value = value;

        row.classList.remove('js-row-template');

        this.#handleRemoveRow(row);

        this._rowContainer.append(row);

        return this;
    }

    /**
     * Get the input data.
     * @return {{}} key-value pairs.
     */
    collect() {
        const data = {};

        const keys = this._rowContainer.querySelectorAll('input[name="key[]"]');
        const values = this._rowContainer.querySelectorAll('input[name="value[]"]');

        for (let i = 0; i < keys.length; i++) {
            data[keys[i].value] = values[i].value; // FIXME: if key value is a number string it's serialized incorrectly.
        }

        return data;
    }

    reset() {
        this._rowContainer.querySelectorAll('.js-row').forEach(row => row.remove());

        return this;
    }

    #handleRemoveRow(row) {
        row.querySelector('.js-less').addEventListener('click', (evt) => {
            shutUpEvent(evt);
            row.remove();
        });
    }
}
