var $addContactLink = $('<a href="#" class="add_contact_link">Add a contact</a>');
var $newLinkLi = $('<li></li>').append($addContactLink);

var $addAddressLink = $('<a href="#" class="add_address_link">Add a address</a>');
var $newAddressLinkLi = $('<li></li>').append($addAddressLink);

var $addNoteLink = $('<a href="#" class="add_address_link">Add a note</a>');
var $newNoteLinkLi = $('<li></li>').append($addNoteLink);

var $addDocumentLink = $('<a href="#" class="add_document_link">Add a document</a>');
var $newDocumentLinkLi = $('<li></li>').append($addDocumentLink);

var $addInstitutionRelationshipLink = $('<a href="#" class="add_document_link">Add a institution relationship</a>');
var $newInstitutionRelationshipLinkLi = $('<li></li>').append($addInstitutionRelationshipLink);

var $addFacingSituationLink = $('<a href="#" class="add_field_of_expertise_link">Add situation person is facing</a>');
var $newFacingSituationLinkLi = $('<li></li>').append($addFacingSituationLink);

jQuery(document).ready(function() {
    // Get the ul that holds the collection of tags
    var $contactsCollectionHolder = $('ul.contacts');

    // add a delete link to all of the existing tag form li elements
    $contactsCollectionHolder.find('li').each(function() {
        addContactFormDeleteLink($(this));
    });

    // add the "add a tag" anchor and li to the tags ul
    $contactsCollectionHolder.append($newLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $contactsCollectionHolder.data('index', $contactsCollectionHolder.find(':input').length);

    $addContactLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see code block below)
        addContactForm($contactsCollectionHolder, $newLinkLi);
    });


    var $addressesCollectionHolder = $('ul.addresses');

    $addressesCollectionHolder.find('li').each(function() {
        addAddressFormDeleteLink($(this));
    });
    $addressesCollectionHolder.append($newAddressLinkLi);
    $addressesCollectionHolder.data('index', $addressesCollectionHolder.find(':input').length);

    $addAddressLink.on('click', function(e) {
        e.preventDefault();
        addAddressForm($addressesCollectionHolder, $newAddressLinkLi);
    });


    var $notesCollectionHolder = $('ul.person-notes');

    $notesCollectionHolder.find('li').each(function() {
        addNoteFormDeleteLink($(this));
    });
    $notesCollectionHolder.append($newNoteLinkLi);
    $notesCollectionHolder.data('index', $notesCollectionHolder.find(':input').length);

    $addNoteLink.on('click', function(e) {
        e.preventDefault();
        addNoteForm($notesCollectionHolder, $newNoteLinkLi);
    });


    var $documentsCollectionHolder = $('ul.person-documents');

    $documentsCollectionHolder.find('li').each(function() {
        addDocumentFormDeleteLink($(this));
    });
    $documentsCollectionHolder.append($newDocumentLinkLi);
    $documentsCollectionHolder.data('index', $documentsCollectionHolder.find(':input').length);

    $addDocumentLink.on('click', function(e) {
        e.preventDefault();
        addDocumentForm($documentsCollectionHolder, $newDocumentLinkLi);
    });


    var $institutionRelationshipCollectionHolder = $('ul.person-institution-relationships');

    $institutionRelationshipCollectionHolder.find('li').each(function() {
        addInstitutionRelationshipFormDeleteLink($(this));
    });
    $institutionRelationshipCollectionHolder.append($newInstitutionRelationshipLinkLi);
    $institutionRelationshipCollectionHolder.data('index', $institutionRelationshipCollectionHolder.find(':input').length);

    $addInstitutionRelationshipLink.on('click', function(e) {
        e.preventDefault();
        addInstitutionRelationshipForm($institutionRelationshipCollectionHolder, $newInstitutionRelationshipLinkLi);
    });


    var $facingSituationCollectionHolder = $('ul.person-facing-situations');

    $facingSituationCollectionHolder.find('li').each(function() {
        addFacingSituationFormDeleteLink($(this));
    });
    $facingSituationCollectionHolder.append($newFacingSituationLinkLi);
    $facingSituationCollectionHolder.data('index', $facingSituationCollectionHolder.find(':input').length);

    $addFacingSituationLink.on('click', function(e) {
        e.preventDefault();
        addFacingSituationForm($facingSituationCollectionHolder, $newFacingSituationLinkLi);
    });

});

function addContactForm($collectionHolder, $newLinkLi) {
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
    var $newFormLi = $('<li></li>').append(newForm);

    // also add a remove button, just for this example
    $newFormLi.append('<a href="#" class="remove-contact">x</a>');

    $newLinkLi.before($newFormLi);

    // handle the removal, just for this example
    $('.remove-contact').click(function(e) {
        e.preventDefault();

        $(this).parent().remove();

        return false;
    });
}

