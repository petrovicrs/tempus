
jQuery(document).ready(load);
jQuery(document).ajaxComplete(load);

function load() {
    var $addExistingInstitutionPermissionLink = $('<a href="#" class="btn btn-add btn-success "><span aria-hidden="true"></span>add institution</a>');
    var $addExistingInstitutionPermissionLinkDiv = $('<li></li>').append($addExistingInstitutionPermissionLink);
    // Get the ul that holds the collection of tags
    var $collectionInstitutionTargetGroupHolder = $('ul.existingInstitution');

    // add a delete link to all of the existing tag form li elements
    $collectionInstitutionTargetGroupHolder.find('li').each(function() {
        $addExistingInstitutionPermissionFormDeleteLink($(this));
    });

    // add the "add a tag" anchor and li to the tags ul
    $collectionInstitutionTargetGroupHolder.append($addExistingInstitutionPermissionLinkDiv);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionInstitutionTargetGroupHolder.data('index', $collectionInstitutionTargetGroupHolder.find(':input').length);

    $addExistingInstitutionPermissionLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see code block below)
        $addExistingInstitutionPermissionForm($collectionInstitutionTargetGroupHolder, $addExistingInstitutionPermissionLinkDiv);
    });
}

function $addExistingInstitutionPermissionForm($collectionInstitutionTargetGroupHolder, $addExistingInstitutionPermissionLinkDiv) {
    // Get the data-prototype explained earlier
    var prototype = $collectionInstitutionTargetGroupHolder.data('prototype');

    // get the new index
    var index = $collectionInstitutionTargetGroupHolder.data('index');

    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionInstitutionTargetGroupHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormDiv = $('<li></li>').append(newForm);

    // also add a remove button, just for this example
    $newFormDiv.append('<a href="#" class="btn btn-remove btn-danger"><span aria-hidden="true"></span>remove institution</a>');

    $addExistingInstitutionPermissionLinkDiv.before($newFormDiv);

    // handle the removal, just for this example
    $('.btn-remove').click(function(e) {
        e.preventDefault();

        $(this).parent().remove();

        return false;
    });
}

function $addExistingInstitutionPermissionFormDeleteLink($contactFormDiv) {
    var $removeFormA = $('<a href="#" class="btn btn-remove btn-danger"><span aria-hidden="true"></span>remove institution</a>');
    $contactFormDiv.append($removeFormA);

    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the tag form
        $contactFormDiv.remove();
    });
}