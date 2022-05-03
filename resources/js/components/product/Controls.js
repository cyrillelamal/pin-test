import {displayElement, hideElement} from "../../dom-utils";

export class Controls extends HTMLElement {
    /**
     * @public {Viewer}
     */
    viewer;

    /**
     * @public {Editor}
     */
    editor;

    /**
     * @public {Form}
     */
    form;

    constructor() {
        super();

        this.viewer = this.querySelector('product-viewer');
        hideElement(this.viewer);

        this.editor = this.querySelector('product-editor');
        hideElement(this.editor);

        this.form = this.querySelector('new-product-form');
        displayElement(this.form)
    }

    /**
     * @param {Product} product
     */
    display(product) {
        hideElement(this.editor);
        hideElement(this.form);
        displayElement(this.viewer);

        this.viewer.display(product);

        return this;
    }

    /**
     * @param {Product} product
     */
    edit(product) {
        hideElement(this.viewer);
        hideElement(this.form);
        displayElement(this.editor);

        console.log(this.editor, product) // TODO: prefill data rows

        return this;
    }

    create() {
        hideElement(this.viewer);
        hideElement(this.editor);
        displayElement(this.form);

        return this;
    }
}
