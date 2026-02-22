

window.addEventListener('DOMContentLoaded', () => {




});

window.addEventListener('load', () => {


    initContactsSlider();

    initContactsForm();

});


let timerResize;
window.addEventListener('resize', () => {


    clearTimeout(timerResize);

    timerResize = setTimeout(() => {
        initContactsSlider();
    }, 120);




});



console.log('init contacts js...');

let sliderContacts = false;

function initContactsSlider() {

    const form = document.querySelector('#contacts-form');
    const divSliderContacts = document.querySelector('#contacts-slider');
    const slides = divSliderContacts.querySelectorAll('.contacts-slide');

    if (!form || !divSliderContacts || !slides.length) return;

    const inputDirectionId = form.querySelector('#direction_id');

    let currentActiveSlide = 1;


    function getDirectionSlide(i) {
        const direction_id = slides[i].getAttribute('data-direction');
        return direction_id;

    }

    function setDirection(fun, id) {
        if (inputDirectionId && id) {
            inputDirectionId.value = id;

        }
    }


    function getQueryParam(name) {
        const params = new URLSearchParams(window.location.search);
        return params.get(name);
    }

    const durectionIdUrl = getQueryParam('direction');

    if (durectionIdUrl) {

        slides.forEach((slide, index) => {
            const slideDirectionId = slide.getAttribute('data-direction');

            if (slideDirectionId == durectionIdUrl) {
                currentActiveSlide = index;

                setDirection('url', slideDirectionId);
                slideContactsChange(index);
            }
        })
    }

    if (window.innerWidth <= 800) {


        if (sliderContacts) return;


        sliderContacts = new Swiper(divSliderContacts, {
            slidesPerView: "auto",

            centeredSlides: true,
            spaceBetween: 10,
            initialSlide: currentActiveSlide,
            500: {
                spaceBetween: 20,
            },
            on: {
                slideChange: function () {

                    slideContactsChange(this.activeIndex);

                    const directionId = getDirectionSlide(this.activeIndex);
                    if (directionId) {
                        setDirection('slideChange', directionId);
                    }


                },
            },

        })


    } else {

        if (sliderContacts) {

            sliderContacts.destroy(true, true);
            sliderContacts = null;
        }

        slides.forEach((slide, i) => {

            slide.addEventListener('click', () => {
                slideContactsChange(i);

                const directionId = getDirectionSlide(i);
                if (directionId) {
                    setDirection('click', directionId);
                }

            })

            slide.addEventListener('mouseenter', () => {
                slideContactsChange(i);
                const directionId = getDirectionSlide(i);
                if (directionId) {
                    setDirection('mouseenter', directionId);
                }
            })

        })
    }




    function slideContactsChange(activeIndex) {

        currentActiveSlide = activeIndex;

        diretionImage = 'image-right';
        slides.forEach((slide, i) => {
            slide.classList.remove('image-left');
            slide.classList.remove('image-right');

            if (i == activeIndex) {
                slide.classList.add('active');
                diretionImage = 'image-left';
            } else {
                slide.classList.remove('active');
                slide.classList.add(diretionImage);
            }
        })

        const bgColor = slides[activeIndex].style.getPropertyValue('--color-contacts').trim();;

        if (bgColor) {
            form.style.setProperty('--form-bg', bgColor);
        }
    }
}


function initContactsForm() {
    console.log('initContactsForm: send data');
}