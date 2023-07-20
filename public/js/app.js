//! Setup
const app = angular.module('app', []).config(function($interpolateProvider) {
    $interpolateProvider.startSymbol('@{').endSymbol('}');
});


//! Service
app.service('productService', function($http) { //! can't use arrow func

    this.getProductAll = () => {
        return $http.get('/api/product');
    };

    this.searchProduct = (value) => {
        return $http({
            url: '/api/product/search', 
            method: 'post',
            data: {
                word: value
            }
        });
    };

});


app.service('categoryService', function($http) { //! can't use arrow func

    this.getCategoryAll = () => {
        return $http.get('/api/category');
    };

});



//! Main
app.controller('controller', ($scope, productService, categoryService) => {
    
    //- Section function scope
    $scope.getProductList = ($category = null) => {

        $scope.category_onSelect = $category;

        productService.getProductAll().then((res) => {
            !res.data.status && toastr.error('Get data product error!');
            $scope.data_products = res.data.value;
            
            if ($category) {
                $scope.data_products = $scope.data_products.filter(item => item.category_id === $category.id);
            }
        })
        
    }
    
    $scope.getCategoryList = () => {
        categoryService.getCategoryAll().then((res) => {
            !res.data.status && toastr.error('Get data category error!');
            $scope.data_category = res.data.value;
        })
    }


    $scope.searchProduct = (eventInput) => {
        productService.searchProduct(eventInput.target.value).then((res) => {
            !res.data.status &&  toastr.error('Search data product failed!');
            $scope.data_products = res.data.value;
        })
    }

    // Other
    $scope.getJSON = (data) => {
        return JSON.stringify(data);
    }


    //- Section main
    $scope.getProductList();
    $scope.getCategoryList();


    //- Section setup variable
    $scope.data_products = [];
    $scope.data_category = [];
    $scope.category_onSelect = null;

});
