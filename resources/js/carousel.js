const Carousel = (total) => ({
    slide: 0,
    total: total,
    interval: null,
    isPaused: false,

    isCurrent(index) {
        return this.slide === index;
    },
    $watch: {
        slide() {
            console.log('slide changed', this.slide)
        },
    },
    start() {
        this.interval = setInterval(() => {
            if (!this.isPaused) {
                this.next();
            }
        }, 2000);
    },

    stop() {
        clearInterval(this.interval);
    },

    next() {
        this.slide = (this.slide + 1) % this.total;
    },

    prev() {
        this.slide = (this.slide - 1 + this.total) % this.total;
    },

    goTo(index) {
        if (index >= 0 && index < this.total) {
            this.slide = index;
        }
    },

    pause() {
        this.isPaused = true;
        stop();
    },
});

window.Carousel = Carousel;
