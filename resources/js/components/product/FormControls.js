import {displayElement, hideElement, shutUpEvent} from "../../dom-utils";
import {Form} from "./Form";

/**
 * Rather form controls because it controls the button and the form.
 * TODO: rename and refactor.
 */
export class FormControls extends Form {
    constructor() {
        super();

        this._showFormButton = this.querySelector('.js-show');
        this._showFormButton.addEventListener('click', this.#show);

        this._form = this.querySelector('form');
        hideElement(this._form);

        this.querySelector('.js-hide').addEventListener('click', this.#hide);

        this.addEventListener('submit', this.#submit);
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
