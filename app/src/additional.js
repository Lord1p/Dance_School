function hideByID(id) {
    if (!id)
        throw "no Id specified";
    let element = document.getElementById(id);
    let classValue = element.attributes.getNamedItem('class').value;
    let attributes = classValue.split(' ');
    console.dir(attributes);
    let i;
    if (~(i = attributes.indexOf('show'))) {
        attributes[i] = 'hide';
    } else {
        attributes.push('hide');
    }

    element.setAttribute('class', attributes.join(' '));
}

function showById(id) {
    if (!id)
        throw "no Id specified";
    let element = document.getElementById(id);
    let classValue = element.attributes.getNamedItem('class').value;
    let attributes = classValue.split(' ');
    let i;
    if (~(i = attributes.indexOf('hide'))) {
        attributes[i] = 'show';
    } else {
        attributes.push('show');
    }

    element.setAttribute('class', attributes.join(' '));
}

hideByID('account');
hideByID('myCourses');