
jQuery(document).ready(load);
jQuery(document).ajaxComplete(load);

function load() {
    var $addProjectSubjectAreasLink = $('<a href="#" class="btn btn-add btn-success "><span aria-hidden="true"></span>add subject area</a>');
    var $addProjectSubjectAreasLinkDiv = $('<li></li>').append($addProjectSubjectAreasLink);
    // Get the ul that holds the collection of tags
    var $collectionProjectSubjectAreasHolder = $('ul.subjectAreas');

    // add a delete link to all of the existing tag form li elements
    $collectionProjectSubjectAreasHolder.find('li').each(function() {
        $addProjectSubjectAreasFormDeleteLink($(this));
    });

    // add the "add a tag" anchor and li to the tags ul
    $collectionProjectSubjectAreasHolder.append($addProjectSubjectAreasLinkDiv);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionProjectSubjectAreasHolder.data('index', $collectionProjectSubjectAreasHolder.find(':input').length);

    $addProjectSubjectAreasLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see code block below)
        $addProjectSubjectAreasForm($collectionProjectSubjectAreasHolder, $addProjectSubjectAreasLinkDiv);
    });
}

function $addProjectSubjectAreasForm($collectionProjectSubjectAreasHolder, $addProjectSubjectAreasLinkDiv) {
    // Get the data-prototype explained earlier
    var prototype = $collectionProjectSubjectAreasHolder.data('prototype');

    // get the new index
    var index = $collectionProjectSubjectAreasHolder.data('index');

    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionProjectSubjectAreasHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormDiv = $('<li></li>').append(newForm);

    // also add a remove button, just for this example
    $newFormDiv.append('<a href="#" class="btn btn-remove btn-danger"><span aria-hidden="true"></span>remove subject area</a>');

    $addProjectSubjectAreasLinkDiv.before($newFormDiv);

    // handle the removal, just for this example
    $('.btn-remove').click(function(e) {
        e.preventDefault();

        $(this).parent().remove();

        return false;
    });
}

function $addProjectSubjectAreasFormDeleteLink($contactFormDiv) {
    var $removeFormA = $('<a href="#" class="btn btn-remove btn-danger"><span aria-hidden="true"></span>remove subject area</a>');
    $contactFormDiv.append($removeFormA);

    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the tag form
        $contactFormDiv.remove();
    });
}