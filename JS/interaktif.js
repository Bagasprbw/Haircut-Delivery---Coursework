document.addEventListener('DOMContentLoaded', function () {
    window.addEventListener('scroll', function () {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 10) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    const desktopSidebar = document.getElementById('desktopSidebar');
    const desktopToggleBtn = document.getElementById('desktopSidebarToggle');
    const closeSidebarBtn = document.getElementById('closeSidebar');
    const overlay = document.getElementById('sidebarOverlay');

    // Toggle sidebar
    function toggleSidebar() {
        desktopSidebar.classList.toggle('show');
        overlay.classList.toggle('show');

        // Rotasi ikon
        const icon = desktopToggleBtn.querySelector('i');
        icon.classList.toggle('fa-times');
        icon.classList.toggle('fa-bars');
    }

    // Event listeners
    desktopToggleBtn.addEventListener('click', toggleSidebar);

    closeSidebarBtn.addEventListener('click', function () {
        desktopSidebar.classList.remove('show');
        overlay.classList.remove('show');
        desktopToggleBtn.querySelector('i').classList.add('fa-bars');
        desktopToggleBtn.querySelector('i').classList.remove('fa-times');
    });

    overlay.addEventListener('click', function () {
        desktopSidebar.classList.remove('show');
        overlay.classList.remove('show');
        desktopToggleBtn.querySelector('i').classList.add('fa-bars');
        desktopToggleBtn.querySelector('i').classList.remove('fa-times');
    });
});

// gallery.js
function scrollGallery(direction) {
    const container = document.getElementById('worksContainer');
    const scrollAmount = container.clientWidth * direction;
    container.scrollBy({
        top: 0,
        left: scrollAmount,
        behavior: 'smooth'
    });
}

document.addEventListener('DOMContentLoaded', function () {
    const imageUploadForm = document.getElementById('imageUploadForm');

    imageUploadForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const imageFile = document.getElementById('imageFile').files[0];
        const imageAlt = document.getElementById('imageAlt').value;

        if (imageFile) {
            const reader = new FileReader();

            reader.onload = function (event) {
                const container = document.getElementById('worksContainer');

                // Check if max images reached
                if (container.children.length >= 10) {
                    alert('Maximum number of images (10) reached. Remove an image first.');
                    return;
                }

                // Create new work item
                const newWorkItem = document.createElement('div');
                newWorkItem.classList.add('work-item');

                const img = document.createElement('img');
                img.src = event.target.result;
                img.alt = imageAlt;

                newWorkItem.appendChild(img);
                container.appendChild(newWorkItem);

                // Reset form
                imageUploadForm.reset();

                // Notify user of successful upload
                alert('Image added successfully!');
            };

            reader.readAsDataURL(imageFile);
        }
    });
});