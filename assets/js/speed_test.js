const start = performance.now();
//? Опционально: отследить paint (FCP)
if ('PerformanceObserver' in window) {
    const obs = new PerformanceObserver(list => {
        for (const entry of list.getEntries()) {
            if (entry.name === 'first-contentful-paint') {
                // FCP произошёл — можно запускать безопасно
                // ... ваши фоновые задачи
                console.log('FCP произошёл — можно запускать безопасно');
                console.log('... ваши фоновые задачи');
                const end = performance.now();
                console.log(`FCP Время выполнения: ${end - start} мс`);

            }
        }
    });
    obs.observe({ type: 'paint', buffered: true });
}


let lcp;
if ('PerformanceObserver' in window) {
    const po = new PerformanceObserver((list) => {
        for (const entry of list.getEntries()) {
            lcp = entry; // сохраняем последний

            console.log('LCP', lcp.startTime);

        }
    });
    po.observe({ type: 'largest-contentful-paint', buffered: true });


}

let clsValue = 0;
if ('PerformanceObserver' in window) {
    const po = new PerformanceObserver((list) => {
        for (const entry of list.getEntries()) {
            if (!entry.hadRecentInput) clsValue += entry.value;

            console.log('CLS', clsValue);

        }
    });
    po.observe({ type: 'layout-shift', buffered: true });

}


let longTasks = [];
if ('PerformanceObserver' in window) {
    const po = new PerformanceObserver((list) => {
        for (const entry of list.getEntries()) {
            longTasks.push(entry); // entry.duration
        }
    });
    po.observe({ type: 'longtask', buffered: true });
    window.addEventListener('load', () => {
        // позиция начала интервала — используйте FCP или 0
        const fcpEntry = performance.getEntriesByType('paint').find(e => e.name === 'first-contentful-paint');
        const startTime = fcpEntry ? fcpEntry.startTime : 0;
        let tbt = 0;
        for (const t of longTasks) {
            if (t.startTime >= startTime && t.startTime <= (performance.now())) {
                const blocking = Math.max(0, t.duration - 50);
                tbt += blocking;
            }
        }

        console.log('TBT', tbt);
    });
}


// Слушатели событий
window.addEventListener('DOMContentLoaded', () => {
    const end = performance.now();
    console.log(`DOMContentLoaded Время выполнения: ${end - start} мс`);

});


window.addEventListener('load', () => {
    const end = performance.now();
    console.log(`load Время выполнения: ${end - start} мс`);

});