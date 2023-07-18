
    //Раскрытие СЕО-текста
    var expandLongreadTrigger = document.querySelector('.mc-expand-longread-trigger');
    var toExpandElement = expandLongreadTrigger.getAttribute('data-mc-expand')

    expandLongreadTrigger.addEventListener('click', function() {
    document.querySelector(toExpandElement).classList.add("mc-longread-info-expanded");
    let toDisappearElement = expandLongreadTrigger.getAttribute('id')
    document.getElementById(toDisappearElement).classList.add("mc-expanded-longread-trigger");
});
