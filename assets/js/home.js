


window.addEventListener('DOMContentLoaded', () => {


});

window.addEventListener('load', () => {


    // ? init script
    initHeroSlider();
    initHomePortfolioSlider();

    // ? GSAP
    initAnimationCardsGSAP();
    initServicesGSAP();


});



// Хранилище для анимаций/триггеров (можно для нескольких секций)
const animations = {

    section2: null,
    section3: null,
};




// ? =========================================


// ? Home initHeroSlider


let heroSliderActive = false;

function initHeroSlider() {
    // console.log(isMobile());

    if (heroSliderActive || isMobile()) return;





    const heroSlider = document.querySelector('#hero-slider');

    const heroThumbs = document.querySelectorAll('.hero-thumb');
    const heroSlides = document.querySelectorAll('.hero-slide');

    const mainVideo = document.querySelector('#mainVideo');
    // const deferredContainer = document.querySelectorAll('.deferredContainer');
    // const deferredContainer = document.getElementById('deferredContainer');

    if (heroThumbs.length == 0 || heroSlides.length == 0 || !mainVideo || !heroSlider) return;



    let hoverVideo = null;
    let hoverVideoTimer = null;

    const HOVER_LOAD_DELAY = 80; // ms, небольшая задержка чтобы избежать лишних загрузок
    const supportsAutoplay = true; // assuming muted autoplay works; otherwise handle click to unmute
    // const timelines = [];

    let hoverTimer = null;


    // ? add video
    // Создаём overlay video элемент при первом hover, но не присваиваем src до задержки
    function createHoverVideo() {
        const v = document.createElement('video');
        // v.className = 'deferred-video fade-in';
        v.className = 'deferred-video';
        v.playsInline = true;
        v.muted = true;
        v.loop = true;
        v.autoplay = true;
        v.preload = 'metadata'; // metadata, потом можно обновить если нужно
        v.style.zIndex = 5;
        v.setAttribute('aria-hidden', 'false');
        v.style.pointerEvents = 'none'; // чтобы миниатюры оставались интерактивными
        return v;
    }


    // При hover/focus на миниатюре — подгружаем и воспроизводим соответствующее видео во временном overlay
    function onThumbEnter(e, slide) {

        const videoSlide = slide.querySelector('video');

        if (videoSlide) {
            if (videoSlide.paused) {
                try { videoSlide.play(); } catch (e) { /* ignore */ }
            }

            return;
        }


        // console.log('videoSlide ', videoSlide);



        const el = e.currentTarget;
        const src = el.dataset.video;
        const poster = el.dataset.poster;
        if (!src) return;

        const heroSlideVideo = slide.querySelector('.hero-slide-video');

        if (!heroSlideVideo) return;


        clearTimeout(hoverVideoTimer);
        // Если уже показывается то же видео — ничего не делать
        if (hoverVideo && hoverVideo.dataset.src === src) return;

        hoverVideoTimer = setTimeout(() => {
            // Удаляем старый hoverVideo
            // if (hoverVideo) {
            //     console.log('del video');
            //     hoverVideo.pause();
            //     hoverVideo.remove();
            //     hoverVideo = null;
            // }
            hoverVideo = createHoverVideo();
            hoverVideo.dataset.src = src;
            // ставим poster быстро (кешируемые миниатюры) для мгновенного отображения
            if (poster) hoverVideo.poster = poster;
            // Добавляем источник и встраиваем в DOM поверх main видео
            const srcElem = document.createElement('source');
            srcElem.src = src;
            srcElem.type = 'video/mp4';
            hoverVideo.appendChild(srcElem);
            // Добавляем во DOM и даём браузеру начать загрузку
            heroSlideVideo.appendChild(hoverVideo);
            heroSlideVideo.style.display = 'block';
            // Перенести в DOM дерева над main
            // document.getElementById('player').appendChild(hoverVideo);
            // Небольшая задержка, чтобы браузер успел начать buffered playback
            hoverVideo.play().catch(() => {/* ignore autoplay-block */ });
        }, HOVER_LOAD_DELAY);
    }

    function onThumbLeave(slide) {
        const videoSlide = slide.querySelector('video');
        if (videoSlide) {
            if (!videoSlide.paused) {
                try {
                    videoSlide.pause();
                    // videoSlide.currentTime = 0
                } catch (e) { /* ignore */ }
            }
        }

        clearTimeout(hoverVideoTimer);

        // if (!hoverVideo) return;
        // Плавно удалить hoverVideo и оставить main воспроизводящимся
        // hoverVideo.pause();
        // hoverVideo.remove();
        // hoverVideo = null;
    }


    // ? add video

    heroSlides.forEach((slide, index) => {

        let tl = gsap.timeline({
            paused: true
        })

        // timelines[index] = tl;

        // const src = heroThumbs[index].getAttribute('data-poster');
        gsap.set(slide, {
            // backgroundImage: `url('${src}')`
            // x: '-100%',
            clipPath: "inset( 0% 100% 0% 0%)",


        })

        const content = slide.querySelector('.hero-slide-content');


        const i = i => {
            tl.clear();

            tl = gsap.timeline({
                paused: true
            });
            tl.fromTo(heroSlides[i], {
                clipPath: "inset( 0% 100% 0% 0%)",

            }, {
                clipPath: "inset( 0% 0% 0% 0%)",

                duration: .4,
                ease: "power4.in",

            }).fromTo(content, {
                y: "100%",
                opacity: 0,

            }, {
                y: "0%",
                opacity: 1,
                duration: .4,
                ease: "power4.out",
            });

        }

        i(index);


        heroThumbs[index].addEventListener('mouseenter', (e) => {
            if (isMobile()) return;
            tl.kill();
            i(index);
            tl.restart();


            clearTimeout(hoverTimer);
            hoverTimer = setTimeout(() => {
                // console.log('paused', mainVideo.paused);
                if (!mainVideo.paused) {
                    try { mainVideo.pause(); } catch (e) { /* ignore */ }
                }

                checkVideo('mouseenter');

            }, HOVER_LOAD_DELAY);
            // console.log('timelines ', timelines);

            onThumbEnter(e, slide);



        });

        heroThumbs[index].addEventListener('mouseleave', () => {

            if (isMobile()) return;
            tl.timeScale(2);
            tl.reverse();
            // console.log('paused', mainVideo.paused);
            // console.log('');
            // console.log('timelines ', timelines);
            // mainVideo.play().catch(() => { /* autoplay blocked — ignore */ });

            // if (mainVideo.paused) {
            //     mainVideo.play().catch(() => { /* autoplay blocked — ignore */ });
            // }
            onThumbLeave(slide);

            clearTimeout(hoverTimer);
            hoverTimer = setTimeout(() => {
                // console.log('paused', mainVideo.paused);
                if (mainVideo.paused) {
                    mainVideo.play().catch(() => { /* autoplay blocked — ignore */ });

                }



                checkVideo('mouseleave');


            }, HOVER_LOAD_DELAY);

        });


    });


    heroSliderActive = true;


}
// ? test video paused

