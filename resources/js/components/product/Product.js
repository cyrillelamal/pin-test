export class Product {
    /**
     * @type {Number|null}
     */
    id = null;
    article = '';
    name = '';
    status = '';
    data = {};

    static deserialize(json = '{}') {
        return new this(JSON.parse(json));
    }

    constructor(attributes = {}) {
        Object.assign(this, attributes);
    }
}
