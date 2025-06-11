// Data gambar (ambil dari folder img atau database)
const galleryImages = [{
    src: "./img/haircut1.jpg",
    alt: "Haircut 1"
},
{
    src: "./img/haircut2.jpg",
    alt: "Haircut 2"
},
{
    src: "./img/haircut3.jpg",
    alt: "Haircut 3"
},
{
    src: "./img/haircut4.jpg",
    alt: "Haircut 4"
},
{
    src: "./img/haircut5.jpg",
    alt: "Haircut 5"
},
{
    src: "./Dashboard/data_gambar/img_683c47a63f6448.46137112.jpeg",
    alt: "Haircut 6"
},
{
    src: "./img/haircut6.jpg",
    alt: "Haircut 5"
},
{
    src: "./img/haircut7.jpg",
    alt: "Haircut 5"
}
];

// Render gallery items
const galleryScroll = document.getElementById('galleryScroll');
galleryScroll.innerHTML = galleryImages.map(image => `
            <div class="gallery-item">
                <img src="${image.src}" alt="${image.alt}" class="img-fluid">
            </div>
        `).join('');

// Auto-scroll functionality
let scrollAmount = 0;
let autoScroll = true;
const scrollStep = () => {
    const itemWidth = galleryScroll.querySelector('.gallery-item').offsetWidth;
    return itemWidth + 15; // Lebar item + gap
};

const scrollInterval = setInterval(() => {
    if (!autoScroll) return;

    scrollAmount += scrollStep();

    if (scrollAmount >= galleryScroll.scrollWidth - galleryScroll.offsetWidth) {
        scrollAmount = 0;
        galleryScroll.scrollTo({
            left: 0,
            behavior: 'auto'
        });
        setTimeout(() => {
            galleryScroll.scrollBy({
                left: scrollStep(),
                behavior: 'smooth'
            });
        }, 1000);
    } else {
        galleryScroll.scrollTo({
            left: scrollAmount,
            behavior: 'smooth'
        });
    }
}, 3000);

// Pause auto-scroll on interaction
galleryScroll.addEventListener('mouseenter', () => autoScroll = false);
galleryScroll.addEventListener('mouseleave', () => autoScroll = true);
galleryScroll.addEventListener('touchstart', () => autoScroll = false);
galleryScroll.addEventListener('touchend', () => autoScroll = true);
