
jQuery(document).ready(load);
jQuery(document).ajaxComplete(load);

function load() {
    var $addProjectLimitationsLink = $('<a href="#" class="btn btn-add btn-success "><span aria-hidden="true"></span>add limitation</a>');
    var $addProjectLimitationsLinkDiv = $('<li></li>').append($addProjectLimitationsLink);
    // Get the ul that holds the collection of tags
    var $collectionProjectLimitationsHolder = $('ul.limitations');

    // add a delete link to all of the existing tag form li elements
    $collectionProjectLimitationsHolder.find('li').each(function() {
        $addProjectLimitationsFormDeleteLink($(this));
    });

    // add the "add a tag" anchor and li to the tags ul
    $collectionProjectLimitationsHolder.append($addProjectLimitationsLinkDiv);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionProjectLimitationsHolder.data('index', $collectionProjectLimitationsHolder.find(':input').length);

    $addProjectLimitationsLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see code block below)
        $addProjectLimitationsForm($collectionProjectLimitationsHolder, $addProjectLimitationsLinkDiv);
    });
}

function $addProjectLimitationsForm($collectionProjectLimitationsHolder, $addProjectLimitationsLinkDiv) {
    // Get the data-prototype explained earlier
    var prototype = $collectionProjectLimitationsHolder.data('prototype');

    // get the new index
    var index = $collectionProjectLimitationsHolder.data('index');

    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionProjectLimitationsHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormDiv = $('<li></li>').append(newForm);

    // also add a remove button, just for this example
    $newFormDiv.append('<a href="#" class="btn btn-remove btn-danger"><span aria-hidden="true"></span>remove limitation</a>');

    $addProjectLimitationsLinkDiv.before($newFormDiv);

    // handle the removal, just for this example
    $('.btn-remove').click(function(e) {
        e.preventDefault();

        $(this).parent().remove();

        return false;
    });
}

function $addProjectLimitationsFormDeleteLink($contactFormDiv) {
    var $removeFormA = $('<a href="#" class="btn btn-remove btn-danger"><span aria-hidden="true"></span>remove limitation</a>');
    $contactFormDiv.append($removeFormA);

    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the tag form
        $contactFormDiv.remove();
    });
}