window.addEventListener('DOMContentLoaded', () => {
    console.log('init equipment-supply js...');



});




window.addEventListener('load', () => {


    initEquipmentAnimationGSAP()




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


// ? loadVideo

// async function loadVideoFromDataSrc(videoSelector, callback) {
//     const video = document.querySelector(videoSelector);
//     if (!video) return Promise.reject(new Error('Video element not found'));

//     // Берём data-src с самого <video> (или можно с data- атрибута source)
//     const dataSrc = video.getAttribute('data-src') || video.dataset.src;
//     if (!dataSrc) return Promise.reject(new Error('data-src not found'));

//     // Найдём <source> (или создадим, если отсутствует)
//     let source = video.querySelector('source');
//     if (!source) {
//         source = document.createElement('source');
//         video.appendChild(source);
//     }

//     source.src = dataSrc;
//     source.type = 'video/mp4';

//     // Перезагрузим элемент, чтобы браузер начал загрузку
//     video.load();

//     return new Promise((resolve, reject) => {
//         // Таймаут на случай, если событие не придёт
//         const timeoutMs = 30000; // 30s, подстройте по необходимости
//         const to = setTimeout(() => {
//             cleanup();
//             reject(new Error('Timed out waiting for video to be ready'));
//         }, timeoutMs);

//         function onCanPlayThrough() {
//             cleanup();
//             resolve();
//         }

//         function onError(e) {
//             cleanup();
//             reject(new Error('Video failed to load'));
//         }

//         function cleanup() {
//             clearTimeout(to);
//             video.removeEventListener('canplaythrough', onCanPlayThrough);
//             video.removeEventListener('error', onError);
//         }

//         video.addEventListener('canplaythrough', onCanPlayThrough, { once: true });
//         video.addEventListener('error', onError, { once: true });
//     }).then(() => {
//         if (typeof callback === 'function') callback(video);
//         return video;
//     });
// }


// ? initEquipmentAnimationGSAP
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

    const scanSound = new Audio('./animations/scanning.mp3');
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



    const receiptSound = new Audio('./animations/receipt.mp3');
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
