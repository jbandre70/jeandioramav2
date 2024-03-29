class ObLink extends HTMLElement {
    constructor() {
        super();
        this.url = atob(this.getAttribute('href'));
        this.target = this.getAttribute('target');
    }

    connectedCallback() {
        this.addEventListener('click', this);
    }

    onClick(e) {
        this.target?.endsWith('blank')
            ? window.open(this.url)
            : window.location.href = this.url;
    }

    handleEvent(e) {
        this.onClick(e);
    }
}
customElements.define('ob-link', ObLink);