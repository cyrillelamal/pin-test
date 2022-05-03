export function shutUpEvent(evt) {
    evt && evt.preventDefault();
    evt && evt.stopPropagation();
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
