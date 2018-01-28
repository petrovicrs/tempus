
jQuery(document).ready(load);
jQuery(document).ajaxComplete(load);

function load() {
    var $addProjectEvaluatorGradesLink = $('<a href="#" class="btn btn-add btn-success "><span aria-hidden="true"></span>add evaluator grades</a>');
    var $addProjectEvaluatorGradesLinkDiv = $('<li></li>').append($addProjectEvaluatorGradesLink);
    // Get the ul that holds the collection of tags
    var $collectionProjectEvaluatorGradesHolder = $('ul.evaluatorGrades');

    // add a delete link to all of the existing tag form li elements
    $collectionProjectEvaluatorGradesHolder.find('li').each(function() {
        $addProjectEvaluatorGradesFormDeleteLink($(this));
    });

    // add the "add a tag" anchor and li to the tags ul
    $collectionProjectEvaluatorGradesHolder.append($addProjectEvaluatorGradesLinkDiv);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionProjectEvaluatorGradesHolder.data('index', $collectionProjectEvaluatorGradesHolder.find(':input').length);

    $addProjectEvaluatorGradesLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see code block below)
        $addProjectEvaluatorGradesForm($collectionProjectEvaluatorGradesHolder, $addProjectEvaluatorGradesLinkDiv);
    });
}

function $addProjectEvaluatorGradesForm($collectionProjectEvaluatorGradesHolder, $addProjectEvaluatorGradesLinkDiv) {
    // Get the data-prototype explained earlier
    var prototype = $collectionProjectEvaluatorGradesHolder.data('prototype');

    // get the new index
    var index = $collectionProjectEvaluatorGradesHolder.data('index');

    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionProjectEvaluatorGradesHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormDiv = $('<li></li>').append(newForm);

    // also add a remove button, just for this example
    $newFormDiv.append('<a href="#" class="btn btn-remove btn-danger"><span aria-hidden="true"></span>remove evaluator grades</a>');

    $addProjectEvaluatorGradesLinkDiv.before($newFormDiv);

    // handle the removal, just for this example
    $('.btn-remove').click(function(e) {
        e.preventDefault();

        $(this).parent().remove();

        return false;
    });
}

function $addProjectEvaluatorGradesFormDeleteLink($contactFormDiv) {
    var $removeFormA = $('<a href="#" class="btn btn-remove btn-danger"><span aria-hidden="true"></span>remove evaluator grades</a>');
    $contactFormDiv.append($removeFormA);

    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the tag form
        $contactFormDiv.remove();
    });
}