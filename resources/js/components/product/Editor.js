export class Editor extends HTMLElement {
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

    #hide = (evt) => this.hide(evt);

    #submit = (evt) => this.submit(evt);
}