function checkVideo(event) {
    // console.log('');
    // console.log('new...');
    // console.log('Event: ', event);

    // const videos = document.querySelectorAll('video');
    // videos.forEach(video => {
    //     console.log('video el: ', video);
    //     console.log('is_paused: ', video.paused);
    //     console.log('');
    // })

}











// Утилиты
function killAnimation(anim) {
    if (!anim) return;
    try {
        // если это timeline/tween — убиваем
        if (typeof anim.kill === 'function') anim.kill();
    } catch (e) { }
}

function killScrollTriggersById(id) {
    if (!id) return;
    const all = ScrollTrigger.getAll();
    all.forEach(st => {
        if (st.vars && st.vars.id === id) {
            try { st.kill(); } catch (e) { }
        }
    });
}


// ? services GSAP Pin
function initServicesGSAP() {

    const services = document.querySelector('.services');

    if (!services) return;

    const servicesItems = Array.from(services.querySelectorAll('.services__item'));

    const portfolioTitle = services.querySelector('.home-portfolio__title');
    const portfolioDesc = services.querySelector('.home-portfolio-desc');
    const portfolioCircle = services.querySelector('.home-portfolio-title-circle');
    const portfolioItems = document.querySelectorAll('.home-portfolio__item');

    const servicesWrap = document.querySelector('.services-portfolio-wrap');
    const portfolioBg = document.querySelector('.home-portfolio-bg');

    const header = document.querySelector('#header');







    let startPin = "center center";
    let endPin = "+=2000";

    let scaleCircle = 1;


    function getCenter(el) {
        const r = el.getBoundingClientRect();
        return { x: r.left + r.width / 2 + window.scrollX, y: r.top + r.height / 2 + window.scrollY };
    }



    function clearServiceItems() {
        // gsap.killTweensOf(servicesItems);
        killAnimation(animations.section3);
        killScrollTriggersById('section3-pin');

        servicesItems.forEach(d => gsap.set(d, { clearProps: "transform,x,y" }));
    }



    // Создаём timeline и ScrollTrigger заново

    function setupAnimation() {
        clearServiceItems();




        const isWide = window.innerWidth > 1000;

        // Вычисляем центры после очистки
        const centers = servicesItems.map(d => getCenter(d));
        const servicesCenter = getCenter(services);

        // Для каждого dot вычисляем целевые дельты (от исходного положения)
        const deltas = centers.map((c, i) => {
            if (isWide) {
                return { x: servicesCenter.x - c.x, y: servicesCenter.y - c.y };
            } else {
                if (i === 0) return { x: 0, y: 0 };
                return { x: centers[0].x - c.x, y: centers[0].y - c.y };
            }
        });

        if (isWide) {
            endPin = "+=2000";
            startPin = "center center";
        } else {
            startPin = "20% 20%";
            endPin = "+=800";
        }

        const maxWidth = window.innerWidth;
        const maxHeight = window.innerHeight;

        const maxSize = maxWidth > maxHeight ? maxWidth : maxHeight;
        // console.log(maxSize);

        const rectCircle = portfolioCircle.getBoundingClientRect();

        // console.log(rectCircle.width);
        scaleCircle = Math.ceil(maxSize / rectCircle.width) + 3;

        // console.log('scaleCircle ', scaleCircle);

        // Применяем начальные gsap.set так, чтобы x/y изначально = 0 (чтобы можно было анимировать в обе стороны)
        servicesItems.forEach(d => gsap.set(d, { x: 0, y: 0 }));


        gsap.set(portfolioCircle, { opacity: 0 });
        gsap.set(portfolioTitle, { opacity: 0 });
        gsap.set(portfolioDesc, { opacity: 0 });
        gsap.set(portfolioBg, { opacity: 0 });
        gsap.set(portfolioBg, { backgroundColor: '#fff' });

        // Создаём timeline, не paused — но привяжем его к ScrollTrigger через animation:
        const tl = gsap.timeline({ defaults: { ease: "power2.out", duration: 1 } });


        // tl.fromTo(servicesItems, {
        //     yPercent: 50,
        // }, {
        //     yPercent: 0,
        //     stagger: 0.25,
        //     // delay: 0.5
        // });

        // Все твинны добавляем в один момент (они будут синхронизированы через ScrollTrigger.scrub)
        servicesItems.forEach((dot, i) => {
            // если дельты нулевые — всё равно добавляем tween (он просто не изменит позицию)
            // tl.to(dot, { x: deltas[i].x, y: deltas[i].y }, 1);
            tl.to(dot, {
                x: deltas[i].x,
                y: deltas[i].y,
                backgroundColor: '#fff',
            }, 0);
        });



        tl.to(portfolioCircle, {
            opacity: 1,
            duration: 0,

        },)

        const wrapper = document.querySelector('.wrapper');
        tl.to(portfolioCircle, {
            scale: scaleCircle,
            duration: 2,

            onStart: () => {
                // tl.to(portfolioBg, { backgroundColor: '#fff', duration: 0 })
                // header.classList.add('accent-color');
                wrapper.classList.add('is-light');
                // console.log('onStart');
                // console.log('onStart');
            },
            onReverseComplete: () => {
                // console.log('reverse complete');
                // header.classList.remove('accent-color');
                wrapper.classList.remove('is-light');

            }


        }, 1)
        tl.to(portfolioTitle, {
            opacity: 1,
            // duration: 0.5

        }, 1)



        tl.to(portfolioDesc, {
            opacity: 1,

        }, 2)



        tl.to(portfolioBg, {
            opacity: 1,
            duration: 1

        }, '-=1')





        // Создаём ScrollTrigger — animation: tl гарантирует, что прогресс timeline
        // управляется скроллом в обе стороны корректно.
        animations.section3 = ScrollTrigger.create({
            id: 'section3-pin',
            trigger: services,
            // start: "top top",
            start: startPin,
            // start: "center center",
            // длину зоны пина делаем равной высоте экрана * 1.0 (можно настроить)
            // end: () => "+=" + (window.innerHeight * 1),
            // end: () => "+=" + (window.innerHeight * 1.1),
            end: () => endPin, // mob
            pin: true,
            pinSpacing: true,
            scrub: 0.6,            // плавное следование скроллу
            // scrub: true,            // плавное следование скроллу
            animation: tl,
            // anticipatePin: 1,      // уменьшает шанс рывков при пиннинге
            // invalidateOnRefresh: true, // при Refresh пересчитывается animation (важно при resize)
            // anticipatePin помогает избежать рывков при старте пина
            // anticipatePin: 1,
            // invalidateOnRefresh: true,
            // fastScrollEnd: true, // Помогает при быстром скролле пальцем
            // preventOverlaps: true, // Предотвращает конфликты анимаций
            onLeave: () => {
                // ничего не делаем — animation удержит конечное состояние
            },
            onEnterBack: () => {
                // ничего не делаем — animation вернёт прогресс соответствующим скроллом
            },
            // markers: true,
        });

        // Обязательно обновляем
        ScrollTrigger.refresh();


        const allTriggers = ScrollTrigger.getAll();
        // allTriggers.forEach(trigger => console.log(trigger.trigger));
    }

    // Инициализация на load
    setupAnimation();

}




