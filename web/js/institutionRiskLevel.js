var $addRiskLevelLink = $('<a href="#" class="btn btn-add btn-success "><span aria-hidden="true"></span>add risk level</a>');
var $addRiskLevelLinkDiv = $('<li></li>').append($addRiskLevelLink);

jQuery(document).ready(function() {
    // Get the ul that holds the collection of tags
    var $collectionRiskLevelHolder = $('ul.riskLevel');

    // add a delete link to all of the existing tag form li elements
    $collectionRiskLevelHolder.find('li').each(function() {
        $addRiskLevelFormDeleteLink($(this));
    });

    // add the "add a tag" anchor and li to the tags ul
    $collectionRiskLevelHolder.append($addRiskLevelLinkDiv);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionRiskLevelHolder.data('index', $collectionRiskLevelHolder.find(':input').length);

    $addRiskLevelLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see code block below)
        $addRiskLevelForm($collectionRiskLevelHolder, $addRiskLevelLinkDiv);
    });
});

function $addRiskLevelForm($collectionRiskLevelHolder, $addRiskLevelLinkDiv) {
    // Get the data-prototype explained earlier
    var prototype = $collectionRiskLevelHolder.data('prototype');

    // get the new index
    var index = $collectionRiskLevelHolder.data('index');

    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionRiskLevelHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormDiv = $('<li></li>').append(newForm);

    // also add a remove button, just for this example
    $newFormDiv.append('<a href="#" class="btn btn-remove btn-danger"><span aria-hidden="true"></span>remove risk level</a>');

    $addRiskLevelLinkDiv.before($newFormDiv);

    // handle the removal, just for this example
    $('.btn-remove').click(function(e) {
        e.preventDefault();

        $(this).parent().remove();

        return false;
    });
}

function $addRiskLevelFormDeleteLink($contactFormDiv) {
    var $removeFormA = $('<a href="#">delete this risk level</a>');
    $contactFormDiv.append($removeFormA);

    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the tag form
        $contactFormDiv.remove();
    });
}