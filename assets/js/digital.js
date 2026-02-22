window.addEventListener('DOMContentLoaded', () => {
    console.log('init digital js...');



});


window.addEventListener('load', () => {

    initDigitalScrollGSAP();
    initDigitalAnimationGSAP();
});



// При ресайзе (debounce)
function debounce(fn, wait = 200) {
    let t;
    return (...args) => {
        clearTimeout(t);
        t = setTimeout(() => fn(...args), wait);
    };
}

const onResize = debounce(() => {

    if (lenis && typeof lenis.resize === 'function') lenis.resize();

    ScrollTrigger.refresh();

}, 200);

window.addEventListener('resize', onResize);



function initDigitalScrollGSAP() {
    const heroDigital = document.querySelector('.hero-digital');
    const portfolio = document.querySelector('.portfolio');
    const portfolioWrap = document.querySelector('.portfolio-wrap');

    const preloaderWrap = document.querySelector('.portfolio-preloader-wrap');
    const preloaderBg = document.querySelector('.portfolio-preloader-bg');
    const video = document.querySelector('#mainVideo');
    const messageBox = document.querySelector('.hero-message-box');
    const herocardWrap = document.querySelector('.hero-card-wrap');

    const lineScroll = document.querySelector('#hero-card-scroll-wrap');
    const rectLineScroll = lineScroll.getBoundingClientRect();
    const heightLineScroll = rectLineScroll.height;


    const heroDigitalColor = heroDigital.style.getPropertyValue('--section-bg').trim();

    const isLight = heroDigitalColor ? this.isColorLight(heroDigitalColor) : 'is-dark';
    const themeHero = isLight ? 'is-light' : 'is-dark';


    gsap.set(portfolioWrap, { opacity: 0 });
    gsap.set(preloaderBg, {
        clipPath: 'inset(100px 40px 40px round 40px)',
        webkitClipPath: 'inset(100px 40px 40px 0px round 40px)',
    });

    // gsap.set(lineScroll, { opacity: 0, x: 40 });

    let theme = null;




    const tlPreloader = gsap.timeline({
        scrollTrigger: {
            trigger: preloaderWrap,
            start: "top bottom",
            end: `+=150%`, // Длина зависит от кол-ва секций
            // scrub: 1.8,
            scrub: true,
            // onEnter: () => console.log("Анимация началась (вниз)"),
            // onLeave: () => console.log("Анимация закончилась (вниз)"),
            // onEnterBack: () => console.log("Анимация началась (вверх)"),
            // onLeaveBack: () => console.log("Анимация закончилась (вверх)"),
            // markers: true,

        },

    })

    // tlPreloader.add(() => {
    //     gsap.to(messageBox, { opacity: 0 })
    // })
    tlPreloader.to(messageBox, { opacity: 0 })

    if (window.innerWidth > 1100) {

        tlPreloader.to(herocardWrap, { height: `${heightLineScroll}px` });
    }
    else {

        tlPreloader.to(herocardWrap, { autoAlpha: 0, duration: 0.5 }, '<');
    }



    tlPreloader.to(preloaderBg, {
        clipPath: 'inset(0px 0px 0px round 0px)',
        webkitClipPath: 'inset(0px 0px 0px 0px round 0px)',
        opacity: 1,




    }, '<+=0.2');




    tlPreloader.set(portfolioWrap, {
        opacity: 1,
        onComplete: () => {

            // console.log(portfolio.getAttribute('data-theme'));

            theme = portfolio.getAttribute('data-theme');
            setWrapTheme(theme);
            // gsap.to(lineScroll, { opacity: 1 });
            resetAndStartMarquee();
            // gsap.set(lineScroll, { opacity: 1, })
        },
        onReverseComplete: () => {

            // console.log(' stopMarquee()');
            // console.log(portfolio.getAttribute('data-theme'));

            setWrapTheme(themeHero);

        },
    });




    tlPreloader.to(lineScroll, { opacity: 1 });
    tlPreloader.to(preloaderWrap, { autoAlpha: 0 });







    function setWrapTheme(theme) {
        const addClass = theme;
        const removeClass = theme === 'is-light' ? 'is-dark' : 'is-light';
        if (!addClass) return;
        wrapper.classList.add(addClass);
        wrapper.classList.remove(removeClass);

    }



    // ? initMarquee


    const config = {
        direction: 'left', // 'left' или 'right'
        initialSpeed: 120, // пикселей в секунду
        // initialSpeed: 150, // пикселей в секунду
        delayBeforeSlow: 3, // через сколько начать замедляться (от старта движения)
        slowdownDuration: 2, // длительность замедления
        isInfinite: true, // бесконечно или с остановкой true / false
        startFromEdge: true // начинать "въезд" от края контейнера
    };

    let marqueeTl;
    let slowdownTween; // Отдельная ссылка на процесс замедления

    const initMarquee = () => {
        // 1. Тотальная очистка
        if (marqueeTl) {
            marqueeTl.kill();
            if (slowdownTween) slowdownTween.kill();
        }

        // Сбрасываем стили и удаляем клоны
        const content = document.querySelector('.hero-card-scroll-content');
        const item = document.querySelector('.hero-card-scroll-item');
        gsap.set(content, { clearProps: "all" });
        const items = document.querySelectorAll('.hero-card-scroll-item');
        for (let i = 1; i < items.length; i++) items[i].remove();

        const wrapper = document.querySelector('.hero-card-scroll-wrap');
        const wrapperWidth = wrapper.offsetWidth;
        const itemWidth = item.offsetWidth;

        const repeats = Math.ceil(wrapperWidth / itemWidth) + 2;
        for (let i = 0; i < repeats; i++) {
            content.appendChild(item.cloneNode(true));
        }

        if (config.startFromEdge) {
            gsap.set(content, { x: config.direction === 'left' ? wrapperWidth : -content.offsetWidth });
        }

        const directionFactor = config.direction === 'left' ? -1 : 1;

        // 2. Создаем таймлайн
        marqueeTl = gsap.timeline({ paused: true });

        if (config.startFromEdge) {
            const entryDistance = config.direction === 'left' ? wrapperWidth : -wrapperWidth;
            marqueeTl.to(content, {
                x: 0,
                duration: Math.abs(entryDistance) / config.initialSpeed,
                ease: "none"
            });
        }

        marqueeTl.to(content, {
            x: directionFactor * itemWidth,
            duration: itemWidth / config.initialSpeed,
            ease: "none",
            repeat: -1
        });
    };

    // --- ФУНКЦИИ УПРАВЛЕНИЯ (ПУЛЕСТОЙКИЕ) ---

    const startMarquee = () => {
        if (!marqueeTl) return;

        // Останавливаем старое замедление, если оно шло
        if (slowdownTween) slowdownTween.kill();

        // Сброс параметров воспроизведения
        marqueeTl.timeScale(1);
        marqueeTl.play();

        // Запускаем логику замедления заново
        if (!config.isInfinite) {
            slowdownTween = gsap.to(marqueeTl, {
                timeScale: 0,
                duration: config.slowdownDuration,
                delay: config.delayBeforeSlow,
                ease: "power1.out",
                overwrite: true // Важно: отменяет другие твины на этом объекте
            });
        }
    };

    const resetAndStartMarquee = () => {
        if (!marqueeTl) return;

        // Мгновенный сброс в начало
        marqueeTl.pause();
        marqueeTl.progress(0);

        // Запуск
        startMarquee();
    };

    const stopMarquee = () => {
        if (marqueeTl) {
            marqueeTl.pause();
            if (slowdownTween) slowdownTween.kill();
        }
    };

    initMarquee();



}