// ? initAnimationCardsGSAP

// function initAnimationCardsGSAP0() {
//     // return;

//     const section = document.querySelector('.recommendations');
//     if (!section) return;

//     const cards = document.querySelectorAll('.recommendations-card');


//     killAnimation(animations.section2);
//     killScrollTriggersById('section2-pin');




//     // MatchMedia
//     let mm = gsap.matchMedia();

//     // ================= DESKTOP (> 800px 801px) =================
//     mm.add("(min-width: 801px)", () => {




//         let activeIndex = -1;



//         // ? timeline pause reverse play


//         cards.forEach((card, index) => {
//             const content = card.querySelector('.recommendations-card-content');

//             gsap.set(card, { clearProps: "all" });
//             gsap.set(content, { clearProps: "all" });


//             card.addEventListener('mouseenter', () => {
//                 activeIndex = index;
//                 card.classList.add('show');
//             })
//             card.addEventListener('mouseleave', () => {
//                 activeIndex = -1;
//                 card.classList.remove('show');
//             })
//         });




//         // Левитация и движение за мышью
//         const onMouseMove = (e) => {


//             // Если курсор покинул секцию - не вычисляем (оптимизация)
//             if (e.target.closest('.recommendations') === null) return;

//             const rect = section.getBoundingClientRect();
//             const mouseX = e.clientX;
//             const mouseY = e.clientY;

