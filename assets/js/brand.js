window.addEventListener('DOMContentLoaded', () => {
    console.log('init branding js...');
    // gsap.registerPlugin(ScrollTrigger, SplitText);


});



// const BREAKPOINT = 1024; // 768 или 1024 - по вашему выбору
// const BREAKPOINT = 768; // 768 или 1024 - по вашему выбору

// let lenis = null;
// let lenisRAF = null;
// let lenisTick;
// let swiperInstances = [];
// let gsapInited = false;




function initLenis() {
    if (lenis) return;
    lenis = new Lenis({
        lerp: 0.1,
        duration: 1.2,           // чувствительность инерции (регулируйте)
        easing: t => Math.min(1, 1.001 - Math.pow(2, -10 * t)), // плавный easing
        smooth: true,
        smoothTouch: false,      // можно включить для мобильных (тестируйте)
        wheelMultiplier: 1,      // множитель колеса мыши
        infinite: false,
        // gestureOrientation: 'vertical',
        // smoothWheel: true,
    });

    function raf(time) {
        lenis.raf(time);
        lenisRAF = requestAnimationFrame(raf);
    }
    lenisRAF = requestAnimationFrame(raf);

    // Синхронизация Lenis с ScrollTrigger
    lenis.on('scroll', ScrollTrigger.update);

    // Добавление Lenis в тикер GSAP
    // сохраняем ссылку, чтобы потом удалить
    lenisTick = (time) => lenis.raf(time * 1000);
    gsap.ticker.add(lenisTick);


    // Отключаем лаг сглаживания (опционально для более точного соответствия)
    gsap.ticker.lagSmoothing(0);


}

function destroyLenis() {
    if (!lenis) return;

    if (lenisRAF) { cancelAnimationFrame(lenisRAF); lenisRAF = null; }

    // удаляем gsap тик
    if (lenisTick) { gsap.ticker.remove(lenisTick); lenisTick = null; }

    // удаляем событие scroll
    if (lenis.off) lenis.off('scroll', ScrollTrigger.update);

    if (lenis.destroy) lenis.destroy();
    lenis = null;

    // восстановить lagSmoothing (пример возврата к значениям по умолчанию)
    try { gsap.ticker.lagSmoothing(0); } catch (e) { }

    ScrollTrigger.refresh();

}

// Управление режимом скролла в зависимости от ширины
function enableLenisIfDesktop() {

    const isDesktop = window.innerWidth > BREAKPOINT;
    if (isDesktop) {
        initLenis();
    } else {
        destroyLenis();
    }


    // console.log('lenis: ', lenis);
    // После смены состояния обязательно обновлять триггеры
    // ScrollTrigger.refresh();
}

let timerId = null;

window.addEventListener('load', () => {

    // enableLenisIfDesktop();

    // initLenis();

    initBrandingAnimationLottieGSAP();



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
    // при смене ширины/режима нужно пересоздать анимации
    // console.log('resize');

    // enableLenisIfDesktop();

    // initDigitalAnimationGSAP();



    // синхронизация с Lenis если активен
    // if (window.lenis && typeof lenis.resize === 'function') lenis.resize();
    if (lenis && typeof lenis.resize === 'function') lenis.resize();

    ScrollTrigger.refresh();

}, 200);

window.addEventListener('resize', onResize);




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



// ? initMessageShow
// function initMessageShow() {

//     const messageBox = document.querySelector('.hero-message-box');
//     if (!messageBox) return;

//     const rectMessageBox = messageBox.getBoundingClientRect();

//     const messages = messageBox.querySelectorAll('.hero-message');


//     const windowH = window.innerHeight;
//     const bottom = windowH - rectMessageBox.bottom;
//     const gap = messages[1].getBoundingClientRect().top - messages[0].getBoundingClientRect().bottom;


//     const msgsRects = [];

//     messages.forEach(msg => {
//         const msgRect = msg.getBoundingClientRect();
//         msgsRects.push(msgRect);

//         const startY = windowH - msgRect.bottom + msgRect.height;
//         gsap.set(msg, { y: startY, opacity: 1 });

//     });


//     const tl = gsap.timeline({ defaults: { duration: 0.4, ease: "power1.out" } });

//     // ? анимация первого сообщения
//     // tl.to(messages[0], { y: `-=${msgsRects[0].height + bottom}` });

//     // // ? анимация  первого и второго сообщения
//     // tl.to(messages[0], { y: `-=${msgsRects[1].height + gap}` });
//     // tl.to(messages[1], { y: `-=${msgsRects[1].height + bottom}` }, '<');

//     // // ? анимация  первого, второго и третьего сообщения
//     // tl.to(messages[0], { y: 0 }, '+=0.2');
//     // tl.to(messages[1], { y: 0 }, '<');
//     // tl.to(messages[2], { y: 0 }, '<');




//     for (let i = 0; i < messages.length; i++) {
//         const h = msgsRects[i].height;

//         if (i === 0) {
//             tl.to(messages[0], { y: `-=${h + bottom}` });
//             continue;
//         }

//         const delay = i % 2 === 0 ? 0.3 : 0;

//         for (let j = 0; j < i; j++) {
//             if (j == 0) {
//                 tl.to(messages[j], { y: `-=${h + gap}` }, `+=${delay}`); // синхронно с показом текущего
//             }
//             else {

