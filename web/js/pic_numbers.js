var $addPicNumberLink = $('<a href="#" class="btn btn-add btn-success "><span aria-hidden="true"></span>add pic number</a>');
var $newPicNumberDiv = $('<li></li>').append($addPicNumberLink);

jQuery(document).ready(function() {
    // Get the ul that holds the collection of tags
    var $picNumberHolder = $('ul.picNumber');

    // add a delete link to all of the existing tag form li elements
    $picNumberHolder.find('li').each(function() {
        addPicNumberFormDeleteLink($(this));
    });

    // add the "add a tag" anchor and li to the tags ul
    $picNumberHolder.append($newPicNumberDiv);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $picNumberHolder.data('index', $picNumberHolder.find(':input').length);

    $addPicNumberLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see code block below)
        addPicNumberForm($picNumberHolder, $newPicNumberDiv);
    });
});

function addPicNumberForm($picNumberHolder, $newPicNumberDiv) {
    // Get the data-prototype explained earlier
    var prototype = $picNumberHolder.data('prototype');

    // get the new index
    var index = $picNumberHolder.data('index');

    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $picNumberHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormDiv = $('<li></li>').append(newForm);

    // also add a remove button, just for this example
    $newFormDiv.append('<a href="#" class="btn btn-remove btn-danger"><span aria-hidden="true"></span>remove pic number</a>');

    $newPicNumberDiv.before($newFormDiv);

    // handle the removal, just for this example
    $('.btn-remove').click(function(e) {
        e.preventDefault();

        $(this).parent().remove();

        return false;
    });
}

function addPicNumberFormDeleteLink($contactFormDiv) {
    var $removeFormA = $('<a href="#">delete this contact</a>');
    $contactFormDiv.append($removeFormA);

    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the tag form
        $contactFormDiv.remove();
    });
}