import Glide from '@glidejs/glide';

window.glideSliders = [];

const getSlides = (ele) => Array.from((ele || document).querySelectorAll('.glide__slide'));
const getTotalSlides = (ele) => getSlides(ele).length;

/**
 * Parse and return dataset options for glidejs creation.
 * @param {String} data String to be parsed
 */
const parseSliderOptions = (data) => JSON.parse(data || {});

/**
 * Sets slide index in dataset
 * @param {HTMLElement} ele
 */
const addSlidesIndex = (ele) => getSlides(ele)
    .forEach((slide, index) => slide.setAttribute('data-glide-index', index));

/**
 * Returns the component glidejs in glideSliders
 * @param {string} componentName The component name
 * @return {Object} The glidejs instance by component.
 */
const getGliderByComponentName = (componentName) =>
    window.glideSliders[componentName];

/**
 * Return the HTMLElement slide wrapper.
 * @param {string} componentName the component name
 * @returns {HTMLElement}
 */
const getWrapperByComponentName = (componentName) =>
    getGliderByComponentName(componentName).selector.parentElement;

/**
 * Update the progress bar element inside component
 * @param {Object} Options object with options glide creation
 */
const updateProgressBar = ({ componentName }) => {
    const progressBar = getWrapperByComponentName(componentName).querySelector('.glide__scrollbar-progress');
    const currentIndex = getGliderByComponentName(componentName).index + 1;
    const totalSlide = getTotalSlides(getWrapperByComponentName(componentName));
    progressBar.style.width = `${(currentIndex / totalSlide) * 100}%`;
};

/**
 * Add events for scroll bar element.
 * @param {Object} gd Glidejs instance
 * @param {Object} options Options for glide creation
 */
const addProgressBar = (gd, { componentName, progressBarEnabled }) => {
    if (progressBarEnabled) {
        gd.on(['move.after'], () => {
            updateProgressBar({ componentName });
        });
    }
};

/**
 * Create a element bullet as button and return it
 * @param {Number} index Index number for navigation controls.
 * @returns {HTMLElement} The bullet Element
 */
const createBulletItem = (index) => {
    const bulletEle = document.createElement('button');
    bulletEle.setAttribute('data-glide-dir', `=${index}`);
    bulletEle.classList.add('glide__bullet');
    return bulletEle;
};

/**
 * Create a bulletsWrapper and return it
 * @param {HTMLElement} ele Glide wrapper element.
 * @param {Object} options Options for glide creation
 */
const addBullets = (ele, { bullets }) => {
    if (!bullets) return;
    const bulletsWrapper = document.createElement('div');
    bulletsWrapper.classList.add('glide__bullets');
    bulletsWrapper.setAttribute('data-glide-el', 'controls[nav]');
    Array.from(ele.querySelectorAll('.glide__slide'))
        .forEach((item, index) => bulletsWrapper.appendChild(createBulletItem(index)));
    ele.appendChild(bulletsWrapper);
};

/**
 * Create a arrowsWrapper and return it
 * @param {HTMLElement} ele Glide wrapper element.
 * @param {Object} options Options for glide creation
 */
const addArrows = (ele) => {
    const arrowsWrapper = document.createElement('div');
    arrowsWrapper.classList.add('glide__arrows');
    arrowsWrapper.setAttribute('data-glide-el', 'controls');

    // ArrowLeft
    const arrowsLeft = document.createElement('button');
    arrowsLeft.classList.add('glide__arrow', 'glide__arrow--left');
    arrowsLeft.setAttribute('data-glide-dir', '<');
    arrowsLeft.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" style="transform: rotate(180deg)"><path d="M1.5 0v2.025l3.977 2.932L1.5 8.062V10l7-4.84z" fill="#9561e2" />';
    arrowsWrapper.appendChild(arrowsLeft);

    // ArrowLeft
    const arrowsRight = document.createElement('button');
    arrowsRight.classList.add('glide__arrow', 'glide__arrow--right');
    arrowsRight.setAttribute('data-glide-dir', '>');
    arrowsRight.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"><path d="M1.5 0v2.025l3.977 2.932L1.5 8.062V10l7-4.84z" fill="#9561e2" />';
    arrowsWrapper.appendChild(arrowsRight);

    ele.appendChild(arrowsWrapper);
};

/**
* Inits glidejs element with options param
* @param {Object} options Options params for initialize glidejs.
*/
const initGlide = (ele, index) => {
    addSlidesIndex(ele);
    const options = parseSliderOptions(ele.dataset.slider);
    if (options.bullets) {
        addBullets(ele, options);
    }
    if (options.arrows) {
        addArrows(ele);
    }
    const gd = new Glide(ele, options);
    const divCount = ele.querySelector('.glide__arrow-count');
    if (divCount) {
        const maxCount = ele.querySelectorAll('.glide__slide').length;
        gd.on(['mount.after', 'run'], () => {
        divCount.innerHTML = `${gd.index + 1}/${maxCount}`;
        });
    }
    gd.mount();
    addProgressBar(gd, options);
    const componentName = options.componentName || index;
    return {
        [componentName]: gd,
    };
};

/**
 * Init glide components, run selector and create it on window.glideSliders
 */
const initSliders = () => {
    if (window.glideSliders && window.glideSliders.length > 0) return;
    window.glideSliders = Array.from(document
        .querySelectorAll('.glide'))
        .reduce((acc, ele, index) => {
            const gd = initGlide(ele, index);
            return { ...acc, ...gd };
        }, {});
};

/**
 * listening window load event
 */
window.addEventListener('load', () => initSliders());
