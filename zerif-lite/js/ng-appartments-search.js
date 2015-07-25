(function (){
angular
    .module('appartmentsApp', []);

    angular
        .module('appartmentsApp')
        .controller('AppartmentSearchCtrl', AppartmentSearchCtrl);

    function AppartmentSearchCtrl() {
        var vm = this;
        vm.filter = "tous";
        vm.animation = true;
    }

    /**
     * @desc filter directive that filter by location label
     * @example <div acme-order-calendar-range></div>
     */
    angular
        .module('appartmentsApp')
        .directive('locationStatusFilter', locationStatusFilter);

    function locationStatusFilter() {
        return {
            restrict: 'A',
            scope: {
                filter: '@',
                element: '@'
            },
            link: function(scope, elem, attrs) {
                scope.$watch('filter', function(newval, oldval) {
                    elem
                        .find('.appartment-thumb')
                        .hide();
                    if (scope.filter == "tous")
                        elem
                            .find('.appartment-thumb')
                            .show();
                    else
                        elem.find(".appartment-thumb .label:contains('"+scope.filter+"')")
                            .parent().parent()
                            .parent(".appartment-thumb").show();
                })
            }
        }
    }

})();