//             // console.log(rect);


//             cards.forEach((card, i) => {
//                 // Если карточка активна - движение "магнит"
//                 if (i === activeIndex) {
//                     const cRect = card.getBoundingClientRect();
//                     const cx = cRect.left + cRect.width / 2;
//                     const cy = cRect.top + cRect.height / 2;

//                     gsap.to(card, {
//                         x: (mouseX - cx) * 0.1,
//                         y: -((mouseY - cy) * 0.1),
//                         duration: 0.4,
//                         ease: "power2.out",
//                         overwrite: "auto" // Важно! Перезаписывает левитацию
//                     });
//                 }
//                 // Левитация (только если ни одна не открыта)
//                 else if (activeIndex === -1) {
//                     const relX = mouseX - rect.left - rect.width / 2;
//                     const relY = mouseY - rect.top - rect.height / 2;
//                     const rnd = (i % 2 === 0 ? 1 : -1);

//                     gsap.to(card, {
//                         x: relX * 0.03 * rnd,
//                         y: relY * 0.04 * rnd,
//                         duration: 1.2,
//                         ease: "sine.out",
//                         overwrite: "auto"
//                     });
//                 }
//             });
//         };

//         section.addEventListener('mousemove', onMouseMove);
//         section.addEventListener('mouseleave', () => {
//             // При уходе сбрасываем всё в ноль
//             gsap.to(cards, { x: 0, y: 0, duration: 0.5, overwrite: true });
//         });


