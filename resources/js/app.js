require('./bootstrap');

const {Viewer} = require("./components/product/Viewer");
const {Controls} = require("./components/product/Controls");
const {Product} = require("./components/product/Product");
const {shutUpEvent, shutUpEventAnd} = require("./dom-utils");
const {Editor} = require("./components/product/Editor");
const {FormControls} = require("./components/product/FormControls");


customElements.define('product-controls', Controls);
customElements.define('product-viewer', Viewer);
customElements.define('product-editor', Editor);
customElements.define('new-product-form', FormControls);

/**
 * @type {Controls}
 */
const controls = document.querySelector('product-controls');

document.querySelectorAll('.js-product-row').forEach((row) => {
    row.addEventListener('click', evt => {
        shutUpEvent(evt);

        const product = Product.deserialize(row.dataset.product);

        controls.display(product);

        controls.viewer.hide = shutUpEventAnd(() => controls.create());
        controls.viewer.edit = shutUpEventAnd(() => controls.edit(product));
        controls.viewer.destroy = shutUpEventAnd(
            () => axios.delete(`/products/${product.id}`)
                .then(() => location.reload())
                .catch(console.error)
        );

        controls.editor.hide = shutUpEventAnd(() => controls.create());
        controls.editor.submit = shutUpEventAnd(
            () => axios.patch(`/products/${product.id}`, controls.editor.collect())
                .then(() => location.reload())
                .catch(console.error)
        );
    });
});

