angular.module("Company").controller("CompanyCtrl", function ($scope, $http) {

    $scope.loadData = function (companyCode) {
        $http.get('/ajax/company/' + companyCode).then(function (response) {
            let company = response.data.company;
            $scope.generalInfo = company.generalInfo;
            $scope.analysing4m = company.analysing4m;
            $scope.historicalData = indexHistoricalData(company.historicalData);
            $scope.yearList = Object.keys($scope.historicalData);
        });
    }

    function indexHistoricalData(historicalData) {
        let parsedData = {};

        angular.forEach(historicalData, function (datum) {
            let date = new Date(datum.fiscalDate.date);
            let year = String(date.getFullYear());
            parsedData[year] = datum;
        });

        return parsedData;
    }

    function formatVnd(amount) {
        if (amount === null) {
            return "--";
        }
        return Math.round(amount / 1000000000);
    }

    function formatRate(rate) {
        if (rate === null) {
            return "--";
        }
        let percentage = rate * 100;
        return percentage.toFixed(2) + " %";
    }

    $scope.getNetIncomeInYear = function (year) {
        return formatVnd($scope.historicalData[year].netIncome);
    }

    $scope.getNetIncomeYoyInYear = function (year) {
        return formatRate($scope.historicalData[year].netIncomeYoy);
    }

    $scope.getNopatInYear = function (year) {
        return formatVnd($scope.historicalData[year].nopat);
    }

    $scope.getNopatYoyInYear = function (year) {
        return formatRate($scope.historicalData[year].nopatYoy);
    }

    $scope.getEquityInYear = function (year) {
        return formatVnd($scope.historicalData[year].equity);
    }

    $scope.getEquityYoyInYear = function (year) {
        return formatRate($scope.historicalData[year].equityYoy);
    }

    $scope.getOperatingCashFlowInYear = function (year) {
        return formatVnd($scope.historicalData[year].operatingCashFlow);
    }

    $scope.getOperatingCashFlowYoyInYear = function (year) {
        return formatRate($scope.historicalData[year].operatingCashFlowYoy);
    }

    $scope.getRoicInYear = function (year) {
        return formatRate($scope.historicalData[year].roic);
    }

    function getKeysOfArray(array) {
        let iterator = array.keys();
        let keys = [];
        for (let x of iterator) {
            keys.push(x);
        }
        return keys;
    }
});

