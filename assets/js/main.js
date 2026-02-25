function setVh() {
    const vh = window.visualViewport ? window.visualViewport.height : window.innerHeight;
    document.documentElement.style.setProperty('--vh', `${vh * 0.01}px`);

}
setVh();
window.addEventListener('resize', setVh);
if (window.visualViewport) {
    window.visualViewport.addEventListener('resize', setVh);
}

window.addEventListener('DOMContentLoaded', () => {
    gsap.registerPlugin(ScrollTrigger, ScrollToPlugin, SplitText);
    // gsap.registerPlugin(MotionPathPlugin, ScrollTrigger, ScrollToPlugin, SplitText);




});

let lenis = null;
let lenisRAF = null;
let lenisTick;



function initLenis() {
    if (lenis) return;
    lenis = new Lenis({
        lerp: 0.1,
        duration: 1.2,           // чувствительность инерции (регулируйте)
        easing: t => Math.min(1, 1.001 - Math.pow(2, -10 * t)), // плавный easing
        smooth: true,
        smoothTouch: true,      // можно включить для мобильных (тестируйте)    
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
const BREAKPOINT = 768;
function enableLenisIfDesktop() {

    const isDesktop = window.innerWidth > BREAKPOINT;
    if (isDesktop) {
        initLenis();
    } else {
        destroyLenis();
    }
    // После смены состояния обязательно обновлять триггеры
    // ScrollTrigger.refresh();
}

window.addEventListener('load', () => {


    initLenis();


    //  ? протестировать, можно только на главной странице
    initSmoothToHomePortfolioHash();

    // ? init general
    initGeneralScript();



    // ? home page js
    const homePage = document.querySelector('.page-home');


    if (homePage) {
        initHomeScript();
    }
    // ? digital page js
    const digitalPage = document.querySelector('.page-digital');
    if (digitalPage) {
        initDigitalScript();
    }
    // ? branding page js
    const brandingPage = document.querySelector('.page-branding');
    if (brandingPage) {
        initBrandingScript();
    }
    // ? solutions page js
    const solutionsPage = document.querySelector('.page-solutions');
    if (solutionsPage) {
        gsap.registerPlugin(MotionPathPlugin);
        initSolutionsScript();
    }
    // ? equipment page js
    const equipmentPage = document.querySelector('.page-equipment');
    if (equipmentPage) {
        initEquipmentScript();
    }
    // ? contacts page js
    const contactsPage = document.querySelector('.page-contacts');
    if (contactsPage) {
        initContactsScript();
    }




});

// ? general js
function initGeneralScript() {
    loadMainVideo();

    initMessageShow();

    initBtnUp();
    initRealClock();



    initAppointmentSlider();
    initAppointmentShowImageFace();


    initVideoIntersectionObserver();
    initImageIntersectionObserver();

    initThemeObserver();
}






// ? general js
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

function isMobile() {
    return /Android|iPhone|iPad|iPod|Windows Phone/i.test(navigator.userAgent) || window.innerWidth <= 767;
}



// ? =========================================
// ? burger-menu
const body = document.querySelector('body');
const wrapper = document.querySelector('.wrapper');

const header = document.querySelector('.header');

const burgerMenu = document.querySelector('#burger-menu');
const headerMenu = document.querySelector('#header-menu');

function toggleFixedBody() {
    let width1 = wrapper.offsetWidth;

    body.classList.toggle('fixed');

    let width2 = wrapper.offsetWidth;

    let margin = width2 - width1;
    if (body.classList.contains('fixed')) {
        correctionWrapper(margin);
    } else {
        correctionWrapper();
    }
}

function correctionWrapper(margin = 0) {


    wrapper.style.marginRight = margin + 'px';
    header.style.right = margin + 'px';


}

function scrollToElement(el, height = 0) {
    let offsetPositon = el.getBoundingClientRect().top - height;
    window.scrollBy({
        top: offsetPositon,
        behavior: 'smooth',
    });
}

if (burgerMenu && headerMenu) {
    burgerMenu.addEventListener('click', () => {
        headerMenu.classList.add('open');
        toggleFixedBody();

    })

    const btnMenuClose = headerMenu.querySelector('.btn-close');

    btnMenuClose.addEventListener('click', () => {
        headerMenu.classList.remove('open');
        toggleFixedBody();

    })
}

const anchorLinks = document.querySelectorAll('.link-anchor');
if (anchorLinks.length) {
    anchorLinks.forEach(link => {
        link.addEventListener('click', (e) => {

            if (headerMenu.classList.contains('open')) {
                headerMenu.classList.remove('open');
                toggleFixedBody();
            }


            const a = e.target.closest('a[href*="#home-portfolio"]');

            if (!a) return;

            e.preventDefault();

            const url = new URL(a.href, location.origin);
            const samePage = url.pathname === location.pathname;

            if (samePage) {

                if (url.hash === '#home-portfolio') {
                    smoothToHomePortfolio();
                }

                history.pushState(null, '', url.hash);
            } else {
                sessionStorage.setItem('scrollToSection', url.hash);

                location.href = url.pathname + url.search;
            }

        })
    })
}

function initSmoothToHomePortfolioHash() {
    const scrollToHomePortfolio = sessionStorage.getItem('scrollToSection') || (location.hash === '#home-portfolio' ? '#home-portfolio' : null);

    if (scrollToHomePortfolio) {

        sessionStorage.removeItem('scrollToSection');
        // Даём время на layout и расчёт пинов, затем скроллим
        // небольшой таймаут + ScrollTrigger.refresh()
        setTimeout(() => {
            smoothToHomePortfolio();
        }, 60); // 60–200ms в зависимости от тяжести страницы; при SPA можно замерить готовность
    }
}

// ? scrollToPlugin smoothToHomePortfolio()
function smoothToHomePortfolio() {
    const target = document.querySelector('#home-portfolio');
    if (!target) return;
    // обновляем расчёты перед прокруткой
    ScrollTrigger.refresh();
    const portfolioContent = document.querySelector('.home-portfolio-circle-content');
    const portfolioContentRect = portfolioContent.getBoundingClientRect();

    const y = target.getBoundingClientRect().top + window.pageYOffset - portfolioContentRect.height;
    gsap.to(window, {
        duration: 4,
        scrollTo: { y: y, autoKill: false },
        ease: 'power2.inOut',
        onComplete() {
            // обязательно обновить триггеры после перемещения
            ScrollTrigger.refresh();
            // console.log('ScrollTrigger.refresh()');
            // при необходимости "прокрутить" scrub-анимацию:
            // const st = ScrollTrigger.getById('section3-trigger'); // если задали id
            // st && st.update();
        }
    });
}



// ? =========================================

function scrollToY(y, opts = {}) {
    // Clamp y to >= 0
    const targetY = Math.max(0, Math.round(y));

    // Если есть Lenis
    if (window.lenis && typeof window.lenis.scrollTo === 'function') {
        // lenis.scrollTo принимает (target, options?) в зависимости от версии
        try {
            window.lenis.scrollTo(targetY, opts);
            return;
        } catch (e) {
            // fallthrough to other methods
        }
    }

    // Если подключён GSAP ScrollToPlugin
    if (window.gsap && gsap && gsap.core && gsap.core.plugins && gsap.core.plugins.ScrollToPlugin) {
        gsap.to(window, { duration: opts.duration ?? 0.6, scrollTo: targetY, ease: opts.ease ?? 'power2.out' });
        return;
    }

    // Нативный smooth scroll (fallback)
    if ('scrollTo' in window) {
        window.scrollTo({ top: targetY, behavior: opts.behavior ?? 'smooth' });
        return;
    }

    // Последний fallback: instant
    window.scrollTo(0, targetY);
}

function initBtnUp() {

    // const wrapper = document.querySelector('.wrapper');

    const btnUp = document.querySelector('#btn-up');
    if (!btnUp) return;
    btnUp.addEventListener('click', () => {

        scrollToY(0, { duration: 0.2, ease: 'power2.out', behavior: 'smooth' });
        // ScrollTrigger.refresh();

        // gsap.to(window, {
        //     duration: 2,
        //     scrollTo: { y: 0, autoKill: false },
        //     ease: 'power2.inOut',
        //     onComplete() {
        //         ScrollTrigger.refresh();
        //     }
        // })
    })


}


// ? Load Hero Main video
function loadMainVideo() {
    // mainVideo
    const video = document.querySelector('#mainVideo');
    if (!video) return;

    const VIDEO_SRC = video.getAttribute('data-src'); // или data атрибут
    const VIDEO_TYPE = 'video/mp4';
    // const MIN_WIDTH_FOR_VIDEO = 480; // порог для отключения на very small screens
    const CONNECTION = navigator.connection || navigator.mozConnection || navigator.webkitConnection;

    function shouldLoadVideo() {
        // не грузить на медленных сетях
        if (CONNECTION && (CONNECTION.saveData || /2g|slow-2g/.test(CONNECTION.effectiveType))) return false;
        // if (window.innerWidth < MIN_WIDTH_FOR_VIDEO) return false;
        return true;
    }



    function insertAndPlayVideo() {

        if (!shouldLoadVideo()) return;

        const source = document.createElement('source');
        source.src = VIDEO_SRC;
        source.type = VIDEO_TYPE;
        video.appendChild(source);

        // опционально: убрать poster после загрузки кадров
        // video.addEventListener('loadeddata', () => {
        //     video.dataset.videoLoaded = 'true';
        //     // можно убрать poster если нужно:
        //     // video.removeAttribute('poster');
        // }, { once: true });

        // попытаться автозапустить
        const p = video.play();
        if (p && p.catch) {
            p.catch(() => {
                // autoplay заблокирован — оставляем poster; можно показать кнопку play
            });
        }
    }

    insertAndPlayVideo();


}


// ? real clock
function initRealClock() {

    const timeEl = document.getElementById('real-time');
    const dateEl = document.getElementById('real-date');

    if (!timeEl || !dateEl) return;

    /**
         * Получает желаемую локаль из атрибута lang корневого элемента.
         * Если не задан, используется 'en' по умолчанию.
         */
    function getLocaleFromDocument() {
        const rootLang = document.documentElement.getAttribute('lang');
        // Нормализуем: пустой или нестроковый => 'en'
        return (typeof rootLang === 'string' && rootLang.trim().length > 0)
            ? rootLang.trim()
            : 'en';
    }

    /**
     * Форматирует текущую дату и время под заданную локаль.
     * Для времени: формат "hh:mm AM/PM" для en или 24ч для локалей с 24-часовым форматом.
     * Для даты: формат "Month day, year" для en; для ru — "26 января 2026 г." (локаль сама решит).
     *
     * Возвращает объект { timeString, dateString }.
     */
    function formatNow(locale, dateObj) {
        // Опции для времени: показываем часы и минуты; используем 12ч или 24ч
        // автоматически по локали с помощью hour12: undefined — но не все браузеры поддерж. Явно вычислим для en.
        const isEnglish = locale.startsWith('en');
        const timeOptions = {
            hour: 'numeric',
            minute: '2-digit',
            hour12: isEnglish // en -> 12-часовой с AM/PM, ru -> false (24ч)
        };

        // Опции для даты: полный месяц, день и год
        const dateOptions = {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };

        const timeFormatter = new Intl.DateTimeFormat(locale, timeOptions);
        const dateFormatter = new Intl.DateTimeFormat(locale, dateOptions);

        return {
            timeString: timeFormatter.format(dateObj),
            dateString: dateFormatter.format(dateObj)
        };
    }



    function runClock() {
        const locale = getLocaleFromDocument(); // получаем локаль один раз


        // Обновление: синхронизируемся по началу секунды для более гладкого обновления
        function update() {
            const now = new Date();
            const formatted = formatNow(locale, now);
            timeEl.textContent = formatted.timeString;
            dateEl.textContent = formatted.dateString;
        }

        // Синхронизированный интервал: запускаем первый апдейт немедленно
        // затем ставим setTimeout до следующей секунды, потом setInterval каждую секунду.
        update();

        // Рассчитать миллисекунды до начала следующей секунды
        const msToNextSecond = 1000 - (Date.now() % 1000);

        // Запускаем интервал после выравнивания
        setTimeout(() => {
            update();
            // Обновляем каждую секунду — это достаточно для минутных и секундных изменений.
            // Можно увеличить интервал до 60_000 если нужна только смена минут.
            setInterval(update, 1000);
        }, msToNextSecond);
    }
    runClock();

}




// ? initAppointmentSlider initAppointmentShowImageFace



let flagAppointmentSlider = false;
const arrayAppointmentSlider = [];

function initAppointmentSlider() {



    flagAppointmentSlider = window.matchMedia("(max-width: 800px)").matches;
    // console.log(arrayAppointmentSlider);

    if (flagAppointmentSlider) {

        // ? chek and kill

        if (arrayAppointmentSlider.length > 0) {

            return;
        }


        const appointmentSliders = document.querySelectorAll('.appointment-slider');
        if (appointmentSliders.length > 0) {
            appointmentSliders.forEach(slider => {
                const newSlider = new Swiper(slider, {
                    slidesPerView: "auto",
                    // slidesPerView: 1,
                    centeredSlides: true,
                    spaceBetween: 20,
                    // pagination: {
                    //     el: ".swiper-pagination",
                    //     clickable: true,
                    // },
                    // on: {
                    //     slideChange: function () {
                    //         console.log('Активный слайд (индекс): ' + this.activeIndex);
                    //         console.log('Активный слайд (DOM-элемент):', this.slides[this.activeIndex]);
                    //     },
                    // },
                });

                arrayAppointmentSlider.push(newSlider);

            })

            // console.log(arrayAppointmentSlider);


        }
    } else {

        // console.log('Else ', arrayAppointmentSlider);
        // ? chek and kill
        if (arrayAppointmentSlider.length > 0) {

            arrayAppointmentSlider.forEach(slider => {
                // slider.slideTo(0, 0);
                // slider.disable();

                slider.destroy(true, true);
                slider = null; // Очищаем переменную

                // console.log('Очищаем переменную');
            })

            arrayAppointmentSlider.length = 0;
        }
    }

    // console.log(arrayAppointmentSlider);

}

function initAppointmentShowImageFace() {
    const appointmentBoxs = document.querySelectorAll('.appointment-box');
    if (appointmentBoxs.length > 0) {
        appointmentBoxs.forEach(box => {
            const appointmentSlideImages = box.querySelectorAll('.appointment-slide__img-face');
            const appointmentSlideLinks = box.querySelectorAll('.appointment-slide__link');
            const appointmentLinks = box.querySelectorAll('.appointment__link');
            // console.log(appointmentSlideImages);
            // console.log(appointmentSlideLinks);
            // console.log(appointmentLinks);

            appointmentSlideLinks.forEach((link, i) => {
                link.addEventListener('mouseenter', () => {
                    appointmentSlideImages[i].classList.add('show');
                })
                link.addEventListener('mouseleave', () => {
                    appointmentSlideImages[i].classList.remove('show');

                })
            })

            appointmentLinks.forEach((link, i) => {
                link.addEventListener('mouseenter', () => {
                    appointmentSlideImages[i].classList.add('show');
                })
                link.addEventListener('mouseleave', () => {
                    appointmentSlideImages[i].classList.remove('show');

                })
            })
        })
    }
}




function initVideoIntersectionObserver() {

    // Селектор для всех видео, которые нужно контролировать
    const videos = Array.from(document.querySelectorAll('video.track-visibility'));

    // Состояния для каждого видео: был ли он playing до скрытия/вне viewport
    const state = new WeakMap(); // video -> { wasPlaying: bool, isInViewport: bool }


    // Настройки
    const rootMargin = '0px'; // можно увеличить (например '200px') чтобы загружать заранее
    const threshold = 0.25;   // доля видимости, при которой считаем video "в viewport"
    const allowAutoplayForVisible = true; // если true — при возвращении в viewport попытаемся play()

    // Инициализация state
    videos.forEach(v => {
        state.set(v, { wasPlaying: false, isInViewport: false });
        // Чтобы не слушать лишний timeupdate, не делаем ничего лишнего
        // Убедимся что видео используют muted для разрешения autoplay (опционально)
        // v.muted = true;
    });

    // IntersectionObserver для отслеживания вьюпорта
    const io = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            const vid = entry.target;
            const s = state.get(vid) || { wasPlaying: false, isInViewport: false };
            const visible = entry.intersectionRatio >= threshold;
            s.isInViewport = visible;
            state.set(vid, s);

            if (!visible) {
                // Вышло за пределы — запомним, был ли playing, и поставим на паузу
                s.wasPlaying = !vid.paused && !vid.ended && vid.readyState > 2;
                try { vid.pause(); } catch (e) { /* ignore */ }

                // console.log('video: ', vid);
                // console.log('vid.paused: ', vid.paused);
                // console.log('');
                // checkVideo('hidden');
            } else {
                // Вошло в viewport — если было playing до ухода или разрешаем авто, попробуем запустить
                if (s.wasPlaying || allowAutoplayForVisible) {
                    vid.play().catch(() => {
                        // autoplay может быть заблокирован; ничего делать не будем
                    });


                }

                // console.log('video: ', vid);
                // console.log('vid.paused: ', vid.paused);
                // console.log('');
                // checkVideo('visible');
            }

            // checkVideo('IntersectionObserver');
        });
    }, { root: null, rootMargin, threshold });

    // Наблюдаем видео
    videos.forEach(v => io.observe(v));

    // Visibility API: при скрытии всей вкладки — останавливаем все и помним состояние
    document.addEventListener('visibilitychange', () => {
        if (document.visibilityState === 'hidden') {
            videos.forEach(v => {
                const s = state.get(v) || {};
                s.wasPlaying = !v.paused && !v.ended && v.readyState > 2;
                state.set(v, s);
                try { v.pause(); } catch (e) { /* ignore */ }

                // console.log('video: ', v);
                // console.log('vid.paused: ', v.paused);
                // console.log('');
                // checkVideo('hidden');
            });


        } else if (document.visibilityState === 'visible') {
            // При возврате пробуем возобновить только те, которые были playing и видимы
            videos.forEach(v => {
                const s = state.get(v) || {};
                if (s.wasPlaying && s.isInViewport) {
                    v.play().catch(() => { /* autoplay blocked — ignore */ });
                }

                // console.log('video: ', v);
                // console.log('vid.paused: ', v.paused);
                // console.log('');
                // checkVideo('visible');
            });
        }
    });

    // Доп: очистка ресурсов, если нужно (например при SPA-рутировании)
    function disconnectVisibilityController() {
        io.disconnect();
        document.removeEventListener('visibilitychange', this);
    }

    // Рекомендации:
    // - Добавьте класс track - visibility к тем < video >, которые нужно контролировать.
    // - Для надежного autoplay ставьте muted = true у видео, если вы хотите автозапускать при входе в viewport.
    // - Увеличьте rootMargin до "200px" если хотите «предзагружать» и запускать видео чуть раньше.
    // - Тестируйте поведение на мобильных и слабых устройствах и с включённой экономией энергопотребления.

}