function addContactFormDeleteLink($contactFormLi) {
    var $removeFormA = $('<a href="#">delete this contact</a>');
    $contactFormLi.append($removeFormA);

    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the tag form
        $contactFormLi.remove();
    });
}



function addAddressForm($collectionHolder, $newLinkLi) {

    var prototype = $collectionHolder.data('prototype');
    var index = $collectionHolder.data('index');
    var newForm = prototype.replace(/__name__/g, index);
    $collectionHolder.data('index', index + 1);
    var $newFormLi = $('<li></li>').append(newForm);
    $newFormLi.append('<a href="#" class="remove-address">x</a>');
    $newLinkLi.before($newFormLi);

    // handle the removal, just for this example
    $('.remove-address').click(function(e) {
        e.preventDefault();

        $(this).parent().remove();

        return false;
    });
}

function addAddressFormDeleteLink($addressFormLi) {
    var $removeFormA = $('<a href="#">delete this address</a>');
    $addressFormLi.append($removeFormA);

    $removeFormA.on('click', function(e) {
        e.preventDefault();
        $addressFormLi.remove();
    });
}

function addNoteForm($collectionHolder, $newLinkLi) {

    var prototype = $collectionHolder.data('prototype');
    var index = $collectionHolder.data('index');
    var newForm = prototype.replace(/__name__/g, index);
    $collectionHolder.data('index', index + 1);
    var $newFormLi = $('<li></li>').append(newForm);
    $newFormLi.append('<a href="#" class="remove-note">x</a>');
    $newLinkLi.before($newFormLi);

    // handle the removal, just for this example
    $('.remove-note').click(function(e) {
        e.preventDefault();

        $(this).parent().remove();

        return false;
    });
}

function addNoteFormDeleteLink($formLi) {
    var $removeFormA = $('<a href="#">delete this note</a>');
    $formLi.append($removeFormA);

    $removeFormA.on('click', function(e) {
        e.preventDefault();
        $formLi.remove();
    });
}

function addDocumentForm($collectionHolder, $newLinkLi) {

    var prototype = $collectionHolder.data('prototype');
    var index = $collectionHolder.data('index');
    var newForm = prototype.replace(/__name__/g, index);
    $collectionHolder.data('index', index + 1);
    var $newFormLi = $('<li></li>').append(newForm);
    $newFormLi.append('<a href="#" class="remove-document">x</a>');
    $newLinkLi.before($newFormLi);

    // handle the removal, just for this example
    $('.remove-document').click(function(e) {
        e.preventDefault();

        $(this).parent().remove();

        return false;
    });
}

function addDocumentFormDeleteLink($formLi) {
    var $removeFormA = $('<a href="#">delete this document</a>');
    $formLi.append($removeFormA);

    $removeFormA.on('click', function(e) {
        e.preventDefault();
        $formLi.remove();
    });
}



function addInstitutionRelationshipForm($collectionHolder, $newLinkLi) {

    var prototype = $collectionHolder.data('prototype');
    var index = $collectionHolder.data('index');
    var newForm = prototype.replace(/__name__/g, index);
    $collectionHolder.data('index', index + 1);
    var $newFormLi = $('<li></li>').append(newForm);
    $newFormLi.append('<a href="#" class="remove-institution-relationship">x</a>');
    $newLinkLi.before($newFormLi);

    // handle the removal, just for this example
    $('.remove-institution-relationship').click(function(e) {
        e.preventDefault();

        $(this).parent().remove();

        return false;
    });
}

function addInstitutionRelationshipFormDeleteLink($formLi) {
    var $removeFormA = $('<a href="#">delete this relationship</a>');
    $formLi.append($removeFormA);

    $removeFormA.on('click', function(e) {
        e.preventDefault();
        $formLi.remove();
    });
}



function addFacingSituationForm($collectionHolder, $newLinkLi) {

    var prototype = $collectionHolder.data('prototype');
    var index = $collectionHolder.data('index');
    var newForm = prototype.replace(/__name__/g, index);
    $collectionHolder.data('index', index + 1);
    var $newFormLi = $('<li></li>').append(newForm);
    $newFormLi.append('<a href="#" class="remove-facing-situation">x</a>');
    $newLinkLi.before($newFormLi);

    // handle the removal, just for this example
    $('.remove-facing-situation').click(function(e) {
        e.preventDefault();

        $(this).parent().remove();

        return false;
    });
}

function addFacingSituationFormDeleteLink($formLi) {
    var $removeFormA = $('<a href="#">remove situation person is facing</a>');
    $formLi.append($removeFormA);

    $removeFormA.on('click', function(e) {
        e.preventDefault();
        $formLi.remove();
    });
}