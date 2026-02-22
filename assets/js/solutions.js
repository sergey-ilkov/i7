window.addEventListener('DOMContentLoaded', () => {
    console.log('init solutions js...');




});






window.addEventListener('load', () => {


    initSolutionsCameraCards();

    initCameraCursor();

    initSolutionsNetworkAnimationGSAP();



    initFireSystemsAnimationGSAP();

    let timer = null;





    timer = setTimeout(() => {
        clearTimeout(timer);
        console.log('start');
        initSolutionsAutomationAnimationGSAP();


    }, 500);










});


function initSolutionsSectionPin() {

    const sections = document.querySelectorAll('.section-pin');

    if (!sections.length) return;

    if (window.innerWidth <= 1100) return;

    sections.forEach((section, i) => {

        ScrollTrigger.create({
            // id: 'section' + i,
            trigger: section,
            start: "top top",
            end: '+=10%',
            pin: true,
            // scrub: true,
            // scrub: true,
            // markers: true
        });
        ScrollTrigger.refresh();
    })


}






function initSolutionsCameraCards() {

    const cards = document.querySelectorAll('.solutions-camera__card');
    const btns = document.querySelectorAll('.solutions-camera-circle__btn');
    if (!cards.length || !btns.length) return;

    const classActive = 'active';

    cards[0].classList.add(classActive);
    btns[0].classList.add(classActive);

    btns.forEach((btn, i) => {
        btn.addEventListener('click', () => {

            switchCard(i);
        })
    })

    function switchCard(index) {
        btns.forEach((btn, i) => {

            if (index == i) {
                btn.classList.add(classActive);
                cards[i].classList.add(classActive);
            }
            else {
                btn.classList.remove(classActive);
                cards[i].classList.remove(classActive);
            }
        })
    }

}






// ? New

