export function shutUpEvent(evt) {
    evt && evt.preventDefault();
    evt && evt.stopPropagation();
}

/**
 * Provide the function as callback receiving events.
 * It stops event propagation and default behavior and executes your callback.
 * @param {Function} f
 * @return {function(*): *}
 */
export function shutUpEventAnd(f) {
    return (evt) => {
        shutUpEvent(evt);
        return f();
    }
}

/**
 * Make an HTML element visible in DOM.
 * @param {HTMLElement} element
 * @param {String} hidden class indicating hidden elements.
 */
export function displayElement(element, hidden = 'hidden') {
    element.classList.remove(hidden);
    return element;
}

/**
 * Make an HTML element invisible in DOM.
 * @param {HTMLElement} element
 * @param {String} hidden class indicating hidden elements.
 */
export function hideElement(element, hidden = 'hidden') {
    element.classList.add(hidden);
    return element;
}
