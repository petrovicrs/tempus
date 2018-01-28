
jQuery(document).ready(load);
jQuery(document).ajaxComplete(load);

function load() {
    var $addProjectContactPersonLink = $('<a href="#" class="btn btn-add btn-success "><span aria-hidden="true"></span>add contact person</a>');
    var $addProjectContactPersonLinkDiv = $('<li></li>').append($addProjectContactPersonLink);
    // Get the ul that holds the collection of tags
    var $collectionProjectContactPersonHolder = $('ul.contactPersons');

    // add a delete link to all of the existing tag form li elements
    $collectionProjectContactPersonHolder.find('li').each(function() {
        $addProjectContactPersonFormDeleteLink($(this));
    });

    // add the "add a tag" anchor and li to the tags ul
    $collectionProjectContactPersonHolder.append($addProjectContactPersonLinkDiv);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionProjectContactPersonHolder.data('index', $collectionProjectContactPersonHolder.find(':input').length);

    $addProjectContactPersonLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see code block below)
        $addProjectContactPersonForm($collectionProjectContactPersonHolder, $addProjectContactPersonLinkDiv);
    });
}

function $addProjectContactPersonForm($collectionProjectContactPersonHolder, $addProjectContactPersonLinkDiv) {
    // Get the data-prototype explained earlier
    var prototype = $collectionProjectContactPersonHolder.data('prototype');

    // get the new index
    var index = $collectionProjectContactPersonHolder.data('index');

    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionProjectContactPersonHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormDiv = $('<li></li>').append(newForm);

    // also add a remove button, just for this example
    $newFormDiv.append('<a href="#" class="btn btn-remove btn-danger"><span aria-hidden="true"></span>remove contact person</a>');

    $addProjectContactPersonLinkDiv.before($newFormDiv);

    // handle the removal, just for this example
    $('.btn-remove').click(function(e) {
        e.preventDefault();

        $(this).parent().remove();

        return false;
    });
}

function $addProjectContactPersonFormDeleteLink($contactFormDiv) {
    var $removeFormA = $('<a href="#" class="btn btn-remove btn-danger"><span aria-hidden="true"></span>remove contact person</a>');
    $contactFormDiv.append($removeFormA);

    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the tag form
        $contactFormDiv.remove();
    });
}