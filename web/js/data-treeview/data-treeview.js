jQuery(document).ready(function ($) {
    $('form .form-control.tree-structure-element').each(function (index, el) {
        var self = $(this),
            tree_structure_str = self.attr('data-tree-structure');
        self.parent('div').addClass('tree-structure-wrapper');
        if (typeof tree_structure_str !== typeof undefined && tree_structure_str !== false) {
            self.on('mousedown', function (ev, el) {
                ev.preventDefault();
                var element_id = self.attr('id'),
                    title = self.attr('data-tree-title'),
                    tree_id = 'data_tree_view_' + element_id,
                    tree_structure = jQuery.parseJSON(tree_structure_str);
                if (typeof title === typeof undefined || title === false) {
                    title = 'MISSING TITLE ATTRIBUTE'
                }
                BootstrapDialog.show({
                    title: Translator.trans(title),
                    type: 'tempus-type',
                    message: '<div id="' + tree_id + '" data-selected-element=""></div>',
                    onshown: function() {
                        $('#' + tree_id).treeview({
                            expandIcon: 'fa fa-plus',
                            collapseIcon: 'fa fa-minus',
                            emptyIcon: '',
                            nodeIcon: '',
                            selectedIcon: '',
                            checkedIcon: 'fa fa-check-square-o',
                            uncheckedIcon: 'fa fa-square-o',
                            data: tree_structure,
                            onNodeSelected: function(event, data) {
                                $('#' + tree_id).attr('data-selected-element', data['data-id']);
                            }
                        });
                    },
                    buttons: [{
                        label: Translator.trans('msg.save'),
                        cssClass: 'btn btn-primary',
                        action: function(dialogItself){
                            var value = $('#' + tree_id).attr('data-selected-element');
                            self.val(value).change();
                            dialogItself.close();
                        }
                    }, {
                        label: Translator.trans('msg.close'),
                        cssClass: 'btn btn-light',
                        action: function(dialogItself){
                            dialogItself.close();
                        }
                    }]
                });
            });
        } else {
            console.log('Data tree view: Missing data tree structure for element with id: ' + el.id)
        }
    });
});