//         return () => {
//             section.removeEventListener('mousemove', onMouseMove);
//             gsap.set(cards, { clearProps: "all" });
//         };
//     });









//     // ================= MOBILE (< 800px ) =================
//     mm.add("(max-width: 800px)", () => {





//         cards.forEach(d => gsap.set(d, { clearProps: "transform,x,y" }));


//         const tl2 = gsap.timeline();


//         const sectionRect = section.getBoundingClientRect();

//         let total = sectionRect.height;

//         cards.forEach((card, i) => {

//             const minH = card.getBoundingClientRect().height;
//             const maxH = card.querySelector('.recommendations-card-content').getBoundingClientRect().height;
//             total += maxH;

//             const btn = card.querySelector('.recommendations-card-btn');

//             const content = card.querySelector('.recommendations-card-content');
//             const cardTitleWrap = card.querySelector('.recommendations-card__btn-wrap');

//             const cardIcon = card.querySelector('.recommendations-card__btn-icon');
//             const cardSvgIcon = card.querySelector('.card-svg-icon');
//             const cardSvgIconHidden = card.querySelector('.card-svg-icon-hidden');

//             gsap.set(content, { opacity: 0 })
//             gsap.set(card, { height: minH })
//             gsap.set(cardIcon, { opacity: 1 })
//             gsap.set(cardSvgIcon, { opacity: 1 })
//             gsap.set(cardSvgIconHidden, { opacity: 0 })

//             tl2

//                 .to(cardTitleWrap, { opacity: 0, duration: 0.2 })
//                 .to(cardSvgIcon, { opacity: 0, duration: 0.2 }, '<')
//                 .to(card, { height: maxH, duration: 2 })
//                 .to(content, { opacity: 1, duration: 2 }, '<')
//                 .to(cardSvgIconHidden, { opacity: 1, duration: 0.2 }, '-=1.8')

//                 // .to(btn, { opacity: 1 }, '-=0.2')
//                 .to({}, { duration: 1 })
//                 .to({}, { duration: 1 })

//                 .to(cardSvgIconHidden, { opacity: 0, duration: 0.2 })
//                 .to(card, { height: minH, duration: 2 })
//                 .to(content, { opacity: 0, duration: 2 }, '<')
//                 .to(cardSvgIcon, { opacity: 1, duration: 0.2 }, '-=1.8')
//                 .to(cardTitleWrap, { opacity: 1, duration: 0.2 }, '-=1.4')







//         })

//         console.log('total: ', total);



