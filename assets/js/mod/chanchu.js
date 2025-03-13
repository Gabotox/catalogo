const originalWarn = console.warn;
console.warn = function (...args) {
    if (args.some(arg => typeof arg === "string" && arg.includes("Swiper Loop Warning"))) {
        return; // Ignorar solo el warning de loop
    }
    originalWarn.apply(console, args);
};