function checkVideo(event) {
    console.log('');
    console.log('new...');
    console.log('Event: ', event);

    const videos = document.querySelectorAll('video');
    videos.forEach(video => {
        console.log('video el: ', video);
        console.log('is_paused: ', video.paused);
        console.log('');
    })

}


function initImageIntersectionObserver() {

    // Находим все элементы с нашими классами
    const lazyElements = document.querySelectorAll('.lazy, .lazy-bg');

    // Настройки наблюдателя
    const options = {
        // start: когда элемент появляется в 200px от нижней границы экрана
        // (чтобы картинка успела загрузиться до того, как пользователь её увидит)
        rootMargin: "200px 0px 200px 0px",
        threshold: 0.01
    };

    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            // Если элемент попал в зону видимости
            if (entry.isIntersecting) {
                const target = entry.target;
                const img = entry.target;
                const picture = img.parentElement;

                // 1. Если img обернут в <picture>, обрабатываем <source>
                if (picture && picture.tagName === 'PICTURE') {
                    const sources = picture.querySelectorAll('source');
                    sources.forEach(source => {
                        if (source.dataset.srcset) {
                            source.srcset = source.dataset.srcset;
                            source.removeAttribute('data-srcset');
                        }
                    });
                }

                // 2. Устанавливаем основной src для img
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                }

                // 3. Если это блок с фоном
                if (target.dataset.bg) {
                    target.style.backgroundImage = `url(${target.dataset.bg})`;
                    target.removeAttribute('data-bg');
                }

                // 4. Плавно проявляем (через ваш CSS класс .loaded)
                img.onload = () => {
                    img.classList.add('loaded');
                };

                // Перестаем наблюдать за этим элементом, так как он уже загружен
                observer.unobserve(target);
            }
        });
    }, options);

    // Запускаем наблюдение за каждым элементом
    lazyElements.forEach(el => imageObserver.observe(el));


}


