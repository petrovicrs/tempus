
jQuery(document).ready(function() {

    loadMonitoringReporting();
});

function loadMonitoringReporting() {
    var $addMonitoringReportingLink = $('<a href="#" class="btn btn-add btn-success "><span aria-hidden="true"></span>add</a>');
    var $addMonitoringReportingLinkDiv = $('<li></li>').append($addMonitoringReportingLink);

    var $collectionHolder = $('ul.monitoring-reporting');

    $collectionHolder.find('li').each(function() {
        $addFormDeleteLink($(this));
    });

    $collectionHolder.append($addMonitoringReportingLinkDiv);
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addMonitoringReportingLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see code block below)
        $addForm($collectionHolder, $addMonitoringReportingLinkDiv);
    });
}

function $addFormDeleteLink($formDiv) {
    var $removeFormA = $('<a href="#">delete</a>');
    $formDiv.append($removeFormA);

    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the tag form
        $formDiv.remove();
    });
}

function $addForm($collectionHolder, $addLinkDiv) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormDiv = $('<li></li>').append(newForm);

    // also add a remove button, just for this example
    $newFormDiv.append('<a href="#" class="btn btn-remove btn-danger"><span aria-hidden="true"></span>remove</a>');

    $addLinkDiv.before($newFormDiv);

    // handle the removal, just for this example
    $('.btn-remove').click(function(e) {
        e.preventDefault();

        $(this).parent().remove();

        return false;
    });
}