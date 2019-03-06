var fichier = angular.module("projetS4Test", []);
fichier.module('TableFilterApp', [])
  .controller('TableFilterController', function($scope) {
    $scope.persos = [
      {
        id: 0,
        nom: "jacques",
        prenom : "delarue",
        moyenne :17
      },
      {
        id: 1,
        nom: "batman",
        prenom : "delarue",
        moyenne :10
      },
      {
        id: 2,
        nom: "superman",
        prenom : "jackson",
        moyenne :12
      },
      {
        id: 3,
        nom: "albert",
        prenom : "foot",
        moyenne :7
      }
    ];

  });
