
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

    loadReporting();
    var odobrenoUgovorom = 0;
    var nakonRealokacija = 0;
    var zavrsnomIzvestaju = 0;
    var odobrenihUgovorom = 0;
    var zatrazenihZavrsimIzvescem = 0;
    var danaNakonZavrsnogIzvesca = 0;
    var odobrenoZavrsnogIzvesca = 0;
    var finansijskaKorelacija = 0;

    $('.odobrenoUgovorom').each(function (i, obj) {
        if (this.value != undefined) {
            odobrenoUgovorom = odobrenoUgovorom + +this.value;
        }

    })
    $("#odobrenoUgovorom").text(odobrenoUgovorom);

    $( ".odobrenoUgovorom" ).change(function() {
        odobrenoUgovorom = 0;
        $('.odobrenoUgovorom').each(function (i, obj) {
            odobrenoUgovorom = odobrenoUgovorom + +this.value;
        })
        $("#odobrenoUgovorom").text(odobrenoUgovorom);
    });

    $('.nakonRealokacija').each(function (i, obj) {
        if (this.value != undefined) {
            nakonRealokacija = nakonRealokacija + +this.value;
        }

    })
    $("#nakonRealokacija").text(nakonRealokacija);

    $( ".nakonRealokacija" ).change(function() {
        nakonRealokacija = 0;
        $('.nakonRealokacija').each(function (i, obj) {
            nakonRealokacija = nakonRealokacija + +this.value;
        })
        $("#nakonRealokacija").text(nakonRealokacija);
    });

    $('.zavrsnomIzvestaju').each(function (i, obj) {
        if (this.value != undefined) {
            zavrsnomIzvestaju = zavrsnomIzvestaju + +this.value;
        }

    })
    $("#zavrsnomIzvestaju").text(zavrsnomIzvestaju);

    $( ".zavrsnomIzvestaju" ).change(function() {
        zavrsnomIzvestaju = 0;
        $('.zavrsnomIzvestaju').each(function (i, obj) {
            zavrsnomIzvestaju = zavrsnomIzvestaju + +this.value;
        })
        $("#zavrsnomIzvestaju").text(zavrsnomIzvestaju);
    });

    $('.odobrenihUgovorom').each(function (i, obj) {
        if (this.value != undefined) {
            odobrenihUgovorom = odobrenihUgovorom + +this.value;
        }

    })
    $("#odobrenihUgovorom").text(odobrenihUgovorom);

    $( ".odobrenihUgovorom" ).change(function() {
        odobrenihUgovorom = 0;
        $('.odobrenihUgovorom').each(function (i, obj) {
            odobrenihUgovorom = odobrenihUgovorom + +this.value;
        })
        $("#odobrenihUgovorom").text(odobrenihUgovorom);
    });

    $('.zatrazenihZavrsimIzvescem').each(function (i, obj) {
        if (this.value != undefined) {
            zatrazenihZavrsimIzvescem = zatrazenihZavrsimIzvescem + +this.value;
        }

    })
    $("#zatrazenihZavrsimIzvescem").text(zatrazenihZavrsimIzvescem);

    $( ".zatrazenihZavrsimIzvescem" ).change(function() {
        zatrazenihZavrsimIzvescem = 0;
        $('.zatrazenihZavrsimIzvescem').each(function (i, obj) {
            zatrazenihZavrsimIzvescem = zatrazenihZavrsimIzvescem + +this.value;
        })
        $("#zatrazenihZavrsimIzvescem").text(zatrazenihZavrsimIzvescem);
    });

    $('.danaNakonZavrsnogIzvesca').each(function (i, obj) {
        if (this.value != undefined) {
            danaNakonZavrsnogIzvesca = danaNakonZavrsnogIzvesca + +this.value;
        }

    })
    $("#danaNakonZavrsnogIzvesca").text(danaNakonZavrsnogIzvesca);

    $( ".danaNakonZavrsnogIzvesca" ).change(function() {
        danaNakonZavrsnogIzvesca = 0;
        $('.danaNakonZavrsnogIzvesca').each(function (i, obj) {
            danaNakonZavrsnogIzvesca = danaNakonZavrsnogIzvesca + +this.value;
        })
        $("#danaNakonZavrsnogIzvesca").text(danaNakonZavrsnogIzvesca);
    });

    $('.odobrenoZavrsnogIzvesca').each(function (i, obj) {
        if (this.value != undefined) {
            odobrenoZavrsnogIzvesca = odobrenoZavrsnogIzvesca + +this.value;
        }

    })
    $("#odobrenoZavrsnogIzvesca").text(odobrenoZavrsnogIzvesca);

    $( ".odobrenoZavrsnogIzvesca" ).change(function() {
        odobrenoZavrsnogIzvesca = 0;
        $('.odobrenoZavrsnogIzvesca').each(function (i, obj) {
            odobrenoZavrsnogIzvesca = odobrenoZavrsnogIzvesca + +this.value;
        })
        $("#odobrenoZavrsnogIzvesca").text(odobrenoZavrsnogIzvesca);
    });

    $('.finansijskaKorelacija').each(function (i, obj) {
        if (this.value != undefined) {
            finansijskaKorelacija = finansijskaKorelacija + +this.value;
        }

    })
    $("#finansijskaKorelacija").text(finansijskaKorelacija);

    $( ".finansijskaKorelacija" ).change(function() {
        finansijskaKorelacija = 0;
        $('.finansijskaKorelacija').each(function (i, obj) {
            finansijskaKorelacija = finansijskaKorelacija + +this.value;
        })
        $("#finansijskaKorelacija").text(finansijskaKorelacija);
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