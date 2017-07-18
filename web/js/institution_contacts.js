var $addInstitutionContactLink = $('<a href="#" class="btn btn-add btn-success "><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>');
var $newInstitutionContactLinkDiv = $('<li></li>').append($addInstitutionContactLink);

jQuery(document).ready(function() {
    // Get the ul that holds the collection of tags
    var $collectionInstitutionContactHolder = $('ul.contacts');

    // add a delete link to all of the existing tag form li elements
    $collectionInstitutionContactHolder.find('li').each(function() {
        addInstitutionContactsFormDeleteLink($(this));
    });

    // add the "add a tag" anchor and li to the tags ul
    $collectionInstitutionContactHolder.append($newInstitutionContactLinkDiv);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionInstitutionContactHolder.data('index', $collectionInstitutionContactHolder.find(':input').length);

    $addInstitutionContactLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see code block below)
        addInstitutionContactsForm($collectionInstitutionContactHolder, $newInstitutionContactLinkDiv);
    });
});

function addInstitutionContactsForm($collectionInstitutionContactHolder, $newInstitutionContactLinkDiv) {
    // Get the data-prototype explained earlier
    var prototype = $collectionInstitutionContactHolder.data('prototype');

    // get the new index
    var index = $collectionInstitutionContactHolder.data('index');

    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionInstitutionContactHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormDiv = $('<li></li>').append(newForm);

    // also add a remove button, just for this example
    $newFormDiv.append('<a href="#" class="btn btn-remove btn-danger"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></a>');

    $newInstitutionContactLinkDiv.before($newFormDiv);

    // handle the removal, just for this example
    $('.btn-remove').click(function(e) {
        e.preventDefault();

        $(this).parent().remove();

        return false;
    });
}

function addInstitutionContactsFormDeleteLink($contactFormDiv) {
    var $removeFormA = $('<a href="#">delete this contact</a>');
    $contactFormDiv.append($removeFormA);

    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the tag form
        $contactFormDiv.remove();
    });
}