function initDigitalAnimationGSAP() {

    const sliderQrLinks = document.querySelectorAll('.portfolio-slider-link');

    sliderQrLinks.forEach(link => {

        link.addEventListener('click', (e) => {
            console.log('click');
            if (window.innerWidth > 1100) {
                e.preventDefault();
            }
        })
    })

    const portfolioState = {
        currentSliderIndex: 0, // Индекс текущего активного слайдера (от 0 до 7)
        isAnimating: false, // Флаг для блокировки кликов/скролла во время перехода 
        isMobile: window.innerWidth <= 1100, // Проверка устройства
        // Массив, где будут лежать все 8 созданных объектов Swiper
        sliders: [], // Массив экземпляров Swiper

        menuSwiper: null,

    };


    let clickHandler = null;
    function removeClickMenu() {
        const portfolioControlMenu = document.querySelector('.portfolio-control-menu');
        if (!portfolioControlMenu) return;

        if (clickHandler) {

            portfolioControlMenu.removeEventListener('click', clickHandler);
        }
    }

    function destroySwiper(slider) {
        slider.destroy(true, true);
        slider = null;

    }

    const sectionPortfolio = document.querySelector('.portfolio');
    // Функция установки класса на wrapper
    function setTheme(theme) {
        const addClass = theme;
        const removeClass = theme === 'is-light' ? 'is-dark' : 'is-light';
        if (!addClass) return;
        wrapper.classList.add(addClass);
        wrapper.classList.remove(removeClass);


        sectionPortfolio.classList.add(addClass);
        sectionPortfolio.classList.remove(removeClass);

        sectionPortfolio.setAttribute('data-theme', addClass);
    }




    const slidersContents = document.querySelectorAll('.portfolio-slider-contents');

    console.log('slidersContents ', slidersContents.length);

    async function initPortfolioSliders() {

        const sliderWraps = document.querySelectorAll('.portfolio-slider-wrap');

        for (let i = 0; i < sliderWraps.length; i++) {
            const wrap = sliderWraps[i];

            const color = wrap.style.getPropertyValue('--slider-bg').trim() || getComputedStyle(wrap).getPropertyValue('--slider-bg').trim();
            const isLight = this.isColorLight(color);
            const theme = isLight ? 'is-light' : 'is-dark';
            wrap.setAttribute('data-theme', theme);
            wrap.classList.add(theme);

            slidersContents[i].classList.add(theme);

            const sliderEl = wrap.querySelector('.portfolio-slider');
            // Инициализируем Swiper для каждого блока

            const swiperInstance = new Swiper(sliderEl, {
                slidesPerView: 1,
                speed: 800,
                allowTouchMove: true, // Позволяем листать картинки внутри слайдера

                navigation: {
                    nextEl: wrap.querySelector('.portfolio-slider-btn-next'),
                    prevEl: wrap.querySelector('.portfolio-slider-btn-prev'),
                },
                pagination: {
                    el: wrap.querySelector('.portfolio-slider-pagination'),
                    // clickable: true,
                },
                on: {
                    slideChange: function () {
                        // Здесь позже добавим вызов анимации контента (SplitText)
                        // console.log(this);

                        // setWrapperTheme(theme);



                        // animateContent(index, this.activeIndex);
                        // animateContent(index, swiperInstance.activeIndex);

                        console.log(`Слайдер ${i}, слайд изменился на ${this.activeIndex}`);
                        console.log('');
                        console.log('');

                        console.log('Текущий слайдер: ', i);
                        console.log('Текущий слайд: ', this.previousIndex);

                        console.log('Новый слайдер: ', i);
                        console.log('Новый слайд: ', this.activeIndex);
                        console.log('');
                        console.log('');

                        animationContent(i, this.previousIndex, i, this.activeIndex);
                    }
                }
            });

            portfolioState.sliders.push(swiperInstance);

            // Скрываем все слайдеры, кроме первого 
            if (i !== 0) {
                // gsap.set(wrap, { yPercent: 100, autoAlpha: 0 });
                gsap.set(wrap, { zIndex: 1, opacity: 0 });
            }


            await new Promise(resolve => setTimeout(resolve, 10));

        }



    }

    initPortfolioSliders();


    const menuBtns = document.querySelectorAll('.portfolio-menu-btn');
    function addCursorpointerBtns() {
        menuBtns.forEach(btn => {
            btn.style.cursor = 'pointer';
        })
    }
    function removeCursorpointerBtns() {
        menuBtns.forEach(btn => {
            btn.style.cursor = 'auto';
        })
    }





    let splitContents = [];

    let tlSplitContent = null;
    let tlContent = null;

    function animationContent(prevIndex, prevSlideIdx, nextIndex, nextSlideIdx) {


        // ? Desktop
        if (!portfolioState.isMobile) {

            if (!splitContents.length) {
                portfolioState.isAnimating = false; // Снимаем блокировку
                return;
            }

            if (tlSplitContent) {
                tlSplitContent.kill();
                tlSplitContent = null;
            }



            tlSplitContent = gsap.timeline({
                onComplete: () => {
                    console.log('Complete');
                    portfolioState.isAnimating = false; // Снимаем блокировку
                    addCursorpointerBtns();
                }
            });


            const prevSplitTitle = splitContents[prevIndex][prevSlideIdx].title;
            const prevSplitDesc = splitContents[prevIndex][prevSlideIdx].desc;


            if (prevSplitTitle.chars.length) {
                tlSplitContent.to(prevSplitTitle.chars, {
                    opacity: 0,
                    stagger: { each: 0.01, from: "end" },
                    // duration: 0.3,
                });
            }
            if (prevSplitDesc.chars.length) {
                tlSplitContent.to(prevSplitDesc.chars, {
                    opacity: 0,
                    stagger: { each: 0.005, from: "end" },
                    // duration: 0.3,
                }, '<+=0.05');
            }

            // tlSplitContent.to([prevSplitTitle.chars || [], prevSplitDesc.chars || []], {
            //     opacity: 0,
            //     stagger: { each: 0.005, from: "end" },
            //     duration: 0.3,
            // });

            const nextSplitTitle = splitContents[nextIndex][nextSlideIdx].title;
            const nextSplitDesc = splitContents[nextIndex][nextSlideIdx].desc;
            if (nextSplitTitle.chars.length) {
                gsap.set(nextSplitTitle.chars, { opacity: 0 });
            }
            if (nextSplitDesc.chars.length) {
                gsap.set(nextSplitDesc.chars, { opacity: 0 });
            }
            // gsap.set([nextSplitTitle.chars || [], nextSplitDesc.chars || []], { opacity: 0 });
            // tlContent.fromTo(nextSplitTitle.chars, { opacity: 0 }, { opacity: 1, stagger: 0.02, duration: 0.5, ease: "power2.out" }, "-=0.1");
            // tlContent.fromTo(nextSplitDesc.chars, { opacity: 0 }, { opacity: 1, stagger: 0.01, duration: 0.4, ease: "power2.out" }, "-=0.3");

            if (nextSplitTitle.chars.length) {
                tlSplitContent.to(nextSplitTitle.chars || [], { opacity: 1, stagger: 0.02, ease: "power2.out" }, '+=0.1');
            }
            if (nextSplitDesc.chars.length) {
                tlSplitContent.to(nextSplitDesc.chars || [], { opacity: 1, stagger: 0.01, ease: "power2.out" }, '<+=0.2');
            }


            if (prevSplitTitle.chars.length) {
                tlSplitContent.set(prevSplitTitle.chars, { opacity: 0 });
            }
            if (prevSplitDesc.chars.length) {
                tlSplitContent.set(prevSplitDesc.chars, { opacity: 0 });
            }
            // tlSplitContent.set([prevSplitTitle.chars || [], prevSplitDesc.chars || []], { opacity: 0 });

        }

        // ? Mobile
        else {
            console.log('Mobile');

            const prevContents = slidersContents[prevIndex].querySelectorAll('.portfolio-slide-content');
            const nextContents = slidersContents[nextIndex].querySelectorAll('.portfolio-slide-content');

            const prevContent = prevContents[prevSlideIdx];
            const nextContent = nextContents[nextSlideIdx];

            // console.log(prevContent);
            // console.log(nextContent);

            if (tlContent) {
                tlContent.kill();
                tlContent = null;
            }

            tlContent = gsap.timeline({
                onComplete: () => {
                    console.log('Complete');
                    portfolioState.isAnimating = false; // Снимаем блокировку

                }
            });

            tlContent.to(prevContent, { y: 20, opacity: 0, duration: 0.2 });

            gsap.set(nextContent, { opacity: 0 });
            tlContent.to(nextContent, { y: 0, opacity: 1 }, '+=0.2');

            tlContent.set(prevContent, { opacity: 0 });


        }

    }



    // const theme = wrap.getAttribute('data-theme');
    //                         console.log(theme);

    const wrapSliders = document.querySelectorAll('.portfolio-slider-wrap');
    // console.log(wrapSliders);



    const mm = gsap.matchMedia();

    mm.add('(min-width: 1101px)', () => {



        portfolioState.isMobile = false;

        let eventClick = false;

        if (portfolioState.menuSwiper) {
            destroySwiper(portfolioState.menuSwiper)
        }
        portfolioState.menuSwiper = null;
        portfolioState.menuSwiper = new Swiper('.portfolio-menu-slider', {
            direction: 'vertical',
            // slidesPerView: 7,
            allowTouchMove: false,
            slidesPerView: 5,
            centeredSlides: true,
            // centeredSlides: false, //
            // touchRatio: 1,
            // shortSwipes: false,
            // mousewheel: true,

            // mousewheel: {
            //     releaseOnEdges: false,
            //     invert: false, // Не инвертировать скролл
            //     sensitivity: 1, // Чувствительность
            // },

            loop: true,

            spaceBetween: 0,
            // slideToClickedSlide: true, // Клик по кнопке центрирует её 
            // mousewheel: true, // Позволяет переключать скроллом в этой области 
            // mousewheel: {
            //     forceToAxis: true,
            //     releaseOnEdges: false
            // },

            on: {
                slideChange: function () {

                    // console.log('slideChange');
                    // console.log('this.realIndex ', this.realIndex);
                    // console.log('portfolioState.currentSliderIndex ', portfolioState.currentSliderIndex);


                    // console.log('');
                    // console.log('this.activeIndex', this.activeIndex);
                    // console.log('this.slides[this.activeIndex]', this.slides[this.activeIndex]);
                    // console.log('');

                    // Получаем реальный индекс слайда (с учетом loop)

                    if (!eventClick) {
                        const realIndex = this.realIndex;

                        if (realIndex !== portfolioState.currentSliderIndex) {
                            // console.log('switchToSlider(realIndex) ', realIndex);
                            // switchToSlider(realIndex);
                            console.log('slideChange ', realIndex);
                            // console.log('portfolioState.isAnimating ', portfolioState.isAnimating);
                            switchToSlider(realIndex);
                        }
                    }

                },

            }

        });




        // portfolioState.menuSwiper.on('slideChangeTransitionEnd', function () {
        //     console.log('slideChangeTransitionEnd ', this.realIndex);
        //     if (this.realIndex !== portfolioState.currentSliderIndex) {

        //         switchToSlider(this.realIndex);
        //     }
        // });

        // console.log(portfolioState.menuSwiper);

        // ? Content
        // ? Content
        // ? Content


        //    Текущий слайдер:  1
        // Текущий слайд:  1

        // Новый слайдер:  0
        // Новый слайд:  0




        splitContents = [];

        let timerContentId = null;
        async function initSplitContent() {
            const contents = document.querySelectorAll('.portfolio-slide-content');
            contents.forEach(content => {
                content.style.display = 'none';
            })


            const sliderContents = document.querySelectorAll('.portfolio-slider-contents');


            for (let index = 0; index < sliderContents.length; index++) {

                const contents = sliderContents[index].querySelectorAll('.portfolio-slide-content');

                const tempSplitContent = [];
                for (let i = 0; i < contents.length; i++) {

                    // let obj = {
                    //     title: 'Slider ' + index + 'Title slide' + i,
                    //     desc: 'Slider ' + index + 'Desc slide' + i
                    // }

                    const title = contents[i].querySelector('.portfolio-slide-title');
                    const desc = contents[i].querySelector('.portfolio-slide-desc');

                    const titleSplit = title ? new SplitText(title, { type: 'chars, words' }) : { chars: [] };
                    const descSplit = desc ? new SplitText(desc, { type: 'chars, words' }) : { chars: [] };

                    let obj = {
                        title: titleSplit,
                        desc: descSplit,
                    }

                    tempSplitContent.push(obj);



                    if (titleSplit.chars.length) {

                        gsap.set(titleSplit.chars, { opacity: 0 });
                    }
                    if (descSplit.chars.length) {

                        gsap.set(descSplit.chars, { opacity: 0 });
                    }


                    if (index == 0 && i == 0) {
                        if (titleSplit.chars.length) {
                            gsap.set(titleSplit.chars, { opacity: 1 });
                        }
                        if (descSplit.chars.length) {
                            gsap.set(descSplit.chars, { opacity: 1 });
                        }
                    }


                    await new Promise(resolve => setTimeout(resolve, 10));
                }

                splitContents.push(tempSplitContent);


            }




            console.log('End');
            contents.forEach(content => {
                content.style.display = 'block';
            })


            console.log('content block');

            checkAnchorScroll();


        }



        timerContentId = setTimeout(() => {
            clearTimeout(timerContentId);

            initSplitContent();

        }, 1000);



        console.log('');
        console.log('');
        console.log('splitContents ', splitContents);
        console.log('');
        console.log('');

        // ? Content
        // ? Content
        // ? Content
        // ? Content
        // ? Content



        function addClickMenu() {
            const portfolioControlMenu = document.querySelector('.portfolio-control-menu');
            if (!portfolioControlMenu) return;

            clickHandler = (e) => {

                if (portfolioState.isAnimating) return;



                const isCentered = !!portfolioState.menuSwiper.params.centeredSlides;

                const btn = e.target.closest('.portfolio-menu-btn');
                if (isCentered && btn) {

                    eventClick = true;
                    removeCursorpointerBtns();

                    const idx = parseInt(btn.getAttribute('data-index'));
                    portfolioState.menuSwiper.slideToLoop(idx, 1000, true);

                    switchToSlider(idx);
                    eventClick = false;
                }

            }


            portfolioControlMenu.addEventListener('click', clickHandler);
        }
        addClickMenu();

        const sliderEl = document.querySelector('.portfolio-control-menu'); // или более точный селектор
        let isOver = false;

        sliderEl.addEventListener('mouseenter', () => { isOver = true; });
        sliderEl.addEventListener('mouseleave', () => { isOver = false; });

        // Перехватываем wheel и предотвращаем прокрутку страницы.
        // Важно: passive: false, чтобы preventDefault работал.
        function onWheel(e) {
            if (!isOver) return;
            // Если нужно — можно фильтровать по небольшой дельте, чтобы позволить "медленную" прокрутку.
            e.preventDefault();
            e.stopPropagation();
            // Даем Swiper обработать прокрутку — mousewheel модуль обычно слушает wheel на контейнере.
            // Если Swiper не среагировал, можно вручную вызвать slideNext/slidePrev:

            if (portfolioState.isAnimating) return;

            const delta = e.deltaY;
            if (Math.abs(delta) < 1) return;
            if (delta > 0) portfolioState.menuSwiper.slideNext();
            else portfolioState.menuSwiper.slidePrev();
        }

        // Навешиваем с passive: false
        sliderEl.addEventListener('wheel', onWheel, { passive: false });





        // ? переключение слайдеров Desktop

        // ? flag first content
        function switchToSlider(nextIndex) {


            if (portfolioState.isAnimating || nextIndex === portfolioState.currentSliderIndex) return;



            portfolioState.isAnimating = true; // Блокируем ввод

            const prevIndex = portfolioState.currentSliderIndex;
            portfolioState.currentSliderIndex = nextIndex;

            const wraps = document.querySelectorAll('.portfolio-slider-wrap');
            const currentWrap = wraps[prevIndex];
            const nextWrap = wraps[nextIndex];



            const prevSlideIdx = portfolioState.sliders[prevIndex].activeIndex;
            // Берем индекс активного слайда из ТОГО слайдера, на который переходим
            const nextSlideIdx = portfolioState.sliders[nextIndex].activeIndex;
            // console.log('nextIndex ', nextIndex);
            // console.log('targetSlideIdx ', targetSlideIdx);


            console.log('Текущий слайдер: ', prevIndex);
            console.log('Текущий слайд: ', prevSlideIdx);

            console.log('Новый слайдер: ', nextIndex);
            console.log('Новый слайд: ', nextSlideIdx);



            // ? Запускаем магию букв
            // animateContent(nextIndex, nextSlideIdx);

            // Находим старый и новый блоки
            // const currentContent = document.querySelector('.portfolio-slide-content.is-active');
            // const nextContent = document.querySelector(`.portfolio-slide-content[data-slider="${nextIndex}"][data-slide="${nextSlideIdx}"]`);

            // console.log(`Попытка анимировать: Слайдер ${nextIndex}, Слайд ${nextSlideIdx}`);


            animationContent(prevIndex, prevSlideIdx, nextIndex, nextSlideIdx);


            const theme = wrapSliders[nextIndex].getAttribute('data-theme');
            setTheme(theme);

            // ? Запускаем магию букв

            // enableVerticalInteraction();
            // GSAP Анимация смены (базовая логика: текущий вверх, новый уже под ним или проявляется) 
            const tl = gsap.timeline({
                onComplete: () => {
                    // portfolioState.isAnimating = false; // Снимаем блокировку
                }
            });

            tl.set(nextWrap, { zIndex: 3 });

            // Текущий слайдер уходит вверх 
            tl.to(currentWrap, {
                yPercent: -100,
                duration: 1,
                // opacity: 0,
                ease: "power2.inOut",
                // onComplete: () => {
                //     const theme = wrapSliders[nextIndex].getAttribute('data-theme');
                //     setTheme(theme);


                // }
            });
            tl.to(nextWrap, { opacity: 1, duration: 0.5 }, '<');

            // tl.set(currentWrap, { opacity: 0 });
            tl.set(currentWrap, { yPercent: 0, zIndex: 1, opacity: 0 });
            tl.set(nextWrap, { zIndex: 5 });
        }








        // ? Якорь
        // portfolioState.menuSwiper.slideTo(2, 500);

        function checkAnchorScroll() {
            const target = sessionStorage.getItem('openPortfolioSlider');
            if (!target) return;

            sessionStorage.removeItem('openPortfolioSlider');
            const newIndex = parseInt(target);

            // portfolioState.menuSwiper.slideToLoop(newIndex, 500, true);

            // даём браузеру и ScrollTrigger время на layout (можно слушать imagesLoaded, если много картинок)
            const waitForReady = 100; // 50-200ms, или используйте Promise когда все изображения загружены
            setTimeout(() => {
                // обязателен refresh перед вычислением позиции

                ScrollTrigger.refresh();



                // вычисляем позицию прокрутки: обычно начало wrap (где start: 'top top')
                const portfolioWrap = document.querySelector('#portfolio');
                const targetY = portfolioWrap.getBoundingClientRect().top + window.pageYOffset + window.innerHeight / 2;

                // плавный скролл к началу анимации (или чуть раньше, если хотите проиграть вступление)
                gsap.to(window, {
                    duration: 3,
                    scrollTo: { y: targetY, autoKill: false },
                    ease: 'power2.inOut',
                    onComplete() {
                        // eventClick = true;
                        // обновим триггеры после прокрутки
                        ScrollTrigger.refresh();
                        // portfolioState.menuSwiper.slideToLoop(newIndex, 500, true);

                        // eventClick = false;
                        // 3. Переключаем слайдер
                        // switchToSlider(newIndex);
                        // switchToSlider(newIndex);

                        eventClick = true;

                        portfolioState.menuSwiper.slideToLoop(newIndex, 500, true);
                        switchToSlider(newIndex);

                        eventClick = false;

                        // portfolioState.isAnimating = false;
                        // if (!isMobile) {
                        //     if (portfolioState.menuSwiper && portfolioState.menuSwiper.mousewheel) portfolioState.menuSwiper.mousewheel.enable();
                        // }

                    }
                });
            }, waitForReady);

        }



        return () => {
            removeClickMenu();
            if (portfolioState.menuSwiper) {
                destroySwiper(portfolioState.menuSwiper)
                console.log(portfolioState.menuSwiper);
            }


            if (splitContents.length) {

                for (let i = 0; i < splitContents.length; i++) {
                    const sliderContents = splitContents[i];


                    for (let y = 0; y < sliderContents.length; y++) {
                        const content = sliderContents[y];

                        content.title.revert()
                        content.desc.revert()

                    }

                }
                splitContents.length = 0;

                console.log(splitContents);
            }


        }
    })

    mm.add('(max-width: 1100px)', () => {

        portfolioState.isMobile = true;

        removeClickMenu();
        if (portfolioState.menuSwiper) {
            destroySwiper(portfolioState.menuSwiper)
        }


        portfolioState.menuSwiper = null;
        console.log('portfolioState.menuSwiper ', portfolioState.menuSwiper);


        // const contents = document.querySelectorAll('.portfolio-slide-content');

        // gsap.set(contents, { y: 20, opacity: 0 });

        const sliderContents = document.querySelectorAll('.portfolio-slider-contents');

        sliderContents.forEach((sliderContent, index) => {
            const contents = sliderContent.querySelectorAll('.portfolio-slide-content');
            contents.forEach((content, i) => {

                gsap.set(content, { y: 20, opacity: 0 });

                if (index == 0 && i == 0) {

                    gsap.set(content, { y: 0, opacity: 1 });
                }

            })
        })


        portfolioState.menuSwiper = new Swiper('.portfolio-menu-slider', {
            direction: 'horizontal',
            slidesPerView: 'auto',
            centeredSlides: true,
            spaceBetween: 20,
            on: {
                slideChange: function () {

                    console.log('switchToSlider', this.activeIndex);
                    switchToSlider(this.activeIndex);

                }
            }
        });

        // ? flag first content show
        function switchToSlider(nextIndex) {
            if (portfolioState.isAnimating || nextIndex === portfolioState.currentSliderIndex) return;

            // portfolioState.isAnimating = true; // Блокируем ввод

            const prevIndex = portfolioState.currentSliderIndex;
            portfolioState.currentSliderIndex = nextIndex;

            const wraps = document.querySelectorAll('.portfolio-slider-wrap');
            const currentWrap = wraps[prevIndex];
            const nextWrap = wraps[nextIndex];

            // Берем индекс активного слайда из ТОГО слайдера, на который переходим
            // const targetSlideIdx = portfolioState.sliders[nextIndex].activeIndex;

            const theme = wrapSliders[nextIndex].getAttribute('data-theme');
            setTheme(theme);

            // Запускаем магию букв
            // animateContent(nextIndex, targetSlideIdx);
            const prevSlideIdx = portfolioState.sliders[prevIndex].activeIndex;
            // Берем индекс активного слайда из ТОГО слайдера, на который переходим
            const nextSlideIdx = portfolioState.sliders[nextIndex].activeIndex;

            animationContent(prevIndex, prevSlideIdx, nextIndex, nextSlideIdx);

            const tl = gsap.timeline();

            tl.set(nextWrap, { opacity: 1 });
            // tl.set(nextWrap, { yPercent: 0, opacity: 1 });
            tl.to(currentWrap, { opacity: 0, duration: 0.4 });
            // tl.to(currentWrap, { yPercent: 100, duration: 0.5 });
            tl.set(nextWrap, { zIndex: 5 });
            tl.set(currentWrap, { zIndex: 1 });

            // gsap.set(nextWrap, { opacity: 1 });

            // gsap.set(currentWrap, { opacity: 0, zIndex: 1, });

            // gsap.set(nextWrap, {  zIndex: 5 });
        }




        // ? Якорь
        // portfolioState.menuSwiper.slideTo(2, 500);

        const target = sessionStorage.getItem('openPortfolioSlider');


        if (!target) return;

        sessionStorage.removeItem('openPortfolioSlider');
        const newIndex = parseInt(target);





        // даём браузеру и ScrollTrigger время на layout (можно слушать imagesLoaded, если много картинок)
        const waitForReady = 100; // 50-200ms, или используйте Promise когда все изображения загружены
        setTimeout(() => {
            // обязателен refresh перед вычислением позиции

            ScrollTrigger.refresh();

            // portfolioState.menuSwiper.slideTo(newIndex, 500);

            // вычисляем позицию прокрутки: обычно начало wrap (где start: 'top top')
            const portfolioWrap = document.querySelector('#portfolio');
            const targetY = portfolioWrap.getBoundingClientRect().top + window.pageYOffset + window.innerHeight / 2;

            // плавный скролл к началу анимации (или чуть раньше, если хотите проиграть вступление)
            gsap.to(window, {
                duration: 2,
                scrollTo: { y: targetY, autoKill: false },
                // scrollTo: { y: targetY, autoKill: false },
                ease: 'power2.inOut',

                onComplete() {

                    // обновим триггеры после прокрутки
                    ScrollTrigger.refresh();

                    portfolioState.menuSwiper.slideTo(newIndex, 500);

                    // 3. Переключаем слайдер
                    // switchToSlider(newIndex);
                    // switchToSlider(newIndex);

                    // portfolioState.isAnimating = false;
                    // if (!isMobile) {
                    //     if (portfolioState.menuSwiper && portfolioState.menuSwiper.mousewheel) portfolioState.menuSwiper.mousewheel.enable();
                    // }

                }
            });
        }, waitForReady);




        return () => {
            if (portfolioState.menuSwiper) {
                destroySwiper(portfolioState.menuSwiper)
                console.log(portfolioState.menuSwiper);

            }

            // gsap.set(contents, { y: 20, opacity: 1 });

        }
    })


}