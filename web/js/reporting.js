var $addReportingByLink = $('<a href="#" class="btn btn-add btn-success "><span aria-hidden="true"></span>add</a>');
var $addReportinkByLinkDiv = $('<li></li>').append($addReportingByLink);

jQuery(document).ready(function() {
    // Get the ul that holds the collection of tags
    var $collectionReportingByHolder = $('ul.reporting-by');

    // add a delete link to all of the existing tag form li elements
    $collectionReportingByHolder.find('li').each(function() {
        $addReportingByFormDeleteLink($(this));
    });

    // add the "add a tag" anchor and li to the tags ul
    $collectionReportingByHolder.append($addReportinkByLinkDiv);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionReportingByHolder.data('index', $collectionReportingByHolder.find(':input').length);

    $addReportingByLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see code block below)
        $addReportingByForm($collectionReportingByHolder, $addReportinkByLinkDiv);
    });
});

function $addReportingByForm($collectionReportingByHolder, $addReportinkByLinkDiv) {
    // Get the data-prototype explained earlier
    var prototype = $collectionReportingByHolder.data('prototype');

    // get the new index
    var index = $collectionReportingByHolder.data('index');

    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionReportingByHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormDiv = $('<li></li>').append(newForm);

    // also add a remove button, just for this example
    $newFormDiv.append('<a href="#" class="btn btn-remove btn-danger"><span aria-hidden="true"></span>remove</a>');

    $addReportinkByLinkDiv.before($newFormDiv);

    // handle the removal, just for this example
    $('.btn-remove').click(function(e) {
        e.preventDefault();

        $(this).parent().remove();

        return false;
    });
}

function $addReportingByFormDeleteLink($reportingByFormDiv) {
    var $removeFormA = $('<a href="#">delete</a>');
    $reportingByFormDiv.append($removeFormA);

    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the tag form
        $reportingByFormDiv.remove();
    });
}