function isColorLight(color) {
    let r, g, b;

    // 1. Проверка на RGB / RGBA
    if (color.startsWith('rgb')) {
        const rgbValues = color.match(/\d+/g);
        r = parseInt(rgbValues[0]);
        g = parseInt(rgbValues[1]);
        b = parseInt(rgbValues[2]);
    }
    // 2. Проверка на HEX
    else if (color.startsWith('#')) {
        let hex = color.replace('#', '');
        if (hex.length === 3) {
            hex = hex.split('').map(char => char + char).join('');
        }
        r = parseInt(hex.substr(0, 2), 16);
        g = parseInt(hex.substr(2, 2), 16);
        b = parseInt(hex.substr(4, 2), 16);
    }
    else {
        // Если формат не распознан (например, 'transparent' или название цвета)
        return false;
    }

    // Формула относительной яркости (Luminance)
    const brightness = (r * 299 + g * 587 + b * 114) / 1000;

    // Возвращаем true, если яркость выше порога (128 — середина диапазона 0-255)
    return brightness > 128;
}

// ? test theme color

function initThemeObserver() {


    const sections = document.querySelectorAll('.section-bg');

    const wrapper = document.querySelector('.wrapper');

    if (!sections.length) return;


    // Функция установки класса на wrapper
    function setWrapperTheme(theme) {
        const addClass = theme;
        const removeClass = theme === 'is-light' ? 'is-dark' : 'is-light';
        if (!addClass) return;
        wrapper.classList.add(addClass);
        wrapper.classList.remove(removeClass);
    }


    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {

                const theme = entry.target.dataset.theme;
                // console.log(entry.target);
                // console.log(theme);

                wrapper.classList.toggle('is-light', theme === 'is-light');
                wrapper.classList.toggle('is-dark', theme === 'is-dark');

                // const addClass = theme;
                // const removeClass = theme === 'is-light' ? 'is-dark' : 'is-light';              
                // if (!addClass) return;
                // wrapper.classList.add(addClass);
                // wrapper.classList.remove(removeClass);

            }
        });
    }, {
        root: null,
        rootMargin: `-60px 0px -90% 0px`, // учитываем высоту header
        threshold: 0 // срабатывает когда секция заняла 50% видимой области
    });


    sections.forEach((section, index) => {
        const color = section.style.getPropertyValue('--section-bg').trim();


        const isLight = this.isColorLight(color);
        // classThemes.push(isLight ? 'is-light' : 'is-dark');
        // console.log(`Цвет: ${color}, Тема: ${isLight ? 'Светлая' : 'Темная'}`);

        const theme = isLight ? 'is-light' : 'is-dark';
        section.setAttribute('data-theme', theme);

        section.classList.add(theme);

        observer.observe(section);

    })


}