//         animations.section2 = ScrollTrigger.create({
//             id: 'section-pin2',
//             trigger: section,
//             start: 'top 10%',
//             end: () => `+=${total * 2}px`,
//             // end: () => '+=200%',
//             // end: () => '+=' + (window.innerHeight * 3),
//             pin: true,
//             pinSpacing: true,
//             // pinSpacing: false,
//             scrub: 0.6,
//             animation: tl2,
//             onLeave: () => {
//                 console.log('onLeave');


//             },
//             onEnterBack: () => {
//                 console.log('onEnterBack');
//             },
//             // invalidateOnRefresh: true, // при Refresh пересчитывается animation (важно при resize)
//             fastScrollEnd: true, // Помогает при быстром скролле пальцем
//             preventOverlaps: true, // Предотвращает конфликты анимаций
//             // markers: true,

//             // markers: {
//             //     startColor: "#ff0066",
//             //     endColor: "green",
//             //     fontSize: "14px",
//             //     indent: 20 + i * 10,            // смещаем маркеры по горизонтали, чтобы не наслаивались
//             //     startText: `card ${i + 1} start ()`,
//             //     endText: `card ${i + 1} end`
//             // },


//         })

//         ScrollTrigger.refresh();

//         // ScrollTrigger.getAll().forEach(trigger => console.log(trigger.trigger));

//         return () => {
//             // gsap.set(cards, { clearProps: "all" });
//             cards.forEach((card, i) => {

//                 const btn = card.querySelector('.recommendations-card-btn');

//                 const content = card.querySelector('.recommendations-card-content');
//                 const cardTitleWrap = card.querySelector('.recommendations-card__btn-wrap');

//                 const cardIcon = card.querySelector('.recommendations-card__btn-icon');
//                 const cardSvgIcon = card.querySelector('.card-svg-icon');
//                 const cardSvgIconHidden = card.querySelector('.card-svg-icon-hidden');


//                 gsap.set(card, { clearProps: "all" });
//                 gsap.set(btn, { clearProps: "all" });
//                 gsap.set(content, { clearProps: "all" });
//                 gsap.set(cardTitleWrap, { clearProps: "all" });
//                 gsap.set(cardIcon, { clearProps: "all" });
//                 gsap.set(cardSvgIcon, { clearProps: "all" });
//                 gsap.set(cardSvgIconHidden, { clearProps: "all" });

//             })
//         };

//     });



// }





