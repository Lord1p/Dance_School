function hideByID(id) {
    if (!id)
        throw "no Id specified";
    let element = document.getElementById(id);
    let classValue = element.attributes.getNamedItem('class').value;
    let attributes = classValue.split(' ');
    dellClass(attributes);
    attributes.push('hide');
    element.setAttribute('class', attributes.join(' '));
}

function showById(id) {
    if (!id)
        throw "no Id specified";
    let element = document.getElementById(id);
    let classValue = element.attributes.getNamedItem('class').value;
    let attributes = classValue.split(' ');
    dellClass(attributes);
    attributes.push('show');
    element.setAttribute('class', attributes.join(' '));
}

function dellClass(classes) {
    let deletionIndexes = [];
    for (let i = 0; i < classes.length; ++i) {
        if (classes[i] == 'hide' || classes[i] == 'show') {
            deletionIndexes.push(i);
        }
    }

    for (let i of deletionIndexes) {
        classes.splice(i, 1);
    }
}

hideByID('account');
