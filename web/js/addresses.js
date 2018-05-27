var $addAddressLink = $('<a href="#" class="btn btn-add btn-success "><span aria-hidden="true"></span>add address</a>');
var $newAddressLinkDiv = $('<li></li>').append($addAddressLink);

jQuery(document).ready(function() {
    // Get the ul that holds the collection of tags
    var $collectionAddressHolder = $('ul.addresses');

    // add a delete link to all of the existing tag form li elements
    $collectionAddressHolder.find('li').each(function() {
        $addAddressesFormDeleteLink($(this));
    });

    // add the "add a tag" anchor and li to the tags ul
    $collectionAddressHolder.append($newAddressLinkDiv);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionAddressHolder.data('index', $collectionAddressHolder.find(':input').length);

    $addAddressLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see code block below)
        $addAddressesForm($collectionAddressHolder, $newAddressLinkDiv);

        $('.selectpicker').selectpicker('render');
    });
});

function $addAddressesForm($collectionAddressHolder, $newAddressLinkDiv) {
    // Get the data-prototype explained earlier
    var prototype = $collectionAddressHolder.data('prototype');

    // get the new index
    var index = $collectionAddressHolder.data('index');

    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionAddressHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormDiv = $('<li></li>').append(newForm);

    // also add a remove button, just for this example
    $newFormDiv.append('<a href="#" class="btn btn-remove btn-danger"><span aria-hidden="true"></span>remove address</a>');

    $newAddressLinkDiv.before($newFormDiv);

    // handle the removal, just for this example
    $('.btn-remove').click(function(e) {
        e.preventDefault();

        $(this).parent().remove();

        return false;
    });
}

function $addAddressesFormDeleteLink($contactFormDiv) {
    var $removeFormA = $('<a href="#">delete this contact</a>');
    $contactFormDiv.append($removeFormA);

    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the tag form
        $contactFormDiv.remove();
    });
}