function initAnimationCardsGSAP() {
    // return;

    const section = document.querySelector('.recommendations');
    if (!section) return;

    const cards = document.querySelectorAll('.recommendations-card');


    killAnimation(animations.section2);
    killScrollTriggersById('section2-pin');




    // MatchMedia
    let mm = gsap.matchMedia();

    // ================= DESKTOP (> 800px 801px) =================
    mm.add("(min-width: 1101px)", () => {




        let activeIndex = -1;



        // ? timeline pause reverse play


        cards.forEach((card, index) => {
            const content = card.querySelector('.recommendations-card-content');

            gsap.set(card, { clearProps: "all" });
            gsap.set(content, { clearProps: "all" });


            card.addEventListener('mouseenter', () => {
                activeIndex = index;
                card.classList.add('show');
            })
            card.addEventListener('mouseleave', () => {
                activeIndex = -1;
                card.classList.remove('show');
            })
        });




        // Левитация и движение за мышью
        const onMouseMove = (e) => {


            // Если курсор покинул секцию - не вычисляем (оптимизация)
            if (e.target.closest('.recommendations') === null) return;

            const rect = section.getBoundingClientRect();
            const mouseX = e.clientX;
            const mouseY = e.clientY;

            // console.log(rect);


            cards.forEach((card, i) => {
                // Если карточка активна - движение "магнит"
                if (i === activeIndex) {
                    const cRect = card.getBoundingClientRect();
                    const cx = cRect.left + cRect.width / 2;
                    const cy = cRect.top + cRect.height / 2;

                    gsap.to(card, {
                        x: (mouseX - cx) * 0.1,
                        y: -((mouseY - cy) * 0.1),
                        duration: 0.4,
                        ease: "power2.out",
                        overwrite: "auto" // Важно! Перезаписывает левитацию
                    });
                }
                // Левитация (только если ни одна не открыта)
                else if (activeIndex === -1) {
                    const relX = mouseX - rect.left - rect.width / 2;
                    const relY = mouseY - rect.top - rect.height / 2;
                    const rnd = (i % 2 === 0 ? 1 : -1);

                    gsap.to(card, {
                        x: relX * 0.03 * rnd,
                        y: relY * 0.04 * rnd,
                        duration: 1.2,
                        ease: "sine.out",
                        overwrite: "auto"
                    });
                }
            });
        };

        section.addEventListener('mousemove', onMouseMove);
        section.addEventListener('mouseleave', () => {
            // При уходе сбрасываем всё в ноль
            gsap.to(cards, { x: 0, y: 0, duration: 0.5, overwrite: true });
        });


        return () => {
            section.removeEventListener('mousemove', onMouseMove);
            gsap.set(cards, { clearProps: "all" });
        };
    });










    // ================= MOBILE (< 800px ) =================
    mm.add("(max-width: 1100px)", () => {

        const section = document.querySelector('.recommendations');
        const sectionRect = section.getBoundingClientRect();
        // console.log('sectionRect ', sectionRect.height);

        const sectionHeight = sectionRect.height * 2;

        gsap.set(section, { height: sectionHeight });

        const sectionPin = document.querySelector('.recommendations-cards');
        const tl = gsap.timeline({
            scrollTrigger: {
                id: 'cards',
                trigger: sectionPin,
                start: 'top top',
                end: `${sectionHeight - 400}px`,
                scrub: true,
                // markers: true,
            }
        });

        const cards = section.querySelectorAll('.recommendations-card');

        cards.forEach((card, i) => {
            const cardRect = card.getBoundingClientRect();

            const btn = card.querySelector('.recommendations-card-btn');
            const btnRect = btn.getBoundingClientRect();
            const content = card.querySelector('.recommendations-card-content');
            const cardTitleWrap = card.querySelector('.recommendations-card__btn-wrap');
            const cardIcon = card.querySelector('.recommendations-card__btn-icon');
            const cardSvgIcon = card.querySelector('.card-svg-icon');
            const cardSvgIconHidden = card.querySelector('.card-svg-icon-hidden');

            const cardMin = btnRect.height;
            const cardMax = cardRect.height;

            if (i == 0) {
                gsap.set(cardSvgIcon, { opacity: 0 });
                gsap.set(cardSvgIconHidden, { opacity: 1 });
                gsap.set(cardTitleWrap, { opacity: 0 });

            }
            else {
                gsap.set(card, { height: cardMin });
                gsap.set(content, { opacity: 0 });
            }





        })

        let segDuration = 1;
        // Для каждой пары добавляем один сегмент длительностью segDuration
        for (let i = 0; i < cards.length - 1; i++) {
            console.log(i);

            const cur = cards[i];
            const next = cards[i + 1];


            const curContent = cur.querySelector('.recommendations-card-content');
            const nextContent = next.querySelector('.recommendations-card-content');
            const curBtn = cur.querySelector('.recommendations-card-btn');
            const nextBtn = next.querySelector('.recommendations-card-btn');

            const curIcon = cur.querySelector('.recommendations-card__btn-icon');
            const nextIcon = next.querySelector('.recommendations-card__btn-icon');

            const curSvgIcon = cur.querySelector('.card-svg-icon');
            const nextSvgIcon = next.querySelector('.card-svg-icon');

            const curSvgIconHidden = cur.querySelector('.card-svg-icon-hidden');
            const nextSvgIconHidden = next.querySelector('.card-svg-icon-hidden');

            const curTitleWrap = cur.querySelector('.recommendations-card__btn-wrap');
            const nextTitleWrap = next.querySelector('.recommendations-card__btn-wrap');



            const curBtnRect = curBtn.getBoundingClientRect();
            const curContentRect = curContent.getBoundingClientRect();
            const cardMin = curBtnRect.height;
            const cardMax = curContentRect.height;

            // const nextBtnRect = nextBtn.getBoundingClientRect();
            // const nextContentRect = nextContent.getBoundingClientRect();
            // const nextMin = nextBtnRect.height;
            // const nextMax = nextContentRect.height;

            // gsap.set(curSvgIcon, { opacity: 0 });
            // Обозначим метку для этого сегмента в конкретной позиции timeline
            const segLabel = `seg${i}`;
            tl.addLabel(segLabel);


            // В этот сегмент добавляем все твины, привязанные к одной и той же метке —
            // они будут идти синхронно


            // ? cur card
            tl.to(curBtn, { opacity: 0, duration: 0.3 }, segLabel);

            tl.to(cur, { height: cardMin, duration: segDuration }, segLabel);          // уменьшаем текущую
            tl.to(curContent, { opacity: 0, duration: segDuration }, segLabel);

            tl.to(curSvgIcon, { opacity: 1, duration: 0.1, delay: 0.3 }, segLabel);
            tl.to(curSvgIconHidden, { opacity: 0, duration: 0.1, delay: 0.3 }, segLabel);

            tl.to(curBtn, { opacity: 1, duration: 0.4, delay: 0.4 }, segLabel);



            tl.to(curTitleWrap, { opacity: 1, duration: 0.2, delay: 0.6 }, segLabel);


            // ? next card
            tl.to(nextTitleWrap, { opacity: 0, duration: 0.1 }, segLabel);

            tl.to(nextBtn, { opacity: 0, duration: 0.1 }, segLabel);

            tl.to(next, { height: cardMax, duration: segDuration }, segLabel);        // увеличиваем следующий
            tl.to(nextContent, { opacity: 1, duration: segDuration }, segLabel);

            tl.to(nextSvgIcon, { opacity: 0, duration: 0.1, delay: 0.3 }, segLabel);
            tl.to(nextSvgIconHidden, { opacity: 1, duration: 0.1, delay: 0.3 }, segLabel);

            tl.to(nextBtn, { opacity: 1, duration: 0.2, delay: 0.8 }, segLabel);







            // Перемещаем таймлайт дальше на segDuration, чтобы следующий segLabel оказался после этого сегмента
            // необязательно; просто гарантирует пространство
            // tl.addPause(`+=${segDuration}`); 
        }




    });



}















