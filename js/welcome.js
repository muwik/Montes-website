// //Раскрытие СЕО-текста
// var expandLongreadTrigger = document.querySelector('.mc-expand-longread-trigger');
// var toExpandElement = expandLongreadTrigger.getAttribute('data-mc-expand')
//
// expandLongreadTrigger.addEventListener('click', function() {
//     document.querySelector(toExpandElement).classList.add("mc-longread-info-expanded");
//     let toDisappearElement = expandLongreadTrigger.getAttribute('id')
//     document.getElementById(toDisappearElement).classList.add("mc-expanded-longread-trigger");
// });
//
dselect(document.querySelector('#mc-select-price-form'))
dselect(document.querySelector('#mc-select-price-currency'))
dselect(document.querySelector('#mc-select-price-lesson'))
dselect(document.querySelector('#mc-select-price-quantity'), {
    dropup: false
// })