function initSolutionsNetworkAnimationGSAP() {



    let video = null;

    // ? load video
    // Использование:
    loadVideoFromDataSrc('#solutions-network-video')
        .then(videoLoad => {
            // console.log('Video loaded and ready');
            video = videoLoad;

            // video.play();


        })
        .catch(err => console.error(err));


    // ? Lottie
    console.log('Lottie загружен:', lottie);

    const solutionsNetworkLines = document.querySelector('#solutions-network-lottie');
    if (!solutionsNetworkLines) return;


    const path = './animations/network.json';
    if (!path) return;


    const animation = lottie.loadAnimation({
        container: solutionsNetworkLines, // Элемент на странице
        renderer: 'svg', // Тип рендера: 'svg', 'canvas' или 'html'
        loop: true,      // Зациклить?
        autoplay: true,  // Запустить сразу?
        // loop: false,      // Зациклить?
        // autoplay: false,  /// Запустить сразу?
        preserveAspectRatio: 'xMidYMid slice',
        path: path // Путь к твоему JSON файлу
    });


    // Создаем объект-посредник для анимации кадров
    let playhead = { frame: 0 };

    // animation.play()

    animation.addEventListener('DOMLoaded', () => {
        console.log("Lottie загружен, кадров:", animation.totalFrames);
        // animation.play()
        applyCoverTransform();
    });








    // Исходный размер композиции (design reference)
    const W0 = 1920, H0 = 1080;
    // let thresholdWidth = 800; // можно менять динамически
    let thresholdWidth = 1100; // можно менять динамически

    // Функция: применяет одну и ту же трансформацию (cover) к видео и lottie 
    // stage.style.height = 2000 + 'px';

    function applyCoverTransform() {
        const stage = document.querySelector('.solutions-network-coordinate-wrap');
        const videoEl = document.querySelector('.solutions-network-video');
        const lottieContainer = document.querySelector('.solutions-network-lottie');
        const dotsContainer = document.querySelector('.solutions-network-dots');

        const W = stage.clientWidth;
        const H = stage.clientHeight;

        const isNarrow = W < thresholdWidth;

        // Если узкий экран — переворачиваем композицию (90deg). Виртуальная исходная система — H0 x W0
        const srcW = isNarrow ? H0 : W0;
        const srcH = isNarrow ? W0 : H0;

        // scale по cover
        const scale = Math.max(W / srcW, H / srcH);

        // смещение центра после масштабирования (как для cover)
        let ox = (W - srcW * scale) / 2;
        let oy = (H - srcH * scale) / 2;

        // Базовые размеры перед трансформом: всегда задаём исходные размеры (не перевёрнутые)
        videoEl.style.width = W0 + 'px';
        videoEl.style.height = H0 + 'px';
        lottieContainer.style.width = W0 + 'px';
        lottieContainer.style.height = H0 + 'px';

        dotsContainer.style.width = W0 + 'px';
        dotsContainer.style.height = H0 + 'px';

        if (!isNarrow) {
            // обычный режим: translate + scale
            const t = `translate(${ox}px, ${oy}px) scale(${scale})`;
            videoEl.style.transform = t;
            lottieContainer.style.transform = t;
            dotsContainer.style.transform = t;
        } else {
            // узкий режим: нужно повернуть на 90deg и сдвинуть,
            // учитываем, что поворот вращает систему: (x,y) -> (-y, x) при rotate(90deg)
            // Поэтому применим последовательность: translate(ox, oy) scale(scale) rotate(90deg) translate(?,?)
            // Упрощённый и надёжный вариант: сначала трансформируем как если бы исход был srcW x srcH,
            // затем делаем rotate(90deg) и корректируем позицию так, чтобы стал влево-верх.
            // Реализуем: transform = translate(ox, oy) scale(scale) rotate(90deg) translate(0, -srcW)
            // Обоснование: после rotate(90deg) наш элемент (ширина srcW, высота srcH) смещается; сдвиг на -srcW по Y возвращает в видимую область.

            // Поворот вокруг (0,0), поэтому добавляем дополнительный translate после rotate.
            // Приводим в одну строку:
            const postRotateShiftY = -srcW; // px
            const t = `translate(${ox}px, ${oy}px) scale(${scale}) rotate(90deg) translate(0px, ${postRotateShiftY}px)`;
            videoEl.style.transform = t;
            lottieContainer.style.transform = t;

            dotsContainer.style.transform = t;
        }
    }




    // Обновление порога динамически (пример функции)
    function setThreshold(w) {
        thresholdWidth = Number(w) || 800;
        applyCoverTransform();
    }

    // При ресайзе окна пересчитываем трансформацию
    window.addEventListener('resize', applyCoverTransform);





    // ? animation Cards
    // let snCardsSplits = [];

    function initSolutionsCards() {
        let mm = gsap.matchMedia();

        // --- ДЕСКТОП (1101px и выше) ---
        mm.add("(min-width: 1101px)", () => {


            // const section = document.querySelector('.solutions-network');

            // ScrollTrigger.create({
            //     trigger: section,
            //     start: "top top",
            //     end: '+=20%',
            //     pin: true,
            //     scrub: true,
            //     markers: true
            // });

            const contents = document.querySelectorAll('.solutions-network-card__text');
            contents.forEach(content => {
                content.style.display = 'none';
            })
            const cards = document.querySelectorAll('.solutions-network-card-wrap');

            cards.forEach((cardWrap) => {
                const cardInner = cardWrap.querySelector('.solutions-network-card');
                const body = cardWrap.querySelector('.solutions-network-card-body');
                const textElement = cardWrap.querySelector('.solutions-network-card__text');

                const cardStyles = getComputedStyle(cardWrap);
                const expandedWidth = cardStyles.getPropertyValue('--card-expanded-w').trim();

                // 1. SplitText: только opacity
                const split = new SplitText(textElement, { type: "chars, words", charsClass: "sn-char" });
                gsap.set(split.chars, { opacity: 0 });

                // 2. Таймлайн
                const hoverTl = gsap.timeline({
                    paused: true,
                    defaults: { ease: "expo.out", duration: 0.6 }
                });

                hoverTl
                    .to(cardWrap, {
                        width: expandedWidth,
                        duration: 0.5
                    })
                    .to(body, {
                        height: "auto",
                        width: "100%",
                        opacity: 1,
                        // marginTop: cardWrap.classList.contains('sn-card-top') ? 15 : 0,
                        // marginBottom: cardWrap.classList.contains('sn-card-bottom') ? 15 : 0,
                    }, "<")
                    .to(split.chars, {
                        opacity: 1,
                        stagger: 0.008, // Буквы проявляются очень быстро
                        duration: 0.3
                    }, "-=0.2");

                // 3. События на всю карточку
                cardInner.addEventListener('mouseenter', () => {
                    // Играем вперед с нормальной скоростью
                    hoverTl.timeScale(1).play();
                });

                cardInner.addEventListener('mouseleave', () => {
                    // Играем назад в 2.5 раза быстрее
                    hoverTl.timeScale(2.5).reverse();
                });
            });


            let timerId = null;
            timerId = setTimeout(() => {
                clearTimeout(timerId);
                contents.forEach(content => {
                    content.style.display = 'block';
                })
            }, 2000);
        });

        // --- МОБИЛЬНЫЕ / ТАБЛЕТЫ (Меньше 1100px) ---
        mm.add("(max-width: 1100px)", () => {
            // На мобилках нам не нужны сложные ховеры
            gsap.set(".solutions-network-card-wrap", {
                width: "100%",
                position: "static",
                opacity: 0
            });
        });

    }


    initSolutionsCards();

    /**
 * Старт анимации: Появление заголовков (Scale 0 -> 1)
 */

    // Глобальная переменная для управления пульсацией
    let descPulse;
    /**
 * Инициализация постоянной пульсации описания
 */
    function initIdleAnimation() {
        const desc = document.querySelector('.solutions-network__desc');

        descPulse = gsap.to(desc, {
            // opacity: 0.7,
            scale: 1.1,
            duration: 0.8,
            repeat: -1,
            yoyo: true,
            // ease: "sine.inOut"
            // ease: "sine.out"
            ease: "sine.in"
        });
    }

    initIdleAnimation();




    /**
 * ФУНКЦИЯ ЗАПУСКА СЕТИ (ЭТАП 2)
 */
    function initNetworkActivation() {
        const btn = document.querySelector('.solutions-network__btn');
        const contentWrap = document.querySelector('.solutions-network-content-wrap');
        const video = document.getElementById('solutions-network-video');
        const lottieContainer = document.getElementById('solutions-network-lottie');
        const cardWrap = document.querySelectorAll('.solutions-network-card-wrap');
        const dots = document.querySelectorAll('.solutions-network-dot');

        btn.addEventListener('click', () => {
            // console.log('click');

            // 1. Плавно убираем описание и останавливаем пульсацию
            if (descPulse) descPulse.kill();

            btn.classList.add('active');

            const tl = gsap.timeline();

            gsap.set(video, { opacity: 1 });

            // video.play();


            gsap.to(contentWrap, {
                opacity: 0,
                duration: 0.2,
                // ease: 'none',
                // duration: 0.4,
                // ease: "power4.inOut",
                ease: "power2.out",
                // ease: "power1.inOut",
                // delay: 0,
                onComplete: () => {
                    video.play();
                    gsap.set('.solutions-network-card-wrap', { pointerEvents: 'auto' });
                }
            });

            const isDesktop = window.innerWidth >= 1101;

            // 3. Отслеживаем тайминг видео (1.8 сек) для появления Lottie
            const checkVideoTime = () => {
                if (video.currentTime >= 1.35) {
                    // Показываем Lottie
                    tl.to(lottieContainer, {
                        opacity: 1,
                        // duration: 0.2,
                        duration: 0.5,
                        ease: "power1.inOut"
                    });

                    tl.to(dots, { scale: 1, duration: 0.4, });

                    if (isDesktop) {

                        tl.to(cardWrap, {
                            scale: 1,
                            duration: 1,
                            ease: 'power1.out',
                            delay: 0.2
                        }, '<');
                    }
                    else {
                        tl.to('.solutions-network-card-wrap', {
                            opacity: 1,
                            y: 0,
                            duration: 0.8,
                            stagger: 0.1,
                            ease: "power1.out"
                        }, '<');
                        // Убеждаемся, что заголовки видны (т.к. на десктопе у них scale: 0)
                        gsap.set(cardWrap, { scale: 1 });
                    }


                    // 4. Запускаем появление заголовков карточек из 1-го этапа


                    // Снимаем слушатель, чтобы не срабатывал повторно
                    video.removeEventListener('timeupdate', checkVideoTime);
                }
            };

            video.addEventListener('timeupdate', checkVideoTime);

            // Опционально: можно скрыть саму кнопку, если она больше не нужна
            // gsap.to(btn, { autoAlpha: 0, duration: 0.5 });
        }, { once: true }); // Кнопка сработает один раз
    }


    initNetworkActivation();

}

