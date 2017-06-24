var app = angular.module('App', []);

app.controller('mainCtrl', function($scope, $http) {

    var url_server = "http://localhost/projet/php/TP/proverbeApp/ajax.php";
    $scope.affMode = false;
    $scope.affMode2 = false;

    $scope.getProverb = function() {

        // requête ajax via le service $http
        var ct = this.prv;
        var url = url_server + "?action=list&cat=" + ct;
        
        $http.get(url).then(function(res) {

            $scope.prov = res.data;

        });
        $scope.affMode = true;
    };

    $scope.reset = function() {
        $scope.prv = "";
        $scope.affMode = false;
    };

    $scope.reset2 = function() {
        initProv();
        $scope.affMode2 = false;
    };

    function initProv() {

        $scope.proverbe = {

            origin: null,
            body: null,
            category: ""

        };
    }

    $scope.saveProverb = function() {

        $http.post(url_server, {proverbe: $scope.proverbe}).then(function(res) {

            $scope.affMode2 = true;
            $('span#message').text('Insertion de proverbe réussie !');
            

        });
    };

    $scope.deleteThisProverb = function() {
        var proverb_id = this.proverbe.id;

        var url = url_server + "?action=delete&id=" + proverb_id;

        $http.get(url).then(function(res) {
            $scope.affMode = false;
        });
        
    };

});
