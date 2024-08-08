let corrects = [];
let mistakes = [];

function dragoverHandler(ev) {
    ev.preventDefault();
    ev.dataTransfer.dropEffect = "move";
}

function dropHandler(ev) {
    ev.preventDefault();
    const data = ev.dataTransfer.getData("text/plain");
    const draggedElement = document.getElementById(data);
    let canDrop = true;

    if (ev.target.classList.contains('row-drag')) {
        let numberRows = jQuery('#' + ev.target.id).parent().find('.row-drag');

        if (numberRows.length > 0) {
            canDrop = false;
        }
    } else if(ev.target.classList.contains('result')) {
        let numberRows = jQuery('#' + ev.target.id).find('.row-drag');

        if (numberRows.length > 0) {
            canDrop = false;
        }
    }

    // Check if the target is a valid drop zone and not a draggable element
    if (canDrop) {
        ev.target.appendChild(draggedElement);

        checkDropZones();
    }
}

function dragstartHandler(ev) {
    // Add the target element's id to the data transfer object
    ev.dataTransfer.setData("text/plain", ev.target.id);
    ev.dataTransfer.effectAllowed = "move";
}

function checkDropZones() {
    let dropZones = document.querySelectorAll('.drop-zone');
    let correct = true;
    let firstValue = 0;
    let secondValue = 0;
    let betweenValue = '';
    let answer = 0;

    // Check if all drop zones have a draggable element
    dropZones.forEach(dropZone => {
        if (dropZone.children.length === 0) {
            correct = false;
        } else {
            if (dropZone.id === 'dropZone1') {
                firstValue = parseInt(dropZone.children[0].innerText);
            } else if (dropZone.id === 'dropZone2') {
                betweenValue = dropZone.children[0].innerText;
            } else if (dropZone.id === 'dropZone3') {
                secondValue = parseInt(dropZone.children[0].innerText);
            } else if (dropZone.id === 'dropZone4') {
                answer = parseInt(dropZone.children[0].innerText);
            }
        }
    });

    if (!correct) {
        return;
    }

    let result = 0;

    switch (betweenValue) {
        case '+':
            result = firstValue + secondValue;
            break;
        case '-':
            result = firstValue - secondValue;
            break;
        case '*':
            result = firstValue * secondValue;
            break;
        case '/':
            result = firstValue / secondValue;
            break;
    }

    if (result === answer) {
        dropZones.forEach(dropZone => {
            dropZone.children[0].classList.add('correct');
        });

        corrects.push({
            firstValue: firstValue,
            betweenValue: betweenValue,
            secondValue: secondValue,
            answer: answer
        });
    } else {
        dropZones.forEach(dropZone => {
            dropZone.children[0].classList.add('mistake');
        });

        mistakes.push({
            firstValue: firstValue,
            betweenValue: betweenValue,
            secondValue: secondValue,
            answer: answer
        });
    }

    if (corrects.length + mistakes.length === 3) {
        document.querySelectorAll('.finish-game')[0].click();
    }

    removeItems();

}

function removeItems() {
    let dropZones = document.querySelectorAll('.drop-zone');

    setTimeout(function () {
        dropZones.forEach(dropZone => {
            if (dropZone.children.length > 0) {
                dropZone.children[0].remove();
            }
        });
    }, 500);
}

function finishGame(url) {
    $.ajax({
        url: url,
        type: 'POST',
        data: {
            mistakes: mistakes,
            corrects: corrects
        },
        success: function (response) {
            if (response.success) {
                window.location.href = response.url;
            }
        }
    });
}