function debounce(fn, wait = 200) {
    let t;
    return (...args) => {
        clearTimeout(t);
        t = setTimeout(() => fn(...args), wait);
    };
}

function initSolutionsAutomationAnimationGSAP() {

    // ? cards anim
    if (window.innerWidth > 1100) {

        const cards = document.querySelectorAll('.solutions-automation__card:not(:first-child)');

        if (!cards.length) return;

        cards.forEach(card => {
            const wrap = card.querySelector('.solutions-automation__card-wrap');
            const icon = card.querySelector('.solutions-automation__card-icon');
            const title = card.querySelector('.solutions-automation__card-title');
            const content = card.querySelector('.solutions-automation__card-content');

            const wrapRect = wrap.getBoundingClientRect();
            const titleRect = title.getBoundingClientRect();
            const titleY = wrapRect.height - titleRect.height;

            const cardTl = gsap.timeline({ paused: true, ease: 'power1.out' });

            gsap.set(content, { yPercent: 100, opacity: 0 });

            cardTl.to(icon, { scale: 0, opacity: 0, })
                .to(title, { y: -titleY, }, '<')
                .to(content, { yPercent: 0, opacity: 1, }, '<');


            card.addEventListener('mouseenter', () => {
                cardTl.play();
            })
            card.addEventListener('mouseleave', () => {
                cardTl.reverse();
            })
        })
    }



    //  ? anim section


    let descPulse;

    function initIdleAnimation() {
        const desc = document.querySelector('.solutions-automation__desc');

        descPulse = gsap.to(desc, {
            // opacity: 0.7,
            scale: 1.1,
            duration: 0.8,
            repeat: -1,
            yoyo: true,
            // ease: "sine.inOut"
            // ease: "sine.out"
            ease: "sine.in"
        });
    }

    initIdleAnimation();


    //  if (descPulse) descPulse.kill();







    const btnStart = document.querySelector('.solutions-automation__btn');
    const automationLottie = document.querySelector('.solutions-automation-lottie');
    if (!btnStart || !automationLottie) return;

    const path = './animations/automation.json';
    if (!path) return;


    gsap.set(automationLottie, { opacity: 0 });

    const animation = lottie.loadAnimation({
        container: automationLottie, // Элемент на странице
        renderer: 'svg', // Тип рендера: 'svg', 'canvas' или 'html'
        // loop: true,      // Зациклить?
        // autoplay: true,  // Запустить сразу?
        loop: false,      // Зациклить?
        autoplay: false,  /// Запустить сразу?        
        path: path // Путь к твоему JSON файлу
    });

    animation.addEventListener('DOMLoaded', () => {
        console.log("Lottie загружен, кадров:", animation.totalFrames);

    });




    const heroWrap = document.querySelector('.solutions-automation-wrap');
    const cursor = document.querySelector('#custom-cursor');

    // if (!cursor) {
    //     heroWrap.style.cursor = 'auto';
    //     btnStart.style.cursor = 'auto';

    //     btnStart.addEventListener('mouseenter', () => {
    //         // console.log('mouseenter');

    //         initOpenAccess();

    //     }, { once: true })
    // }








    const initCursorLogic = () => {

        let mm = gsap.matchMedia();

        let isFinished = false;  // Флаг завершения, чтобы не запускать код повторно

        mm.add("(min-width: 1101px)", () => {
            // Если функция уже один раз выполнилась — ничего не делаем
            if (isFinished) return;

            // 1. Исходное состояние
            gsap.set(cursor, { xPercent: -50, yPercent: -50, x: 0, y: 0, opacity: 0, display: "block" });

            // --- НАСТРОЙКИ (можно менять) ---
            const THRESHOLD = 1;   // 0.5 = 50% площади кнопки должно быть накрыто
            const CURSOR_SIZE = cursor.getBoundingClientRect().width; // Ширина/высота картинки в px
            // const CURSOR_SIZE = 190; // Ширина/высота картинки в px



            console.log(CURSOR_SIZE);

            // 2. Оптимизированное движение через quickTo
            const xTo = gsap.quickTo(cursor, "x", { duration: 0.4, ease: "power3" });
            const yTo = gsap.quickTo(cursor, "y", { duration: 0.4, ease: "power3" });

            // 3. Логика проверки накрытия площади

            const checkOverlap = (e) => {
                const btnRect = btnStart.getBoundingClientRect();

                // console.log(btnRect);


                // Границы курсора (центрирован относительно мыши)
                const cur = {
                    left: e.clientX - CURSOR_SIZE / 2,
                    right: e.clientX + CURSOR_SIZE / 2,
                    top: e.clientY - CURSOR_SIZE / 2,
                    bottom: e.clientY + CURSOR_SIZE / 2
                };

                // Вычисляем область пересечения
                const overlapWidth = Math.max(0, Math.min(cur.right, btnRect.right) - Math.max(cur.left, btnRect.left));
                const overlapHeight = Math.max(0, Math.min(cur.bottom, btnRect.bottom) - Math.max(cur.top, btnRect.top));

                const overlapArea = overlapWidth * overlapHeight;
                const btnArea = btnRect.width * btnRect.height;
                const coverage = overlapArea / btnArea;

                if (coverage >= THRESHOLD) {
                    executeFinalLogic();
                }
            };

            // 4. Ваша функция и самоуничтожение
            function executeFinalLogic() {
                isFinished = true;


                // console.log("Цель достигнута: кнопка накрыта курсором!");

                initOpenAccess();

                removeAllEvents();
            }

            const onMouseMove = (e) => {
                xTo(e.clientX);
                yTo(e.clientY);
                checkOverlap(e);
            };

            const onMouseEnter = () => {
                gsap.to(cursor, { opacity: 1, duration: 0.4 });
                window.addEventListener("mousemove", onMouseMove);
            };

            const onMouseLeave = () => {
                gsap.to(cursor, { opacity: 0, duration: 0.4 });
                window.removeEventListener("mousemove", onMouseMove);
            };

            function removeAllEvents() {
                heroWrap.removeEventListener("mouseenter", onMouseEnter);
                heroWrap.removeEventListener("mouseleave", onMouseLeave);
                window.removeEventListener("mousemove", onMouseMove);

                // Плавно скрываем курсор и возвращаем обычный
                gsap.to(cursor, {
                    opacity: 0, scale: 0.8, duration: 0.3, onComplete: () => {
                        gsap.set(cursor, { display: "none" });
                        // heroWrap.style.cursor = "auto";
                        // button.style.cursor = "auto";
                    }
                });
            }

            // Запуск
            heroWrap.addEventListener("mouseenter", onMouseEnter);
            heroWrap.addEventListener("mouseleave", onMouseLeave);

            // Очистка при ресайзе (matchMedia сам вызовет это, если экран станет < 1101px)
            return () => {
                window.removeEventListener("mousemove", onMouseMove);
                heroWrap.removeEventListener("mouseenter", onMouseEnter);
                heroWrap.removeEventListener("mouseleave", onMouseLeave);
                gsap.set(cursor, { opacity: 0 });
            };
        });
    }



    const cursorImg = cursor?.querySelector("img");

    if (!cursor || !cursorImg) {
        heroWrap.style.cursor = 'auto';
        btnStart.style.cursor = 'auto';

        btnStart.addEventListener('mouseenter', () => {
            // console.log('mouseenter');
            initOpenAccess();
        }, { once: true })
    }


    // ПРОВЕРКА ЗАГРУЗКИ КАРТИНКИ
    if (cursorImg.complete) {
        // Картинка уже загружена (например, из кэша)
        initCursorLogic();
    } else {
        heroWrap.style.cursor = 'auto';
        btnStart.style.cursor = 'auto';

        btnStart.addEventListener('mouseenter', () => {
            initOpenAccess();
        }, { once: true })
    }









    // if (window.innerWidth > 1100 && cursor) {


    //     let enabled = window.innerWidth > 1100;
    //     let mouse = { x: window.innerWidth / 2, y: window.innerHeight / 2 };
    //     let pos = { x: mouse.x, y: mouse.y };
    //     const ease = 0.18;

    //     cursor.style.display = enabled ? 'block' : 'none';

    //     // размер курсора (в px) — взять реальный размер элемента
    //     const getCursorSize = () => {
    //         const rect = cursor.getBoundingClientRect();
    //         return { w: rect.width, h: rect.height };
    //     };


    //     // отслеживаем заход/выход указателя в секцию, чтобы скрывать только там

    //     let isPointerInside = false;

    //     function setPointerInside() {
    //         isPointerInside = true;
    //     }
    //     function removePointerInside() {

    //     } isPointerInside = false;

    //     heroWrap.addEventListener('mouseenter', setPointerInside);
    //     heroWrap.addEventListener('mouseleave', removePointerInside);


    //     function getCursorCenter() { return { x: pos.x, y: pos.y }; }

    //     // проверка пересечения: считается успешным, если половина ширины ИЛИ половина высоты курсора перекрыта.
    //     // точнее: проверим площадь перекрытия >= 0.5 * area_cursor
    //     const btnRect = btnStart.getBoundingClientRect();

    //     function isCursorHalfOverElement() {
    //         const curRect = cursor.getBoundingClientRect();
    //         // curRect получен до применения left/top в текущном кадре — но мы обновляем left/top синхронно ниже, поэтому используем рассчитый центр и размеры:
    //         const curW = curRect.width, curH = curRect.height;
    //         const curCenter = getCursorCenter();
    //         const curLeft = curCenter.x - curW / 2;
    //         const curTop = curCenter.y - curH / 2;
    //         const curRight = curLeft + curW;
    //         const curBottom = curTop + curH;

    //         const overlapX = Math.max(0, Math.min(curRight, btnRect.right) - Math.max(curLeft, btnRect.left));
    //         const overlapY = Math.max(0, Math.min(curBottom, btnRect.bottom) - Math.max(curTop, btnRect.top));
    //         const overlapArea = overlapX * overlapY;
    //         const curArea = curW * curH;

    //         return overlapArea >= curArea * 0.5; // половина площади курсора или больше
    //     }


    //     // отслеживаем движение мыши внутри секции

    //     function cursorObserver(e) {
    //         if (!enabled) return;
    //         // clientX/Y уже в window coords — центрим курсор, учитывая половину размера

    //         mouse.x = e.clientX; // не вычитаем здесь — учтём при рендере через translate
    //         mouse.y = e.clientY;
    //         console.log(mouse);
    //     }


    //     // плавное движение через gsap.ticker (легче и интегрируется с GSAP)
    //     gsap.ticker.add(() => {
    //         if (!enabled || !isPointerInside) return;
    //         pos.x += (mouse.x - pos.x) * ease;
    //         pos.y += (mouse.y - pos.y) * ease;
    //         const size = getCursorSize();
    //         gsap.set(cursor, { x: pos.x - size.w / 2, y: pos.y - size.h / 2 });
    //         // проверяем попадание курсора на кнопку
    //         // console.log(isCursorHalfOverElement());

    //         if (isCursorHalfOverElement()) {
    //             console.log('laaaaaa');
    //         }

    //     });




    //     heroWrap.addEventListener('mousemove', cursorObserver);


    //     const onResize = debounce(() => {


    //         console.log('resize');
    //         enabled = window.innerWidth > 1100;

    //         cursor.style.display = enabled ? 'block' : 'none';

    //     }, 200);

    //     window.addEventListener('resize', onResize);
    // }



    function initOpenAccess() {

        // if (descPulse) descPulse.kill();

        // gsap.to(descPulse, { scale: 1 });
        descPulse.pause(); // Остановить       
        descPulse.seek(0); // Перемотать на начало
        if (descPulse) descPulse.kill();

        const tl = gsap.timeline();
        btnStart.blur();

        animation.play();

        tl.to(btnStart, { opacity: 0, zIndex: 1 })
            .to(automationLottie, { opacity: 1 })


        // слушаем событие complete
        animation.addEventListener('complete', () => {

            gsap.to(heroWrap, { xPercent: -100, duration: 1 });
        });



    }


    if (window.innerWidth <= 1100) {

        btnStart.addEventListener('click', () => {
            // console.log('click');

            initOpenAccess();

        }, { once: true })

    }

}