// ? initMessageShow
function initMessageShow() {

    const messageBox = document.querySelector('.hero-message-box');
    if (!messageBox) return;

    const rectMessageBox = messageBox.getBoundingClientRect();

    const messages = messageBox.querySelectorAll('.hero-message');


    const parentNode = messageBox.parentNode;

    // console.log('parentSection ', parentSection);
    const parentSectionRect = parentNode.getBoundingClientRect();

    parentNode.style.overflow = 'hidden';

    // const parentSection = messageBox.closest('section');

    // // console.log('parentSection ', parentSection);
    // const parentSectionRect = parentSection.getBoundingClientRect();

    // parentSection.style.overflow = 'hidden';

    // const windowH = window.innerHeight;
    // const bottom = windowH - rectMessageBox.bottom;
    const bottom = parentSectionRect.bottom - rectMessageBox.bottom;
    // console.log('bottom ', bottom);

    const gap = messages[1].getBoundingClientRect().top - messages[0].getBoundingClientRect().bottom;


    // console.log(parentSection);


    const msgsRects = [];

    messages.forEach(msg => {
        const msgRect = msg.getBoundingClientRect();


        const distanceFromBottom = parentSectionRect.bottom - msgRect.bottom;
        // console.log('distanceFromBottom ', distanceFromBottom);
        msgsRects.push(msgRect);

        // console.log('msgRect: ', msgRect);
        // console.log('windowH: ', windowH);
        // console.log('msgRect.bottom: ', msgRect.bottom);
        // console.log('msgRect.height: ', msgRect.height);
        // const startY = windowH - Math.abs(msgRect.bottom) + msgRect.height;
        const startY = distanceFromBottom + msgRect.height;

        // console.log('startY ', startY);
        gsap.set(msg, { y: startY });
        // gsap.set(msg, { y: startY, opacity: 1 });

    });


    // return;
    const tl = gsap.timeline({ defaults: { duration: 0.4, ease: "power1.out" } });

    // ? анимация первого сообщения
    // tl.to(messages[0], { y: `-=${msgsRects[0].height + bottom}` });

    // // ? анимация  первого и второго сообщения
    // tl.to(messages[0], { y: `-=${msgsRects[1].height + gap}` });
    // tl.to(messages[1], { y: `-=${msgsRects[1].height + bottom}` }, '<');

    // // ? анимация  первого, второго и третьего сообщения
    // tl.to(messages[0], { y: 0 }, '+=0.2');
    // tl.to(messages[1], { y: 0 }, '<');
    // tl.to(messages[2], { y: 0 }, '<');



    tl.to(messages, { opacity: 1, duration: 0.2 });

    for (let i = 0; i < messages.length; i++) {
        const h = msgsRects[i].height;

        if (i === 0) {
            tl.to(messages[0], { y: `-=${h + bottom}` });
            continue;
        }

        const delay = i % 2 === 0 ? 0.3 : 0;

        for (let j = 0; j < i; j++) {
            if (j == 0) {
                tl.to(messages[j], { y: `-=${h + gap}` }, `+=${delay}`); // синхронно с показом текущего
            }
            else {

                tl.to(messages[j], { y: `-=${h + gap}` }, '<'); // синхронно с показом текущего
            }

        }

        tl.to(messages[i], { y: `-=${h + bottom}` }, '<');
    }


    tl.add(() => {
        messages.forEach(m => gsap.set(m, { clearProps: 'y' }));
    }, '+=0.15');

}



