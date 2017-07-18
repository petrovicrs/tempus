var $addContactLink = $('<a href="#" class="btn btn-add btn-success "><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>');
var $newContactLinkDiv = $('<li></li>').append($addContactLink);

jQuery(document).ready(function() {
    // Get the ul that holds the collection of tags
    var $collectionContactHolder = $('ul.contacts');

    // add a delete link to all of the existing tag form li elements
    $collectionContactHolder.find('li').each(function() {
        addContactsFormDeleteLink($(this));
    });

    // add the "add a tag" anchor and li to the tags ul
    $collectionContactHolder.append($newContactLinkDiv);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionContactHolder.data('index', $collectionContactHolder.find(':input').length);

    $addContactLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see code block below)
        addContactsForm($collectionContactHolder, $newContactLinkDiv);
    });
});

function addContactsForm($collectionContactHolder, $newContactLinkDiv) {
    // Get the data-prototype explained earlier
    var prototype = $collectionContactHolder.data('prototype');

    // get the new index
    var index = $collectionContactHolder.data('index');

    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionContactHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormDiv = $('<li></li>').append(newForm);

    // also add a remove button, just for this example
    $newFormDiv.append('<a href="#" class="btn btn-remove btn-danger"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></a>');

    $newContactLinkDiv.before($newFormDiv);

    // handle the removal, just for this example
    $('.btn-remove').click(function(e) {
        e.preventDefault();

        $(this).parent().remove();

        return false;
    });
}

function addContactsFormDeleteLink($contactFormDiv) {
    var $removeFormA = $('<a href="#">delete this contact</a>');
    $contactFormDiv.append($removeFormA);

    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the tag form
        $contactFormDiv.remove();
    });
}