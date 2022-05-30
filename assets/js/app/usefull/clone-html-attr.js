const cloneAttributes = (target, source) => {
    [...source.attributes].forEach(attr => {
        target.setAttribute(attr.nodeName, attr.nodeValue)
    })

    if (source.innerHTML != '') {
        target.innerHTML = source.innerHTML;
    }

    return target;
}

export default cloneAttributes;