// ?  loadVideoFromDataSrc
async function loadVideoFromDataSrc(videoSelector, callback) {
    const video = document.querySelector(videoSelector);
    if (!video) return Promise.reject(new Error('Video element not found'));

    // Берём data-src с самого <video> (или можно с data- атрибута source)
    const dataSrc = video.getAttribute('data-src') || video.dataset.src;
    if (!dataSrc) return Promise.reject(new Error('data-src not found'));

    // Найдём <source> (или создадим, если отсутствует)
    let source = video.querySelector('source');
    if (!source) {
        source = document.createElement('source');
        video.appendChild(source);
    }

    source.src = dataSrc;
    source.type = 'video/mp4';

    // Перезагрузим элемент, чтобы браузер начал загрузку
    video.load();

    return new Promise((resolve, reject) => {
        // Таймаут на случай, если событие не придёт
        const timeoutMs = 30000; // 30s, подстройте по необходимости
        const to = setTimeout(() => {
            cleanup();
            reject(new Error('Timed out waiting for video to be ready'));
        }, timeoutMs);

        function onCanPlayThrough() {
            cleanup();
            resolve();
        }

        function onError(e) {
            cleanup();
            reject(new Error('Video failed to load'));
        }

        function cleanup() {
            clearTimeout(to);
            video.removeEventListener('canplaythrough', onCanPlayThrough);
            video.removeEventListener('error', onError);
        }

        video.addEventListener('canplaythrough', onCanPlayThrough, { once: true });
        video.addEventListener('error', onError, { once: true });
    }).then(() => {
        if (typeof callback === 'function') callback(video);
        return video;
    });
}


