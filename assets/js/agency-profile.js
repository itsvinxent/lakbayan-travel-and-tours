const tabs = document.querySelectorAll('[data-tab-target]')
// const tabContents = document.querySelectorAll('[data-tab-content]')
const tabContents = document.querySelectorAll('.data-tab-content')
const saveChBtn = document.getElementById('save-ch-btn');
var editcount = 0;

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

        if (tab == document.getElementById('pack-active') || 
        tab == document.getElementById('sub-pack-active') ||
        tab == document.getElementById('sub-book-active')) {
            document.getElementById('tab-content').classList.add('pack-active')
        } else {
            document.getElementById('tab-content').classList.remove('pack-active')
        }
        if (tab != document.getElementById('acc-active')) {
            saveChBtn.style.display = "none";
        } else {
            checkeditcount();
        }
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

// For displaying the correct button (Edit or Save)
editBtn.forEach(edit => {
    edit.addEventListener('click', () => {
        resetElements();
        const editField = edit.previousElementSibling;
        const saveBtn = edit.nextElementSibling;
        if (editField.previousElementSibling.childNodes[1] != undefined) {
            previousValue = editField.previousElementSibling.childNodes[1].innerHTML;
        } else {
            previousValue = editField.previousElementSibling.childNodes[0].innerHTML;   
        }
        editField.previousElementSibling.classList.remove('active');
        if (editField.childNodes[1] === document.getElementById('bday')) {
            flatpickr("#bday", {
                dateFormat: "m-d-Y",
                defaultDate: previousValue
            });
        } else {
            editField.childNodes[1].value = previousValue;
        }
        editField.classList.add('active');

        edit.classList.remove('active');
        saveBtn.classList.add('active');
    })
})

const saveBtn = document.querySelectorAll('.col-save');

function checkeditcount() {
    if (editcount > 0) {
        saveChBtn.style.display = "block";
    } else {
        saveChBtn.style.display = "none";
    }
}

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
        if(valueCell.childNodes[1] != undefined) {
            valueCell.childNodes[1].innerHTML = currValue;
        } else {
            valueCell.childNodes[0].innerHTML = currValue;
        }


        if (currValue.length === 0) {
            alert("ERROR. Empty Field");
            if(valueCell.childNodes[1] != undefined) {
                valueCell.childNodes[1].innerHTML = previousValue;
            } else {
                valueCell.childNodes[0].innerHTML = previousValue;
            }
        } else if (editField.children[1].value != currValue) {
            editcount++;
        } else {      
            editcount === 0 ? editcount = 0 : editcount--;
        }

        checkeditcount();
    })
})


const editDescBtn = document.getElementById('edit-desc-btn');
const saveDescBtn = document.getElementById('save-desc-btn');
const descBody = document.getElementById('desc-body');
const descEdit = document.getElementById('desc-textarea');
if (editDescBtn != undefined) {
    editDescBtn.addEventListener('click', () => {
        descBody.classList.remove('active');
        descEdit.classList.add('active');
        descEdit.innerHTML = descEdit.nextElementSibling.value;
        editDescBtn.classList.remove('active');
        saveDescBtn.classList.add('active');
    });
}
if (saveDescBtn != undefined) {
    saveDescBtn.addEventListener('click', () => {
        descBody.classList.add('active');
        descEdit.classList.remove('active');
        currValue = descEdit.value;
        descBody.innerHTML = currValue;
        editDescBtn.classList.add('active');
        saveDescBtn.classList.remove('active');

        if (currValue.length === 0) {
            alert("ERROR. Empty Field");
            descBody.innerHTML = descEdit.nextElementSibling.value;
            descEdit.value = descEdit.nextElementSibling.value;
        } else if (descEdit.nextElementSibling.value != currValue) {
            editcount++;   
        } else {      
            editcount === 0 ? editcount = 0 : editcount--;
        }

        checkeditcount();
    });
}

// Image Upload Preview
$('#aPicture').on('change', function(e) {
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function(event) {
            $('#img-pic').attr('src', event.target.result);
        }
        reader.readAsDataURL(this.files[0]);
        $('#picturefile').val(e.target.value.split('\\').pop());
        editcount++;
        checkeditcount();
    }
});

$('#aBanner').on('change', function(e) {
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function(event) {
            $('#img-banner').attr('src', event.target.result);
        }
        reader.readAsDataURL(this.files[0]);
        // $('#bannerfile').val(e.target.value.split('\\').pop());
        editcount++;
        checkeditcount();
    }
});

