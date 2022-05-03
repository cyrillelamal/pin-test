export class Product {
    /**
     * @type {Number|null}
     */
    id = null;
    article = '';
    name = '';
    /**
     * Status displayed to the user.
     * @type {string}
     */
    status = '';
    data = {};

    /**
     * Status used as select value.
     * @type {string}
     */
    status_value = 'available';

    static deserialize(json = '{}', attributes = {}) {
        return new this(Object.assign(JSON.parse(json), attributes));
    }

    constructor(attributes = {}) {
        Object.assign(this, attributes);
    }
}