// ? initFireSystemsAnimationGSAP() new
// ? initFireSystemsAnimationGSAP() new
// ? initFireSystemsAnimationGSAP() new
// ? initFireSystemsAnimationGSAP() new
// ? initFireSystemsAnimationGSAP() new
// ? initFireSystemsAnimationGSAP() new
// ? initFireSystemsAnimationGSAP() new


function initFireSystemsAnimationGSAP() {


    function initSyncPoints() {


        function syncPoins(pointCircles, pointElements) {

            pointCircles.forEach((circle, i) => {
                if (!pointElements[i]) return;

                const rect = circle.getBoundingClientRect();

                const parentRect = document.querySelector('.fire-systems-sticky-wrap').getBoundingClientRect();
                // const parentRect = document.querySelector('.fire-systems-test-wrap').getBoundingClientRect();
                // Устанавливаем координаты центра круга

                gsap.set(pointElements[i], {

                    left: rect.left - parentRect.left + rect.width / 2,
                    top: rect.top - parentRect.top + rect.height / 2
                });
            })
        }



        if (window.innerWidth > 1100) {

            // ? desktop
            const fireSvgDesktop = document.querySelector('#fire-svg-desktop');
            if (!fireSvgDesktop) return;

            const hintCircles = fireSvgDesktop.querySelectorAll('.anchor-scroll-text');
            const hintPointElements = document.querySelectorAll('.desktop-scroll-hints .scroll-hint');
            syncPoins(hintCircles, hintPointElements);


            const iconPointCircles = fireSvgDesktop.querySelectorAll('.icon-point');
            const iconPointElements = document.querySelectorAll('.desktop-icon-point');
            syncPoins(iconPointCircles, iconPointElements);


            // ? desktop-anchor-icon-points
            const anchorIconPointCircles = fireSvgDesktop.querySelectorAll('.anchor-icon-point');
            const anchorIconPointElements = document.querySelectorAll('.desktop-anchor-icon-point');
            syncPoins(anchorIconPointCircles, anchorIconPointElements);

            // ? cards
            const cards = document.querySelectorAll('.fire-systems__card');
            syncPoins(anchorIconPointCircles, cards);
        } else {

            // ? mobile
            const fireSvgMobile = document.querySelector('#fire-svg-mobile');
            if (!fireSvgMobile) return;

            const hintCircles = fireSvgMobile.querySelectorAll('.anchor-scroll-text');
            const hintPointElements = document.querySelectorAll('.mobile-scroll-hints .scroll-hint');
            syncPoins(hintCircles, hintPointElements);


            const iconPointCircles = fireSvgMobile.querySelectorAll('.icon-point');
            const iconPointElements = document.querySelectorAll('.mobile-icon-point');
            syncPoins(iconPointCircles, iconPointElements);

            const anchorIconPointCircles = fireSvgMobile.querySelectorAll('.anchor-icon-point');
            const anchorIconPointElements = document.querySelectorAll('.mobile-anchor-icon-point');
            syncPoins(anchorIconPointCircles, anchorIconPointElements);

            // ? cards
            const cards = document.querySelectorAll('.fire-systems__card');
            syncPoins(anchorIconPointCircles, cards);

            const human = document.querySelector('#human');
            const mainPath = document.querySelector('#main-path-mobile');
            gsap.set(human, { x: mainPath.getBoundingClientRect().left - human.getBoundingClientRect().width / 2 });



        }
    }

    initSyncPoints();

    const onResize = debounce(() => {

        initSyncPoints();

    }, 200);

    window.addEventListener('resize', onResize);



    const mm = gsap.matchMedia();


    mm.add("(min-width: 1101px)", () => {

        // --- КОД ДЛЯ ДЕСКТОПА ---
        const config = {
            path: "#main-path-desktop",
            svg: "#fire-svg-desktop",
            anchors: "#fire-svg-desktop .anchor-point",
            camera: true,
            st: {
                start: "top top",
                end: "+=600%",
                scrub: 1.8,
                pin: true,
            }

        };

        setupAnimation(config);
    });

    mm.add("(max-width: 1100px)", () => {

        // const human = document.querySelector('#human');
        // const mainPath = document.querySelector('#main-path-mobile');
        // gsap.set(human, { x: mainPath.getBoundingClientRect().left - human.getBoundingClientRect().width / 2 });


        // --- КОД ДЛЯ МОБИЛОК ---
        const config = {
            path: "#main-path-mobile", // ID пути в мобильном SVG
            svg: "#fire-svg-mobile",
            anchors: "#fire-svg-mobile .anchor-point",
            camera: false,
            st: {
                start: "top 10%",
                end: "bottom bottom",
                scrub: true,
                pin: false,
            }

        };
        setupAnimation(config);
    });



    function setupAnimation(cfg) {

        console.log('cfg: ', cfg);

        const mainPath = document.querySelector(cfg.path);
        const svgElement = document.querySelector(cfg.svg);
        const anchors = document.querySelectorAll(cfg.anchors);

        const human = document.querySelector('#human');
        const stage = document.querySelector('.fire-svg-stage');
        const cards = document.querySelectorAll('.fire-systems__card');

        if (!mainPath || !svgElement || !anchors.length || !human || !stage || !cards.length) return;

        let maxReachedIndex = -1;

        // Сбрасываем карточки при смене экрана
        gsap.set(cards, { autoAlpha: 0 });


        const tl = gsap.timeline({
            scrollTrigger: {
                id: 'fire',
                trigger: ".fire-systems-scroll",
                start: cfg.st.start,
                end: cfg.st.end,
                scrub: cfg.st.scrub,
                pin: cfg.st.pin,

                // start: "top top",
                // end: "+=500%",
                // scrub: 1.2,
                // pin: true,

                // start: "top 10%",
                // end: "bottom bottom",
                // scrub: true,

                onUpdate: () => checkDistance(),
                // markers: true,
            }
        });



        const cardLastRect = cards[cards.length - 1].getBoundingClientRect();
        const stagePadding = window.innerWidth > 1100 ? Math.ceil(cardLastRect.height) : 0;


        // Анимация сцены (камера) desktop
        if (cfg.camera) {
            tl.to(stage, {
                y: () => -(stage.offsetHeight - window.innerHeight + stagePadding),
                ease: "none"
            }, 0);
        }

        // Анимация человечка
        tl.to(human, {
            motionPath: {
                path: mainPath,
                align: mainPath,
                alignOrigin: [0.5, 0.5],
            },
            ease: "none"
        }, 0);

        ScrollTrigger.refresh();


        function checkDistance() {

            const direction = tl.scrollTrigger.direction;
            const humanRect = human.getBoundingClientRect();
            // const centerY = humanRect.top + humanRect.height / 2;
            const centerY = humanRect.top + humanRect.height;

            // console.log('direction: ', direction);
            anchors.forEach((anchor, index) => {
                const anchorRect = anchor.getBoundingClientRect();
                const anchorY = anchorRect.top + anchorRect.height / 2;

                // const anchorY = anchorRect.top;
                if (direction === 1) {
                    if (centerY >= anchorY && index > maxReachedIndex) {
                        // console.log('show card');
                        maxReachedIndex = index;
                        toggleCard(index, true);
                    }
                } else {
                    if (centerY < anchorY && index <= maxReachedIndex) {
                        // console.log('hidden card');
                        toggleCard(index, false);
                        maxReachedIndex = index - 1;
                    }
                }
            });
        }

        function toggleCard(index, show) {
            if (!cards[index]) return;
            gsap.to(cards[index], {
                autoAlpha: show ? 1 : 0,
                duration: 0.5,
                overwrite: true
            });
        }
    }



}


