class Toast {
    constructor(config) {
        this.config = {
            type: config.type || 'info',
            title: config.title || '',
            message: config.message || '',
            icon: this.getIcon(config.type) || '' // Automatically select icon based on type
        };

        this.toastElement = null;
        this.progressElement = null;

        this.render();
        this.show();
        this.autoClose();
    }

    getIcon(type) {
        // Define mapping of type to icon class
        const iconMap = {
            'info': 'fa-info-circle',
            'warning': 'fa-exclamation-triangle',
            'error': 'fa-exclamation-circle',
            'success': 'fa-check-circle',
            'default': 'fa-info-circle'
        };
        // Return icon class based on type, or default if not found
        return iconMap[type] || iconMap['default'];
    }

    render() {
        this.toastElement = document.createElement('div');
        this.toastElement.classList.add('toast', `bg-${this.config.type}`, 'text-white', 'z-2', 'position-fixed', 'top-0', 'end-0', 'm-3', 'fade');
        this.toastElement.innerHTML = `
            <div class="toast-body rounded-3 d-flex">
                <div class="row">
                    <div class="col-1 text-center d-flex align-items-center p-0 mx-3 my-2 fs-4 lh-1">
                        <i class="fas fa-xl ${this.config.icon} me-2 my-2"></i>
                    </div>
                    <div class="col-auto my-auto">
                        <p class="fw-bold m-0 p-0 lh-1">${this.config.title}</p>
                        <span>
                            ${this.config.message}
                        </span>
                    </div>
                </div>
                <div class="ms-auto text-white">
                    <button type="button" class="btn-close" aria-label="Close"></button>
                </div>
            </div>
            <div class="toast-progress"></div> <!-- Progress bar element -->
        `;
        document.body.appendChild(this.toastElement);

        this.progressElement = this.toastElement.querySelector('.toast-progress');
        this.progressElement.style.height = '0.25rem'; // Setting height of progress bar
        this.progressElement.style.width = '100%'; // Initially setting width to 100%
        this.progressElement.style.backgroundColor = 'rgba(255, 255, 255, 0.5)'; // Setting background color

        // Attach event listener to close button
        const closeButton = this.toastElement.querySelector('.btn-close');
        closeButton.addEventListener('click', () => {
            this.hide();
        });
    }

    show() {
        this.toastElement.classList.add('show');
    }

    hide() {
        this.toastElement.classList.remove('show');
        setTimeout(() => {
            this.toastElement.remove();
        }, 500); // Wait for the fade out transition to complete before removing the element
    }

    autoClose() {
        const duration = 3000; // Total duration for auto closing
        const increment = 10; // Increment interval for updating progress bar
        let currentTime = 0;
        let progressBarInterval;

        const updateProgressBar = () => {
            currentTime += increment;
            const progress = (currentTime / duration) * 100;
            this.progressElement.style.width = `${progress}%`;
            this.progressElement.setAttribute('aria-valuenow', progress); // Update ARIA attribute for screen readers

            if (currentTime >= duration) {
                clearInterval(progressBarInterval);
                this.hide();
            }
        };

        const startProgressBar = () => {
            progressBarInterval = setInterval(updateProgressBar, increment);
            updateProgressBar(); // Initial call to update progress bar immediately
        };

        startProgressBar();

        // Pause progress bar and auto close on mouse hover
        this.toastElement.addEventListener('mouseenter', () => {
            clearInterval(progressBarInterval);
            this.progressElement.style.transition = 'none'; // Pause transition effect
        });

        // Resume progress bar and auto close on mouse leave
        this.toastElement.addEventListener('mouseleave', () => {
            startProgressBar();
            this.progressElement.style.transition = ''; // Resume transition effect
        });
    }
}

window.showToast = function(type, title, message = '') {
    new Toast({ type, title, message });
}
