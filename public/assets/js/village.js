function dragstartHandler(ev) {
    // Add the target element's id to the data transfer object
    ev.dataTransfer.setData("text/plain", ev.target.id);
    ev.dataTransfer.effectAllowed = "copy";
}

function dragoverHandler(ev) {
    ev.preventDefault();
    ev.dataTransfer.dropEffect = "copy";
}

function dropHandler(ev) {
    ev.preventDefault();
    const data = ev.dataTransfer.getData("text/plain");
    const draggedElement = document.getElementById(data);
    let canDrop = true;

    if (ev.target.classList.contains('row-drag')) {
        let numberRows = jQuery('#' + ev.target.id).parent().find('.village-building-item');

        if (numberRows.length > 0) {
            canDrop = false;
        }
    } else if(ev.target.classList.contains('result')) {
        let numberRows = jQuery('#' + ev.target.id).find('.village-building-item');

        if (numberRows.length > 0) {
            canDrop = false;
        }
    }

    // Check if the target is a valid drop zone and not a draggable element
    if (canDrop) {
        buildBuilding(draggedElement.id, ev.target.dataset.position);
    }
}

function buildBuilding(buildingName, position) {
    let url = jQuery('.positions-container').data('url');

    $.ajax({
        url: url,
        type: 'POST',
        data: {
            building: buildingName,
            position: position
        },
        success: function (response) {
            if (response.success) {
                location.reload();
            } else {
                alert(response.message);
            }
        }
    });
}