// ? home page js
function initHomeScript() {




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
        const portfolioDesc = services.querySelector('.home-portfolio__desc');
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



    // ? init script
    initHeroSlider();
    initHomePortfolioSlider();

    // ? GSAP
    initAnimationCardsGSAP();
    initServicesGSAP();

}


// ? digital page js
function initDigitalScript() {




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





                contents.forEach(content => {
                    content.style.display = 'block';
                })




                checkAnchorScroll();


            }



            timerContentId = setTimeout(() => {
                clearTimeout(timerContentId);

                initSplitContent();

            }, 1000);






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


    // ? init script
    initDigitalScrollGSAP();
    initDigitalAnimationGSAP();
}


// ? branding page js
function initBrandingScript() {


    function initBrandingAnimationLottieGSAP() {

        // console.log('Lottie загружен:', lottie);

        const sections = document.querySelectorAll('.branding-box');

        if (!sections.length) return;

        // return;

        const psths = [
            themeData.templateUrl + '/assets/animations/branding-01.json',
            themeData.templateUrl + '/assets/animations/branding-02.json',
            themeData.templateUrl + '/assets/animations/branding-03.json',
            themeData.templateUrl + '/assets/animations/branding-04.json',
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
                // console.log("Lottie загружен, кадров:", animation.totalFrames);

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


            });




        })

        // Обновляем ScrollTrigger после инициализации всего кода
        ScrollTrigger.refresh();

    }



    // ? init script
    initBrandingAnimationLottieGSAP();
}

// ? solutions page js
function initSolutionsScript() {




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
                img.src = `${themeData.templateUrl}/assets/animations/camera/${i}.webp`;
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
        // console.log('Lottie загружен:', lottie);

        const solutionsNetworkLines = document.querySelector('#solutions-network-lottie');
        if (!solutionsNetworkLines) return;


        const path = themeData.templateUrl + '/assets/animations/network.json';
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
            // console.log("Lottie загружен, кадров:", animation.totalFrames);
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

            // console.log('cfg: ', cfg);

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

        const path = themeData.templateUrl + '/assets/animations/automation.json';
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
            // console.log("Lottie загружен, кадров:", animation.totalFrames);

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



                // console.log(CURSOR_SIZE);

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





    // ? init script
    initSolutionsCameraCards();

    initCameraCursor();

    initSolutionsNetworkAnimationGSAP();

    initFireSystemsAnimationGSAP();

    let timer = null;

    timer = setTimeout(() => {
        clearTimeout(timer);
        // console.log('start');
        initSolutionsAutomationAnimationGSAP();


    }, 500);

}


