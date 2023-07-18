
//Раскрытие СЕО-текста
// var expandLongreadTrigger = document.querySelector('.mc-expand-longread-trigger');
// var toExpandElement = expandLongreadTrigger.getAttribute('data-mc-expand')

// expandLongreadTrigger.addEventListener('click', function() {
//     document.querySelector(toExpandElement).classList.add("mc-longread-info-expanded");
//     let toDisappearElement = expandLongreadTrigger.getAttribute('id')
//     document.getElementById(toDisappearElement).classList.add("mc-expanded-longread-trigger");
// });
//
//     document.getElementById('yt-thumb').addEventListener('click', function() {
//     var playerDiv = document.createElement('div');
//     playerDiv.setAttribute('id', 'yt-player-container');
//     document.getElementById('yt-player').appendChild(playerDiv);
//     document.getElementById('yt-thumb-wrapper').style.display = 'none';
//     loadVideo();
// });

$(document).ready(function(){
    $(".mc-about-text-link").on("click", function (event) {
        event.preventDefault();
        var id  = $(this).attr('href'),
            top = $(id).offset().top - 80;
        $('body,html').animate({scrollTop: top}, 150);
    });
});

var thumb = document.getElementById('yt-thumb');
if (thumb) {
    thumb.addEventListener('click', function () {
        var playerDiv = document.createElement('div');
        playerDiv.setAttribute('id', 'yt-player-container');
        document.getElementById('yt-player').appendChild(playerDiv);
        var thumbWrapper = document.getElementById('yt-thumb-wrapper');
        if (thumbWrapper) {
            thumbWrapper.style.display = 'none';
        }
        loadVideo();
    });
}

function loadVideo() {
    var tag = document.createElement('script');
    tag.src = 'https://www.youtube.com/iframe_api';
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    var player;

    window.onYouTubeIframeAPIReady = function () {
        player = new YT.Player('yt-player-container', {
            height: '100%',
            width: '100%',
            videoId: '3TiYGxOQDYw',
            playerVars: {
                'autoplay': 1,
                'controls': 1,
                'enablejsapi': 1,
                'fs': 1,
                'modestbranding': 1,
                'rel': 0
            },
            events: {
                'onReady': onPlayerReady
            }
        });
    };

    function onPlayerReady(event) {
        event.target.playVideo();
    }
}

//Раскрытие СЕО-текста
var expandLongreadTrigger = document.querySelector('.mc-expand-longread-trigger');
var toExpandElement = expandLongreadTrigger.getAttribute('data-mc-expand')

expandLongreadTrigger.addEventListener('click', function () {
    document.querySelector(toExpandElement).classList.add("mc-longread-info-expanded");
    let toDisappearElement = expandLongreadTrigger.getAttribute('id')
    document.getElementById(toDisappearElement).classList.add("mc-expanded-longread-trigger");
});

var sidebar = new StickySidebar('#sidebar', {
    containerSelector: '#main-content',
    innerWrapperSelector: '.sidebar__inner',
    topSpacing: 100,
    bottomSpacing: 0
});


