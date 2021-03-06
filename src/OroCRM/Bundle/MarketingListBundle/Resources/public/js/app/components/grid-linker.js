/*jslint nomen: true*/
/*global define*/
define(function (require) {
    'use strict';

    var _ = require('underscore'),
        mediator = require('oroui/js/mediator');

    return function (options) {
        _.each(options, function (grids) {
            mediator.on('datagrid:afterRemoveRow:' + grids.main, function () {
                mediator.trigger('datagrid:doRefresh:' + grids.secondary);
            });
        });
    };
});