// ? initCameraCursor
// ? initCameraCursor
// ? initCameraCursor
// ? initCameraCursor
// ? initCameraCursor
// ? initCameraCursor


function initCameraCursor() {

    const canvas = document.getElementById("camera-canvas");
    const ctx = canvas.getContext("2d");
    const preloader = document.getElementById("camera-preloader");
    const loaderBar = document.getElementById("loader-bar");
    const loaderText = document.getElementById("loader-text");

    const frameCount = 160;
    const images = [];
    const cameraState = { frame: 0 };

    // Настройки углов
    const viewAngle = 300;
    const halfView = viewAngle / 2; // 150 градусов

    // window.addEventListener('load', () => {
    //     preloadImages();
    // });

    function preloadImages() {
        let loadedImages = 0;
        for (let i = 0; i < frameCount; i++) {
            const img = new Image();
            img.src = `./animations/camera/${i}.webp`;
            img.onload = () => {
                loadedImages++;
                let progress = Math.round((loadedImages / frameCount) * 100);
                loaderBar.style.width = `${progress}%`;
                loaderText.innerText = `${progress}%`;

                if (loadedImages === 1) render();

                if (loadedImages === frameCount) {
                    startIntro(); // Запускаем приветствие
                }
            };
            images.push(img);
        }
    }

    preloadImages();

    function render() {
        const img = images[Math.round(cameraState.frame)];
        if (img) {
            if (canvas.width !== img.width) {
                canvas.width = img.width;
                canvas.height = img.height;
            }
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.drawImage(img, 0, 0);
        }
    }

    // ПРИВЕТСТВЕННЫЙ ОБОРОТ
    function startIntro() {
        const tl = gsap.timeline({
            onComplete: () => initTracking() // Включаем мышь только после анимации
        });

        tl.to(preloader, { opacity: 0, duration: 0.5, onComplete: () => preloader.style.display = 'none' })
            .fromTo(cameraState,
                { frame: 0 },
                { frame: frameCount - 1, duration: 1.2, ease: "power2.inOut", onUpdate: render }
            )
        // .to(cameraState,
        //     { frame: 80, duration: 0.8, ease: "power2.out", onUpdate: render },
        //     "+=0.1"
        // );
    }


    function initTracking() {
        const section = document.querySelector('.solutions-camera');

        section.addEventListener("mousemove", (e) => {
            const rect = canvas.getBoundingClientRect();

            // Центр камеры на экране
            const centerX = rect.left + rect.width / 2;
            const centerY = rect.top + rect.height / 2;

            // Вектор от центра до мыши
            const dx = e.clientX - centerX;
            const dy = e.clientY - centerY;

            // 1. Считаем угол. В стандартном atan2(dy, dx) 0 градусов — это ПРАВО.
            // Чтобы 0 был ВВЕРХУ (в центре слепой зоны), используем atan2(dx, -dy)
            const angleRad = Math.atan2(dx, -dy);
            let angleDeg = angleRad * (180 / Math.PI);

            /**
             * ТЕПЕРЬ ПОСЛЕ ЭТОГО РАСЧЕТА:
             * 0°   = строго ВВЕРХУ (центр слепой зоны)
             * 180° / -180° = строго ВНИЗУ
             * 90°  = строго СПРАВА
             * -90° = строго СЛЕВА
             */

            // 2. ПРОВЕРКА СЛЕПОЙ ЗОНЫ (ВЕРХНИЙ СЕКТОР)
            // У нас всего 300 градусов обзора. Значит, слепая зона — это 60 градусов сверху.
            // Это от -30° до +30°. Если угол попадает в этот диапазон — камера ждет.
            const deadZoneHalf = (360 - viewAngle) / 2; // получится 30

            if (angleDeg > -deadZoneHalf && angleDeg < deadZoneHalf) {
                return; // Мышь вверху в слепой зоне — ничего не делаем
            }

            // 3. МАППИНГ КАДРОВ
            // Теперь нам нужно превратить оставшиеся 300 градусов в 160 кадров.
            // Левая граница обзора (кадр 159): -30° (уходит влево через низ до -180)
            // Правая граница обзора (кадр 0): +30° (уходит вправо через низ до +180)

            // Чтобы маппинг был линейным, переведем углы в диапазон от 0 до 300
            let normalizedAngle;
            if (angleDeg >= deadZoneHalf) {
                // Правая сторона: от 30 до 180
                normalizedAngle = angleDeg - deadZoneHalf;
            } else {
                // Левая сторона: от -180 до -30
                // Превращаем это в продолжение диапазона (от 150 до 300)
                normalizedAngle = (angleDeg + 360) - deadZoneHalf;
            }

            // Теперь normalizedAngle идет от 0 (правая граница) до 300 (левая граница)
            // 0 градусов -> кадр 0 (смотрит вправо)
            // 300 градусов -> кадр 159 (смотрит влево)
            const targetFrame = gsap.utils.mapRange(0, 300, 0, frameCount - 1, normalizedAngle);

            gsap.to(cameraState, {
                frame: targetFrame,
                // duration: 0.7,
                duration: 0.9,
                // ease: "power1.out",
                // ease: "expo.out",
                ease: "power2.out",
                onUpdate: render,
                overwrite: "auto"
            });
        });
    }

}