function navigation(slider) {
    let wrapper, dots, arrowLeft, arrowRight

    function markup(remove) {
        wrapperMarkup(remove)
        dotMarkup(remove)
        arrowMarkup(remove)
    }

    function removeElement(elment) {
        elment.parentNode.removeChild(elment)
    }

    function createDiv(className) {
        var div = document.createElement("div")
        var classNames = className.split(" ")
        classNames.forEach((name) => div.classList.add(name))
        return div
    }

    function arrowMarkup(remove) {
        if (remove) {
            removeElement(arrowLeft)
            removeElement(arrowRight)
            return
        }
        arrowLeft = createDiv("arrow arrow--left")
        arrowLeft.addEventListener("click", () => slider.prev())
        arrowRight = createDiv("arrow arrow--right")
        arrowRight.addEventListener("click", () => slider.next())

        wrapper.appendChild(arrowLeft)
        wrapper.appendChild(arrowRight)
    }

    function wrapperMarkup(remove) {
        if (remove) {
            var parent = wrapper.parentNode
            while (wrapper.firstChild)
                parent.insertBefore(wrapper.firstChild, wrapper)
            removeElement(wrapper)
            return
        }
        wrapper = createDiv("navigation-wrapper")
        slider.container.parentNode.appendChild(wrapper)
        wrapper.appendChild(slider.container)
    }

    function dotMarkup(remove) {
        if (remove) {
            removeElement(dots)
            return
        }
        dots = createDiv("dots")
        slider.track.details.slides.forEach((_e, idx) => {
            var dot = createDiv("dot")
            dot.addEventListener("click", () => slider.moveToIdx(idx))
            dots.appendChild(dot)
        })
        wrapper.appendChild(dots)
    }

    function updateClasses() {
        var slide = slider.track.details.rel
        slide === 0 ?
            arrowLeft.classList.add("arrow--disabled") :
            arrowLeft.classList.remove("arrow--disabled")
        slide === slider.track.details.slides.length - 1 ?
            arrowRight.classList.add("arrow--disabled") :
            arrowRight.classList.remove("arrow--disabled")
        Array.from(dots.children).forEach(function (dot, idx) {
            idx === slide ?
                dot.classList.add("dot--active") :
                dot.classList.remove("dot--active")
        })
    }

    slider.on("created", () => {
        markup()
        updateClasses()
    })
    slider.on("optionsChanged", () => {
        markup(true)
        markup()
        updateClasses()
    })
    slider.on("slideChanged", () => {
        updateClasses()
    })
    slider.on("destroyed", () => {
        markup(true)
    })
}

function ThumbnailPlugin(main) {
    return (slider) => {
        function removeActive() {
            slider.slides.forEach((slide) => {
                slide.classList.remove("active")
            })
        }

        function addActive(idx) {
            slider.slides[idx].classList.add("active")
        }

        function addClickEvents() {
            slider.slides.forEach((slide, idx) => {
                slide.addEventListener("click", () => {
                    main.moveToIdx(idx)
                })
            })
        }

        slider.on("created", () => {
            addActive(slider.track.details.rel)
            addClickEvents()
            main.on("animationStarted", (main) => {
                removeActive()
                const next = main.animator.targetIdx || 0
                addActive(main.track.absToRel(next))
                slider.moveToIdx(Math.min(slider.track.details.maxIdx, next))
            })
        })
    }
}

var slider = new KeenSlider("#my-keen-slider", {
    loop: true,
    breakpoints: {
        "(min-width: 576px)": {
            slides: {
                perView: 3,
                spacing: 20
            },
        },
        "(min-width: 768px)": {
            slides: {
                perView: 4,
                spacing: 20
            },
        },
        "(min-width: 992px)": {
            slides: {
                perView: 5,
                spacing: 20
            },
        },
    },
    slides: {
        perView: 1,
        spacing: 20
    },
}, [navigation])
setInterval(slider.next, 5000);

var slider = new KeenSlider("#my-keen-slider-recomend", {
    loop: false,
    breakpoints: {
        "(min-width: 575px)": {
            slides: {
                perView: 2.2,
                spacing: 20,
                origin: "center"
            },
        },
        "(min-width: 768px)": {
            slides: {
                perView: 3.2,
                spacing: 20,
                origin: "center"
            },
        },
        "(min-width: 992px)": {
            slides: {
                perView: 4.2,
                spacing: 20,
                origin: "center"
            },
            loop: true,
        },
        "(min-width: 1200px)": {
            slides: {
                perView: 5.2,
                spacing: 20,
                origin: "center"
            },
            loop: true,
        },
    },
    slides: {
        perView: 1.2,
        spacing: 20,
        origin: "center"
    },
}, [navigation]);

var slider = new KeenSlider("#my-keen-slider-reviews", {
    loop: true,
    breakpoints: {
        "(min-width: 992px)": {
            slides: {
                perView: 2,
                spacing: 20
            },
        },
    },
    slides: {
        perView: 1,
        spacing: 20
    },
}, [navigation]);

var sliderStory = new KeenSlider("#success-single-keen-slider", {
    loop: true,
    slides: {
        perView: 1,
        spacing: 20
    },
    slideChanged: (instance) => {
        thumbnailsStory.moveToIdx(sliderStory.track.details.rel),
            Array.from(thumbnailsStory.slides).forEach(function (el) {
                el.classList.remove('active');
            });
        thumbnailsStory.slides[sliderStory.track.details.rel].classList.add("active")
    }
}, [navigation]);

var thumbnailsStory = new KeenSlider("#success-single-thumbnails", {
        vertical: true,
        loop: true,
        slides: {
            perView: 3,
            spacing: 27
        },
    },
    [navigation]
);

let thumbnailsStorySelector = document.getElementById('success-single-thumbnails');
thumbnailsStory.slides[sliderStory.track.details.rel].classList.add("active")
Array.from(thumbnailsStory.slides).forEach(function (element, index) {
    element.addEventListener("click", function (e) {
        sliderStory.moveToIdx(index);
        console.log(thumbnailsStory)
        thumbnailsStorySelector.style.pointerEvents = "none";
        setTimeout(function () {
            thumbnailsStorySelector.style.pointerEvents = "auto";
        }, 250);
    });
});
