
jQuery(document).ready(load);
jQuery(document).ajaxComplete(load);

function load() {
    var $addProjectPriorityLink = $('<a href="#" class="btn btn-add btn-success "><span aria-hidden="true"></span>add priority</a>');
    var $addProjectPriorityLinkDiv = $('<li></li>').append($addProjectPriorityLink);
    // Get the ul that holds the collection of tags
    var $collectionProjectPriorityHolder = $('ul.projectPriority');

    // add a delete link to all of the existing tag form li elements
    $collectionProjectPriorityHolder.find('li').each(function() {
        $addProjectPriorityFormDeleteLink($(this));
    });

    // add the "add a tag" anchor and li to the tags ul
    $collectionProjectPriorityHolder.append($addProjectPriorityLinkDiv);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionProjectPriorityHolder.data('index', $collectionProjectPriorityHolder.find(':input').length);

    $addProjectPriorityLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see code block below)
        $addProjectPriorityForm($collectionProjectPriorityHolder, $addProjectPriorityLinkDiv);
    });
}

function $addProjectPriorityForm($collectionProjectPriorityHolder, $addProjectPriorityLinkDiv) {
    // Get the data-prototype explained earlier
    var prototype = $collectionProjectPriorityHolder.data('prototype');

    // get the new index
    var index = $collectionProjectPriorityHolder.data('index');

    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionProjectPriorityHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormDiv = $('<li></li>').append(newForm);

    // also add a remove button, just for this example
    $newFormDiv.append('<a href="#" class="btn btn-remove btn-danger"><span aria-hidden="true"></span>remove priority</a>');

    $addProjectPriorityLinkDiv.before($newFormDiv);

    // handle the removal, just for this example
    $('.btn-remove').click(function(e) {
        e.preventDefault();

        $(this).parent().remove();

        return false;
    });
}

function $addProjectPriorityFormDeleteLink($contactFormDiv) {
    var $removeFormA = $('<a href="#" class="btn btn-remove btn-danger"><span aria-hidden="true"></span>remove priority</a>');
    $contactFormDiv.append($removeFormA);

    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the tag form
        $contactFormDiv.remove();
    });
}