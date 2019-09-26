/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
peoples.controller('peoplesCtrl',function($scope){
$scope.FirstName="darshak";    
});
peoples.directive('peopledir',function(){
   return {
       restict:"M",
       template:"<h1>darshak</h1>"
   } ;
});