//                 tl.to(messages[j], { y: `-=${h + gap}` }, '<'); // синхронно с показом текущего
//             }

//         }

//         tl.to(messages[i], { y: `-=${h + bottom}` }, '<');
//     }


//     tl.add(() => {
//         messages.forEach(m => gsap.set(m, { clearProps: 'y' }));
//     }, '+=0.15');

// }



// ?
// Время работает на вас -  branding-time.json

// Создание цифрового бренда - branding-digital.json
// Индивидуальный подход - branding-personal.json
//  Брендинг с вашими целями развития -  branding-goals.json


function initBrandingAnimationLottieGSAP() {

    console.log('Lottie загружен:', lottie);

    const sections = document.querySelectorAll('.branding-box');

    if (!sections.length) return;

    // return;

    const psths = [
        './animations/branding-01.json',
        './animations/branding-02.json',
        './animations/branding-03.json',
        './animations/branding-04.json',
    ];

    sections.forEach((section, index) => {
        const container = section.querySelector('.branding-lottie');
        const content = section.querySelector('.branding-content');

        gsap.set(content, { opacity: 0 });

        const path = psths[index];
        if (!path) return;


        const animation = lottie.loadAnimation({
            container: container, // Элемент на странице
            renderer: 'svg', // Тип рендера: 'svg', 'canvas' или 'html'
            // loop: false,      // Зациклить?
            loop: true,      // Зациклить?
            // autoplay: true,  // Запустить сразу?
            autoplay: false,  // Запустить сразу?
            path: path // Путь к твоему JSON файлу
        });

        // Создаем объект-посредник для анимации кадров
        let playhead = { frame: 0 };

        animation.addEventListener('DOMLoaded', () => {
            console.log("Lottie загружен, кадров:", animation.totalFrames);

            // Только ТЕПЕРЬ создаем ScrollTrigger

            // СОЗДАЕМ ТАЙМЛАЙН GSAP
            ScrollTrigger.create({

                trigger: container,
                start: "top 100%",     // Начинаем, когда верх секции доходит до верха экрана
                // end: "+=200%",        // Длительность скролла (чем больше число, тем медленнее скролл)
                // pin: true,            // Фиксируем секцию на месте, пока идет анимация
                // scrub: 1,             // Плавная привязка к скроллу (1 сек инерции).
                // Именно scrub отвечает за работу анимации в ОБРАТНУЮ сторону.
                end: "bottom 0%", // Можно настроить, когда анимация должна остановиться (опционально)

                // Использование toggleActions — самый простой способ
                // Порядок: onEnter, onLeave, onEnterBack, onLeaveBack
                // "play" — играть, "pause" — пауза, "resume" — продолжить, "reset" — в начало
                toggleActions: "play pause resume pause",
                // Если нужны более сложные действия, используем функции:
                onEnter: () => animation.play(),
                onLeave: () => animation.pause(),
                onEnterBack: () => animation.play(),
                onLeaveBack: () => animation.pause(),

                // markers: true,

            });

            gsap.to(content, {
                opacity: 1,
                y: 0,
                duration: 1,
                scrollTrigger: {
                    trigger: content,
                    start: "top 80%", // Появится чуть позже, чем запустится Lottie
                    // toggleActions: "play none none reverse" // Появится при скролле вниз, исчезнет при скролле вверх
                }
            });

            // ? Совет: Если хочешь, чтобы анимация всегда начиналась заново при входе в зону видимости, замени в toggleActions значение resume на restart.

            //             Разбор параметров:
            //             start: "top 50%": Первая часть(top) — это край твоего элемента.Вторая часть(50 %) — это точка на экране.Как только они встречаются, срабатывает onEnter.

            //                 toggleActions: "play pause resume pause":

            //             play: Когда закроллили сверху вниз до отметки(анимация пошла).

            //                 pause: Когда ушли вниз и элемент скрылся(экономим ресурсы процессора).

            //                     resume: Когда вернулись снизу вверх(анимация продолжилась с того же места).

            //                         pause: Когда ушли вверх за пределы экрана.

            // Без scrub: Анимация проигрывается со своей естественной скоростью, заданной в After Effects, независимо от того, насколько быстро или медленно пользователь крутит колесико.

            // Без pin: Страница продолжает скроллиться в обычном режиме, блок не «прилипает».



            // // ШАГ 1: Анимация Lottie (занимает первую часть таймлайна)
            // tl.to(playhead, {
            //     frame: animation.totalFrames - 1,
            //     ease: "none", // Для скролла лучше использовать none
            //     onUpdate: () => animation.goToAndStop(playhead.frame, true),
            //     duration: 1 // Относительная длительность в таймлайне
            // });

            // // ШАГ 2: Анимация контента (появление после Lottie)
            // tl.to(content, {
            //     opacity: 1,
            //     y: -20,       // Немного приподнимаем для красоты
            //     duration: 0.5,
            //     ease: "power2.out"
            // }, "-=0.2");    // Нахлест (start 0.2 сек до конца анимации Lottie), чтобы было бесшовно
        });




    })

    // Обновляем ScrollTrigger после инициализации всего кода
    ScrollTrigger.refresh();

}