function initHomePortfolioSlider() {

    const homeportfolioSlider = document.querySelector('#home-portfolio-slider');
    if (!homeportfolioSlider) return;

    new Swiper(homeportfolioSlider, {
        speed: 800,
        allowTouchMove: true,
        // slidesPerView: 1,
        slidesPerView: 1,
        spaceBetween: 20,

        navigation: {
            nextEl: '.home-portfolio-btn-next',
            prevEl: '.home-portfolio-btn-prev',
        },

        breakpoints: {
            // when window width is >= 320px
            320: {
                slidesPerView: 1,
                // spaceBetween: 20
            },
            // when window width is >= 480px
            500: {
                slidesPerView: 2,
                // spaceBetween: 20
            },
            700: {
                slidesPerView: 3,
                // spaceBetween: 20
            },
            // when window width is >= 640px
            1100: {
                slidesPerView: 4,
                // spaceBetween: 20
            }
        }


    })

    // ? set sessionStorage id slider
    const portfolioLinks = homeportfolioSlider.querySelectorAll('.home-portfolio__link');
    if (!portfolioLinks.length) return;

    portfolioLinks.forEach(link => {
        link.addEventListener('click', e => {
            e.preventDefault();

            const sliderId = link.dataset.sliderId;
            if (sliderId) {
                sessionStorage.setItem('openPortfolioSlider', sliderId);
            }
            location.href = link.href;

            console.log(sliderId);

        })
    })
}