// Reset Form My Account Form
$(document.querySelector('.discardform-btn')).on('click', function(e) {
    var rows = document.querySelectorAll('#info .row');

    rows.forEach(row => {
        console.log(row.children[1].children[0].innerHTML)

        // if (row.children[1].children[1] === undefined) {
            row.children[1].children[0].innerHTML = row.children[2].children[1].value;
        // } else {
        //     row.children[1].children[1].innerHTML = row.children[2].children[1].value;
        // }

    });
    editcount = 0;
    checkeditcount();

});


// Calendars
var durations = [], duration = [], dates = [];
var cutoff, cutoffObj;

flatpickr("input[type=date-local]", {
    altInput: true,
    altFormat: "D, F j, Y h:i K",
    dateFormat: "m-d-Y H:i:S",
    minDate: "today",
    mode: "range",
    enableTime: true,
    onChange: function (selectedDates, dateStr, instance) {
        $('.right .flatpickr-innerContainer').css("pointer-events", "all");
        dates.length = 0;
        durations.length = 0;
        dates.push(cutoff);
        selectedDates.forEach(element => {
            dates.push(element);
            durations.push(element);
        });
        flatpickr("#date-display", {
            monthSelectorType: "static",
            yearSelectorType: "static",
            minDate: "today",
            mode: "multiple",
            defaultDate: dates,
            inline: true
        });

        if (duration.length === 2) {
            duration.length = 0;
        }
        duration.push(instance.selectedDateElem.innerHTML);

        $('.right .flatpickr-innerContainer .selected').each(function () {
            if (duration.includes($(this)[0].innerHTML)) {
                $(this).addClass("duration");
            }
            if (cutoffObj === $(this)[0].innerHTML) {
                $(this).addClass("cutoff");
            }
        });
        $('.right .flatpickr-innerContainer').css("pointer-events", "none");
    }
});

flatpickr("input[type=datetime-local]", {
    altInput: true,
    altFormat: "D, F j, Y h:i K",
    dateFormat: "m-d-Y H:i:S",
    minDate: "today",
    enableTime: true,
    mode: "single",
    onChange: function (selectedDates, dateStr, instance) {
        $('.right .flatpickr-innerContainer').css("pointer-events", "all");
        dates.length = 0;
        cutoff = selectedDates[0];
        durations.forEach(element => {
            dates.push(element);
        });
        dates.push(cutoff);
        flatpickr("#date-display", {
            monthSelectorType: "static",
            yearSelectorType: "static",
            minDate: "today",
            mode: "multiple",
            defaultDate: dates,
            inline: true

        });
        cutoffObj = instance.selectedDateElem.innerHTML;
        $('.right .flatpickr-innerContainer .selected').each(function () {
            if (duration.includes($(this)[0].innerHTML)) {
                $(this).addClass("duration");
            }
            if (cutoffObj === $(this)[0].innerHTML) {
                $(this).addClass("cutoff");
            }
        });
        $('.right .flatpickr-innerContainer').css("pointer-events", "none");
    }
});

$(document).ready(function() {
    $('.right .flatpickr-innerContainer').css("pointer-events", "none");
});

flatpickr("#date-display", {
    monthSelectorType: "static",
    yearSelectorType: "static",
    dateFormat: "D, M d Y h:i K",
    minDate: "today",
    mode: "multiple",
    inline: true
});

// File Upload Labels
var inputs = document.querySelectorAll('.inputfile');
Array.prototype.forEach.call(inputs, function (input) {
    

    input.addEventListener('change', function (e) {
        // label.style.display = none;
        // input.style.display = block;
        var label = input.nextElementSibling.nextElementSibling.nextElementSibling,
        labelVal = label.nextElementSibling.value;
        console.log("detected");
        var fileName = e.target.value.split('\\').pop();
        if (fileName) {
            label.innerHTML = fileName;
            // console.log(input.nextElementSibling)
            // console.log(input.nextElementSibling.children[1])
            input.nextElementSibling.style.display = "none";
            input.nextElementSibling.nextElementSibling.style.display = "flex";
        }
        else
            label.innerHTML = labelVal;
    });
});

var removeupload = document.querySelectorAll('.uploaded');
removeupload.forEach(remover => {
    $(remover).click(function (e) { 
        var target = this.previousElementSibling.previousElementSibling;
        console.log(target);
        $(target).val('');
        this.previousElementSibling.style.display = "flex"
        this.nextElementSibling.innerHTML = this.nextElementSibling.nextElementSibling.value;
        this.style.display = "none";
    });
})