/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

require('./bootstrap');


$(function () {
    $(".autocomplete").autocomplete({
        source: ["South Lucienne","Legrosside","North Wilmer","North Delaneyberg","Lake Estelle", "New York", "Warsaw", "Berlin", "Auckland", "Johannesburg", "Dubai"],
        minLength: 2,
        select: function (event, ui) {
            
            console.log(ui.item.value);
        }


    });
});

