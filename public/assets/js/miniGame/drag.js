jQuery(document).ready(function($) {
    // $('.row-drag').each(function() {
    //     const element = document.getElementById($(this).attr('id'));
    //     // Add the ondragstart event listener
    //     element.addEventListener("dragstart", dragstartHandler);
    // });

    // $('.row-drag').on('drop', function(e) {
    //     e.preventDefault();
    //     // add this line
    //     $(this).off('dragover drop');
    // });
});

function dragoverHandler(ev) {
    ev.preventDefault();
    ev.dataTransfer.dropEffect = "move";
}

function dropHandler(ev) {
    ev.preventDefault();
    // Get the id of the target and add the moved element to the target's DOM
    const data = ev.dataTransfer.getData("text/plain");
    ev.target.appendChild(document.getElementById(data));
}

function dragstartHandler(ev) {
    // Add the target element's id to the data transfer object
    ev.dataTransfer.setData("text/plain", ev.target.id);
    ev.dataTransfer.effectAllowed = "move";
}