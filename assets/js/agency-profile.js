const tabs = document.querySelectorAll('[data-tab-target]')
// const tabContents = document.querySelectorAll('[data-tab-content]')
const tabContents = document.querySelectorAll('.data-tab-content')

tabs.forEach(tab => {
    tab.addEventListener('click', () => {
        const target = document.querySelector(tab.dataset.tabTarget)
        tabContents.forEach(tabContent => {
            tabContent.classList.remove('active')
        })
        tabs.forEach(tab => {
            tab.classList.remove('active')
        })
        tab.classList.add('active')
        target.classList.add('active')
    })
})

const editBtn = document.querySelectorAll('.col-edit');
var previousValue;
var currValue;

function resetElements() {
    editBtn.forEach(edits => {
        const editF = edits.previousElementSibling;
        const saveB = edits.nextElementSibling;
        editF.previousElementSibling.classList.add('active');
        editF.classList.remove('active');
        edits.classList.add('active');
        saveB.classList.remove('active');
        previousValue = "";
        currValue = "";
    })
}

editBtn.forEach(edit => {
    edit.addEventListener('click', () => {
        resetElements();
        const editField = edit.previousElementSibling;
        const saveBtn = edit.nextElementSibling;
        previousValue = editField.previousElementSibling.childNodes[0].nodeValue;

        editField.previousElementSibling.classList.remove('active');
        editField.childNodes[1].value = previousValue;
        editField.classList.add('active');

        edit.classList.remove('active');
        saveBtn.classList.add('active');
    })
})

const saveBtn = document.querySelectorAll('.col-save');
const saveChBtn = document.getElementById('save-ch-btn');
saveBtn.forEach(save => {
    save.addEventListener('click', () => {
        const editBtn = save.previousElementSibling;
        const editField = editBtn.previousElementSibling;
        const valueCell = editField.previousElementSibling;
        currValue = editField.childNodes[1].value;

        save.classList.remove('active');
        editBtn.classList.add('active');
        editField.classList.remove('active');
        valueCell.classList.add('active');
        valueCell.innerHTML = currValue;


        if (currValue.length === 0) {
            alert("ERROR. Empty Field");
            valueCell.innerHTML = previousValue;
        } else if (previousValue != currValue) {
            saveChBtn.classList.add('active');
        } else {
            saveChBtn.classList.remove('active');
        }
    })
})

const editDescBtn = document.getElementById('edit-desc-btn');
const saveDescBtn = document.getElementById('save-desc-btn');
const descBody = document.getElementById('desc-body');
const descEdit = document.getElementById('desc-textarea');

editDescBtn.addEventListener('click', () => {
    descBody.classList.remove('active');
    descEdit.classList.add('active');
    previousValue = descBody.firstChild.nodeValue;
    descEdit.innerHTML = previousValue;
    editDescBtn.classList.remove('active');
    saveDescBtn.classList.add('active');
})

saveDescBtn.addEventListener('click', () => {
    descBody.classList.add('active');
    descEdit.classList.remove('active');
    currValue = descEdit.value;
    descBody.innerHTML = currValue;
    editDescBtn.classList.add('active');
    saveDescBtn.classList.remove('active');

    if (currValue.length === 0) {
        alert("ERROR. Empty Field");
        descBody.innerHTML = previousValue;
        descEdit.inn = previousValue;
    } else if (previousValue != currValue) {
        saveChBtn.classList.add('active');
    } else {
        saveChBtn.classList.remove('active');
    }
})