// ? equipment page js
function initEquipmentScript() {


    function initEquipmentAnimationGSAP() {

        function initDate() {
            const dateEl = document.getElementById('receipt-date');
            if (!dateEl) return;

            function getLocaleFromDocument() {
                const rootLang = document.documentElement.getAttribute('lang');
                return (typeof rootLang === 'string' && rootLang.trim().length > 0)
                    ? rootLang.trim()
                    : 'en';
            }

            const locale = getLocaleFromDocument();
            const now = new Date();
            const options = { year: 'numeric', month: 'numeric', day: 'numeric' };
            const date = now.toLocaleString(locale, options);

            dateEl.textContent = date;

            // console.log(date);

        }
        initDate();




        const heroEquipment = document.querySelector('#hero-equipment');
        if (!heroEquipment) return;

        const btnPrev = heroEquipment.querySelector('.equipment-slider-btn-prev');
        const btnNext = heroEquipment.querySelector('.equipment-slider-btn-next');

        const slides = heroEquipment.querySelectorAll('.equipment-slide');

        const scanSound = new Audio(themeData.templateUrl + '/assets/animations/scanning.mp3');
        scanSound.load(); // Предзагрузка

        let indexActive = 0;

        const TOTAL = slides.length - 1;


        let video = null;



        // ? load video
        // Использование:
        loadVideoFromDataSrc('#equipment-video')
            .then(videoLoad => {
                // console.log('Video loaded and ready');
                video = videoLoad;
                updateButtonsState();

            })
            .catch(err => console.error(err));



        // ? Video update
        let isAnimating = false;
        const boxTimings = [
            { start: 0, center: 0.1 },     // Состояние "пусто"
            { start: 0.1, center: 2.1 }, // Коробка 1
            { start: 2.1, center: 4.2 }, // Коробка 2
            { start: 4.2, center: 6.3 }, // Коробка 3
            { start: 6.3, center: 8.4 }  // Коробка 4
        ];

        async function updateConveyor(direction) {


            if (isAnimating) return;
            isAnimating = true;
            scannerStarted = false; // СБРОС ФЛАГА перед новым заездом
            updateButtonsState(true);


            if (direction === 'next') indexActive++;
            else indexActive--;

            // 1. Смена слайда (прячем старый, показываем новый)
            // Запускаем одновременно с видео
            switchSlide(indexActive);

            // 2. Анимация чека ПРИ ОТКАТЕ (Назад)
            if (direction === 'prev') {
                // ПРИ ДВИЖЕНИИ НАЗАД:
                // Опускаем чек на ПРЕДЫДУЩИЙ уровень относительно целевого
                // Чтобы потом он "допечатался" до текущего
                gsap.to('.receipt-wrap', {
                    height: getTargetWrapHeight(indexActive - 1),
                    duration: 0.4,
                    ease: "power2.inOut"
                });
            }

            // 3. Работа с видео
            const targetTime = boxTimings[indexActive].center;

            // Прячем старый чек и сканер (если были)
            gsap.to(["#scanner", ".scanner-bg"], { opacity: 0, duration: 0.3 });


            if (Math.abs(video.currentTime - targetTime) > 0.1) {
                if (direction === 'prev') video.currentTime = boxTimings[indexActive].start;
                // await safePlay(video);
                video.play();
                gsap.ticker.add(checkVideoTime);
            } else {
                // Если видео уже на 0, запускаем сканер сразу
                scannerStarted = true;
                playScannerAnimation();
            }

        }

        // ? video Update
        const leadTime = 1; // За сколько секунд ДО остановки запускать сканер
        let scannerStarted = false; // Флаг, чтобы не запустить сканер дважды за один цикл

        function checkVideoTime() {
            const targetTime = boxTimings[indexActive].center;
            const timeLeft = targetTime - video.currentTime;

            // 1. ПРОВЕРКА НА ЗАПУСК СКАНЕРА (с упреждением)
            if (!scannerStarted && timeLeft <= leadTime) {
                scannerStarted = true;
                // console.log("Запуск сканера с опережением 1с");
                playScannerAnimation(); // Запускаем сканер, пока видео еще едет
            }

            // Если идем вперед — проверяем >=, если назад — проверяем <=
            // Но проще всего проверять близость к точке:
            if (video.currentTime >= targetTime) {
                gsap.ticker.remove(checkVideoTime);
                video.pause();
                video.currentTime = targetTime;

            }

        }


        // ? SplitText add letters 
        const slidesData = [];

        const contents = document.querySelectorAll('.equipment-slide');
        contents.forEach(content => {
            content.style.display = 'none';
        })

        // Инициализируем все слайды
        slides.forEach((slide, i) => {
            const num = slide.querySelector('.equipment-slide-num');
            const text = slide.querySelector('.equipment-slide-text');
            // Разбиваем на символы
            const splitNum = new SplitText(num, { type: "chars" });
            const splitText = new SplitText(text, { type: "chars, words" });

            // Скрываем символы сразу (подготовка к анимации)
            gsap.set([splitNum.chars, splitText.chars], { opacity: 0 });

            slidesData.push({
                el: slide,
                numChars: splitNum.chars,
                textChars: splitText.chars
            });

            gsap.set(slide, { opacity: 1 });
        });

        let timerId = null;
        timerId = setTimeout(() => {
            clearTimeout(timerId);
            contents.forEach(content => {
                content.style.display = 'block';
            })
        }, 2000);




        // ? Slide animation
        // ?  switchSlide
        let currentSlideIndex = 0;

        function switchSlide(newIndex, isInitial = false) {
            const tl = gsap.timeline();

            // 1. Если это не первая загрузка (0 слайд), прячем текущий
            if (!isInitial) {
                const oldSlide = slidesData[currentSlideIndex];
                tl.to([oldSlide.textChars, oldSlide.numChars], {
                    opacity: 0,
                    duration: 0.15, // Быстрое исчезновение
                    stagger: -0.005,
                    ease: "power2.in"
                })
                    .set(oldSlide.el, { display: 'none' });
            }

            // 2. Показываем новый слайд
            const nextSlide = slidesData[newIndex];
            tl.set(nextSlide.el, { display: 'block' })
                .to(nextSlide.numChars, {
                    opacity: 1,
                    duration: 0.2,
                    stagger: 0.02
                })
                .to(nextSlide.textChars, {
                    opacity: 1,
                    stagger: 0.01
                }, "-=0.1");

            currentSlideIndex = newIndex;
            return tl;
        }

        // При загрузке страницы:
        switchSlide(0, true);



        btnPrev.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            // console.log('click prev');
            // console.log('isAnimating ', isAnimating);

            if (isAnimating) return;

            if (indexActive > 0) {

                // console.log('activeIndex ', indexActive);
                updateConveyor('prev');

            }

        })

        btnNext.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            // console.log('click next');
            // console.log('isAnimating ', isAnimating);
            if (isAnimating) return;

            if (indexActive < TOTAL) {

                // console.log('activeIndex ', indexActive);
                updateConveyor('next');
            }
        })


        function updateButtonsState(disableAll = false) {
            if (disableAll || isFrozen) {
                // Полная блокировка на время анимации
                btnPrev.disabled = true;
                btnNext.disabled = true;
                btnPrev.classList.add('disabled');
                btnNext.classList.add('disabled');
            } else {
                // Разблокировка с проверкой границ
                // Кнопка "Назад" не активна на 0 слайде
                btnPrev.disabled = (indexActive === 0);
                btnPrev.classList.toggle('disabled', indexActive === 0);

                // Кнопка "Вперед" не активна на последнем слайде
                const isLast = indexActive === boxTimings.length - 1;
                btnNext.disabled = isLast;
                btnNext.classList.toggle('disabled', isLast);
            }
        }

        updateButtonsState(true);

        // ? Audio scannner 
        const scanner = document.querySelector('#scanner');
        const scannerBg = document.querySelector('.scanner-bg');
        const wrapper = document.querySelector('.equipment-slider-wrap');
        const barcode = document.querySelector('#equipment-barcode');

        // Вычисляем координаты    
        function playScannerAnimation() {

            if (indexActive == 0) {
                runReceiptPrinting();
                isAnimating = false;
                return;
            }

            // Вычисляем координаты
            const wrapperRect = wrapper.getBoundingClientRect();
            const barcodeRect = barcode.getBoundingClientRect();
            // Точка центра баркода относительно верха обертки
            const barcodeCenter = (barcodeRect.top - wrapperRect.top) + (barcodeRect.height / 2);
            // Точка чуть выше баркода (для замедления)
            const barcodeTopZone = (barcodeRect.top - wrapperRect.top) - 30;

            const tl = gsap.timeline();

            // 1. Быстрое проявление и рывок вниз
            tl.to(scanner, { opacity: 1, duration: 0.2, ease: "power2.in" })
                .to(scanner, { y: wrapperRect.height * 0.9, duration: 0.8, ease: "power1.in" })
                // 2. Замедление перед баркодом
                .to(scanner, { y: barcodeTopZone, duration: 0.5, },)

                // 3. Опускается точно по центру баркода
                .to(scanner, { y: barcodeCenter, duration: 0.5, ease: "none" })

                // 4. Звук и включение подсветки (scanner-bg)
                // МОМЕНТ СКАНА
                .add(() => {
                    scanSound.currentTime = 0;
                    scanSound.play();
                })
                .to(scannerBg, { opacity: 1, duration: 0.1 })
                // 5. Удержание 0.5 сек и выключение подсветки
                .to(scannerBg, { opacity: 0, duration: 0.3 }, "+=0.3")
                .add(() => {
                    // console.log("Сканер закончил работу. Пора печатать чек...");
                    runReceiptPrinting();
                    isAnimating = false;
                })
                // 6. Уход вверх и исчезновение
                .to(scanner, { y: 0, opacity: 0, duration: 0.8, ease: "power2.inOut" })

            return tl; // Возвращаем timeline, чтобы можно было встроить в общую цепочку
        }



        const receiptSound = new Audio(themeData.templateUrl + '/assets/animations/receipt.mp3');
        receiptSound.load();

        let receiptHeights = [];
        let receiptGap = 0;
        let receiptPaddingTop = 0;
        let receiptPaddingBottom = 0;
        let isFrozen = false; // Флаг для финальной заморозки

        function initReceiptData() {

            const receiptContainer = document.querySelector('.receipt');
            const items = document.querySelectorAll('.receipt-item');
            const style = window.getComputedStyle(receiptContainer);

            // Получаем значение gap и padding-top из CSS
            receiptGap = parseFloat(style.columnGap || style.gap) || 0;
            receiptPaddingTop = parseFloat(style.paddingTop) || 0;
            receiptPaddingBottom = parseFloat(style.paddingBottom) || 0;

            receiptHeights = Array.from(items).map(item => item.offsetHeight);
        }

        initReceiptData();
        // console.log('receiptGap ', receiptGap);
        // Пункт 1: Начальное появление (слайд 00)    
        // Устанавливаем высоту для 0 слайда с учетом новых расчетов
        gsap.set('.receipt-wrap', { height: getTargetWrapHeight(0) });

        // console.log('receiptHeights: ', receiptHeights);

        // ? runReceiptPrinting();


        function runReceiptPrinting() {
            // console.log("Animation runReceiptPrinting()...");

            // Пример анимации появления чека (замените на вашу логику)
            if (isFrozen) return;

            const wrap = document.querySelector('.receipt-wrap');
            const tl = gsap.timeline({
                onComplete: () => {
                    // Проверка на последний слайд для заморозки
                    if (indexActive === 4) {
                        isFrozen = true;
                        // console.log("Конвейер заморожен. Конец работы.");
                    }
                    // Разблокировка кнопок (кроме случая freeze)
                    isAnimating = false;
                    updateButtonsState();
                }
            });
            const shouldPlaySound = indexActive > 0;

            if (indexActive === 4) {
                // Рассчитываем промежуточные высоты для финальной печати
                // h3 - это высота до 3 слайда включительно
                const h3 = getTargetWrapHeight(3);

                // Поэтапно добавляем следующие блоки + их Gap
                const h4 = h3 + receiptHeights[4] + receiptGap;
                const h5 = h4 + receiptHeights[5] + receiptGap;
                const h6 = h5 + receiptHeights[6] + receiptGap;

                tl.add(() => receiptSound.play())
                    .to(wrap, { height: h4, duration: 0.4 })
                    .add(() => { receiptSound.currentTime = 0; receiptSound.play(); }, "+=0.2")
                    .to(wrap, { height: h5, duration: 0.4 })
                    .add(() => { receiptSound.currentTime = 0; receiptSound.play(); }, "+=0.2")
                    .to(wrap, { height: h6, duration: 0.4 });
            }
            else {
                if (shouldPlaySound) {
                    tl.add(() => {
                        receiptSound.currentTime = 0;
                        receiptSound.play();
                    });
                }

                tl.to(wrap, {
                    height: getTargetWrapHeight(indexActive),
                    duration: 0.6,
                    ease: "power2.out"
                });
            }
        }

        // Универсальная функция получения высоты обертки для конкретного индекса
        function getTargetWrapHeight(index) {
            if (index < 0) return 0;

            // Сумма высот элементов
            const totalItemsHeight = receiptHeights.slice(0, index + 1).reduce((a, b) => a + b, 0);

            // Сумма Gap (по одному после каждого элемента)
            const totalGaps = (index + 1) * receiptGap;

            // Базовая высота: контент + гапы + верхний паддинг
            let finalHeight = totalItemsHeight + totalGaps + receiptPaddingTop;

            // Добавляем нижний паддинг ТОЛЬКО если мы на последнем слайде (индекс 4)
            // В вашем случае 4-й слайд — это когда выведены все элементы, включая Text end 2
            if (index === 4) {
                finalHeight += receiptPaddingBottom;
            }

            return finalHeight;
        }

    }



    // ? init script
    initEquipmentAnimationGSAP();
}


// ? contacts page js
function initContactsScript() {


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

            const bgColor = slides[activeIndex].style.getPropertyValue('--contact-color').trim();;

            if (bgColor) {
                form.style.setProperty('--form-bg', bgColor);
            }
        }
    }


    function initContactsForm() {
        console.log('initContactsForm: send data');
    }
    // ? init script
    initContactsSlider();

    initContactsForm();

}