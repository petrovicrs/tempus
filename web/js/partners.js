var $addTeamMembersLink = $('<a href="#" class="btn btn-add btn-success "><span aria-hidden="true"></span>add</a>');
var $addTeamMembersLinkDiv = $('<li></li>').append($addTeamMembersLink);

var $addParticipantsLink = $('<a href="#" class="btn btn-add btn-success "><span aria-hidden="true"></span>add</a>');
var $addParticipantsLinkDiv = $('<li></li>').append($addParticipantsLink);

jQuery(document).ready(function() {
    // Get the ul that holds the collection of tags
    var $collectionTeamMembersHolder = $('ul.team-members');
    var $collectionParticipantsHolder = $('ul.participants');

    // add a delete link to all of the existing tag form li elements
    $collectionTeamMembersHolder.find('li').each(function() {
        $addFormDeleteLink($(this));
    });

    $collectionParticipantsHolder.find('li').each(function() {
        $addFormDeleteLink($(this));
    });

    // add the "add a tag" anchor and li to the tags ul
    $collectionTeamMembersHolder.append($addTeamMembersLinkDiv);
    $collectionParticipantsHolder.append($addParticipantsLink);
    $collectionParticipantsHolder.append($addParticipantsLinkDiv);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionTeamMembersHolder.data('index', $collectionTeamMembersHolder.find(':input').length);
    $collectionParticipantsHolder.data('index', $collectionParticipantsHolder.find(':input').length);

    $addTeamMembersLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see code block below)
        $addForm($collectionTeamMembersHolder, $addTeamMembersLinkDiv);
    });

    $addParticipantsLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see code block below)
        $addForm($collectionParticipantsHolder, $addParticipantsLinkDiv);
    });
});

function $addFormDeleteLink($formDiv) {
    var $removeFormA = $('<a href="#">delete</a>');
    $formDiv.append($removeFormA);

    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the tag form
        $formDiv.remove();
    });
}

function $addForm($collectionHolder, $addLinkDiv) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormDiv = $('<li></li>').append(newForm);

    // also add a remove button, just for this example
    $newFormDiv.append('<a href="#" class="btn btn-remove btn-danger"><span aria-hidden="true"></span>remove</a>');

    $addLinkDiv.before($newFormDiv);

    // handle the removal, just for this example
    $('.btn-remove').click(function(e) {
        e.preventDefault();

        $(this).parent().remove();

        return false;
    });
}