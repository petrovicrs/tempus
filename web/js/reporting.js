
jQuery(document).ready(function() {

    loadReporting();
    var planiranih = 0;
    var zapocetih = 0;
    var sprovedenih = 0;
    var potpisanih = 0;

    $('.planiranih').each(function (i, obj) {
        if (this.value != undefined) {
            planiranih = planiranih + +this.value;
        }

    })
    $("#ukupnoPlaniranih").text(planiranih);

    $('.zapocetih').each(function (i, obj) {
        if (this.value != undefined) {
            zapocetih = zapocetih + +this.value;
        }
    })
    $("#ukupnoZapocetih").text(zapocetih);

    $('.sprovedenih').each(function (i, obj) {
        if (this.value != undefined) {
            sprovedenih = sprovedenih + +this.value;
        }
    })
    $("#ukupnoSprovedenih").text(sprovedenih);

    $('.potpisanih').each(function (i, obj) {
        if (this.value != undefined) {
            potpisanih = potpisanih + +this.value;
        }
    })
    $("#ukupnoPotpisanih").text(potpisanih);

    $( ".planiranih" ).change(function() {
        planiranih = 0;
        $('.planiranih').each(function (i, obj) {
            planiranih = planiranih + +this.value;
        })
        $("#ukupnoPlaniranih").text(planiranih);
    });

    $( ".zapocetih" ).change(function() {
        zapocetih = 0;
        $('.zapocetih').each(function (i, obj) {
            zapocetih = zapocetih + +this.value;
        })
        $("#ukupnoZapocetih").text(zapocetih);
    });

    $( ".sprovedenih" ).change(function() {
        sprovedenih = 0;
        $('.sprovedenih').each(function (i, obj) {
            sprovedenih = sprovedenih + +this.value;
        })
        $("#ukupnoSprovedenih").text(sprovedenih);
    });

    $( ".potpisanih" ).change(function() {
        potpisanih = 0;
        $('.potpisanih').each(function (i, obj) {
            potpisanih = potpisanih + +this.value;
        })
        $("#ukupnoPotpisanih").text(potpisanih);
    });
});

function loadReporting() {
    var $addReportingLink = $('<a href="#" class="btn btn-add btn-success "><span aria-hidden="true"></span>add</a>');
    var $addReportinkLinkDiv = $('<li></li>').append($addReportingLink);

    var $collectionReportingHolder = $('ul.reporting');

    $collectionReportingHolder.find('li').each(function() {
        $addFormDeleteLink($(this));
    });

    $collectionReportingHolder.append($addReportinkLinkDiv);
    $collectionReportingHolder.data('index', $collectionReportingHolder.find(':input').length);

    $addReportingLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see code block below)
        $addForm($collectionReportingHolder, $addReportinkLinkDiv, 'reporting');
    });

    // if($collectionReportingHolder.data('purpose') === 'create') {
    //     $addForm($collectionReportingHolder, $addReportinkLinkDiv, 'reporting');
    // }

    return true;
}

function loadReportingBy() {
    var $addReportingByLink = $('<a href="#" class="btn btn-add btn-success "><span aria-hidden="true"></span>add</a>');
    var $addReportinkByLinkDiv = $('<li></li>').append($addReportingByLink);

    var $collectionReportingByHolder = $('ul.reporting-by');

    $collectionReportingByHolder.find('li').each(function() {
        $addFormDeleteLink($(this));
    });

    // add the "add a tag" anchor and li to the tags ul

    $collectionReportingByHolder.append($addReportinkByLinkDiv);
    // $collectionQuestionAndAnswersHolder.append($addQuestionAndAnswersLinkDiv);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)

    $collectionReportingByHolder.data('index', $collectionReportingByHolder.find(':input').length);

    $addReportingByLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see code block below)
        $addForm($collectionReportingByHolder, $addReportinkByLinkDiv, 'reportingBy');
    });
}
// var $addQuestionAndAnswersLink = $('<a href="#" class="btn btn-add btn-success "><span aria-hidden="true"></span>add</a>');
// var $addQuestionAndAnswersLinkDiv = $('<li></li>').append($addQuestionAndAnswersLink);

// jQuery(document).ready(function() {
//     // Get the ul that holds the collection of tags
//
//     var $collectionQuestionAndAnswersHolder = $('ul.questions-answers');
//
//     $collectionQuestionAndAnswersHolder.find('li').each(function() {
//         $addFormDeleteLink($(this));
//     });
//
//
//     $collectionQuestionAndAnswersHolder.data('index', $collectionQuestionAndAnswersHolder.find(':input').length);
// });

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

function $addForm($collectionHolder, $addLinkDiv, formName) {
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

    if(formName === 'reporting') {
        loadReportingBy();
    }

    // handle the removal, just for this example
    $('.btn-remove').click(function(e) {
        e.preventDefault();

        $(this).parent().remove();

        return false;
    });
}