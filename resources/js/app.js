require('./bootstrap');

const {Viewer} = require("./components/product/Viewer");
const {Controls} = require("./components/product/Controls");
const {Product} = require("./components/product/Product");
const {shutUpEvent} = require("./dom-utils");
const {Editor} = require("./components/product/Editor");
const {Form} = require("./components/product/Form");


customElements.define('product-controls', Controls);
customElements.define('product-viewer', Viewer);
customElements.define('product-editor', Editor);
customElements.define('new-product-form', Form);

/**
 * @type {Controls}
 */
const controls = document.querySelector('product-controls');

document.querySelectorAll('.js-product-row').forEach((row) => {
    row.addEventListener('click', evt => {
        shutUpEvent(evt);

        const product = Product.deserialize(row.dataset.product);

        controls.display(product);

        controls.viewer.hide = (evt) => {
            shutUpEvent(evt);
            controls.create();
        };
        controls.viewer.edit = (evt) => {
            shutUpEvent(evt);
            controls.edit(product);
        }
        controls.viewer.destroy = (evt) => {
            shutUpEvent(evt);
            axios.delete(`/products/${product.id}`)
                .then(() => location.reload())
                .catch(console.error);
        };

        controls.editor.hide = (evt) => {
            shutUpEvent(evt);
            controls.create();
        }
    });
});

