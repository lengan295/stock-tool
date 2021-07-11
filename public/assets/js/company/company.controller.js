angular.module("Company").controller("CompanyCtrl", function ($scope, $http) {
    $scope.loadData = function (companyCode) {
        $http.get('/ajax/company/' + companyCode)
            .then(function (response) {
                    console.log(response);
                }
            );
    }
});

