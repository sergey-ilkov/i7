function setVh() {
    const vh = window.visualViewport ? window.visualViewport.height : window.innerHeight;
    document.documentElement.style.setProperty('--vh', `${vh * 0.01}px`);

}
setVh();
window.addEventListener('resize', setVh);
if (window.visualViewport) {
    window.visualViewport.addEventListener('resize', setVh);
}


// const BREAKPOINT = 1024; // 768 или 1024 - по вашему выбору
const BREAKPOINT = 768; // 768 или 1024 - по вашему выбору

window.addEventListener('DOMContentLoaded', () => {

    // gsap.registerPlugin(ScrollTrigger, ScrollToPlugin, SplitText);
    gsap.registerPlugin(MotionPathPlugin, Observer, ScrollTrigger, ScrollToPlugin, SplitText)



});

let lenis = null;
let lenisRAF = null;
let lenisTick;

let swiperInstances = [];
let gsapInited = false;

function initLenis() {
    if (lenis) return;
    lenis = new Lenis({
        lerp: 0.1,
        duration: 1.2,           // чувствительность инерции (регулируйте)
        easing: t => Math.min(1, 1.001 - Math.pow(2, -10 * t)), // плавный easing
        smooth: true,
        smoothTouch: true,      // можно включить для мобильных (тестируйте)
        // smoothTouch: false,      // можно включить для мобильных (тестируйте)
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

    // После смены состояния обязательно обновлять триггеры
    // ScrollTrigger.refresh();
}

window.addEventListener('load', () => {

    initLenis();

    // ? initSmoothToHomePortfolioHash(); нужно чтобы все анимации GSAp проинициализировались

    initSmoothToHomePortfolioHash();

    loadMainVideo();

    initMessageShow();

    initBtnUp();
    initRealClock();



    initAppointmentSlider();
    initAppointmentShowImageFace();


    initVideoIntersectionObserver();
    initImageIntersectionObserver();

    initThemeObserver();

    // initSmoothToHomePortfolioHash();

});





function isMobile() {
    return /Android|iPhone|iPad|iPod|Windows Phone/i.test(navigator.userAgent) || window.innerWidth <= 767;
}



// ? =========================================
// ? burger-menu
const body = document.querySelector('body');
const wrapper = document.querySelector('.wrapper');

const header = document.querySelector('.header');
// const digitalContentWrap = document.querySelector('.digital-content-wrap');


const burgerMenu = document.querySelector('#burger-menu');
const headerMenu = document.querySelector('#header-menu');

function toggleFixedBody() {
    let width1 = wrapper.offsetWidth;

    // console.log(width1);



    body.classList.toggle('fixed');




    let width2 = wrapper.offsetWidth;
    // console.log(width2);
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

            // const a = e.target.closest('a[href*="#home-portfolio"]') || e.target.closest('a[href*="#section3"]');
            const a = e.target.closest('a[href*="#home-portfolio"]');
            // e.preventDefault();
            if (!a) return;

            e.preventDefault();

            const url = new URL(a.href, location.origin);
            const samePage = url.pathname === location.pathname;
            // console.log('samePage ', samePage);
            // console.log('a.href ', a.href);

            // console.log(url.hash);

            // console.log('url.pathname + url.search + #section3; ', url.pathname + url.search + url.hash);
            // scrollLinkAnchor(link);

            // const hash = url.hash;

            if (samePage) {
                // локальный плавный скролл
                console.log('локальный плавный скролл');

                if (url.hash === '#home-portfolio') {
                    smoothToHomePortfolio();
                }
                // goToSection3();
                history.pushState(null, '', url.hash);
            } else {
                console.log('location.hash ', location.hash);
                // ставим флаг, чтобы при загрузке целевой страницы сделать плавный скролл
                // sessionStorage.setItem('scrollToSection', 'section3');
                sessionStorage.setItem('scrollToSection', url.hash);
                // переходим на страницу
                // location.href = url.pathname + url.search + '#section3';
                // location.href = url.pathname + url.search + url.hash;
                location.href = url.pathname + url.search;
            }

        })
    })
}

function initSmoothToHomePortfolioHash() {
    const scrollToHomePortfolio = sessionStorage.getItem('scrollToSection') || (location.hash === '#home-portfolio' ? '#home-portfolio' : null);

    if (scrollToHomePortfolio) {
        // console.log('sessionStorage.getItem(scrollToSection) ', sessionStorage.getItem('scrollToSection'));
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

    const btnUp = document.querySelector('#btn-up');
    if (!btnUp) return;
    btnUp.addEventListener('click', () => {

        scrollToY(0, { duration: 0.2, ease: 'power2.out', behavior: 'smooth' });
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