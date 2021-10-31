document.addEventListener('DOMContentLoaded', () => {

    class Accordion {

        constructor({
            target,
            el
        }) {
            this.target = target;
            this.el = el;
            this.open();
        }

        open() {
            const btns = document.querySelectorAll(`${this.target}`)
            if (!btns) return;
            for (let i = 0; i < btns.length; i++) {
                let btn = btns[i].querySelector(`${this.el}`);
                if (!btn) continue;
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    btns[i].classList.toggle('show-menu');
                })
            }
        }

    }


    const htmElement = {
        cross: `<button class="mobile-sidebar-btn" type="button" title="close-sidebar">
    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M8.40994 7L12.7099 2.71C12.8982 2.5217 13.004 2.2663 13.004 2C13.004 1.7337 12.8982 1.47831 12.7099 1.29C12.5216 1.1017 12.2662 0.995911 11.9999 0.995911C11.7336 0.995911 11.4782 1.1017 11.2899 1.29L6.99994 5.59L2.70994 1.29C2.52164 1.1017 2.26624 0.995911 1.99994 0.995911C1.73364 0.995911 1.47824 1.1017 1.28994 1.29C1.10164 1.47831 0.995847 1.7337 0.995847 2C0.995847 2.2663 1.10164 2.5217 1.28994 2.71L5.58994 7L1.28994 11.29C1.19621 11.383 1.12182 11.4936 1.07105 11.6154C1.02028 11.7373 0.994141 11.868 0.994141 12C0.994141 12.132 1.02028 12.2627 1.07105 12.3846C1.12182 12.5064 1.19621 12.617 1.28994 12.71C1.3829 12.8037 1.4935 12.8781 1.61536 12.9289C1.73722 12.9797 1.86793 13.0058 1.99994 13.0058C2.13195 13.0058 2.26266 12.9797 2.38452 12.9289C2.50638 12.8781 2.61698 12.8037 2.70994 12.71L6.99994 8.41L11.2899 12.71C11.3829 12.8037 11.4935 12.8781 11.6154 12.9289C11.7372 12.9797 11.8679 13.0058 11.9999 13.0058C12.132 13.0058 12.2627 12.9797 12.3845 12.9289C12.5064 12.8781 12.617 12.8037 12.7099 12.71C12.8037 12.617 12.8781 12.5064 12.9288 12.3846C12.9796 12.2627 13.0057 12.132 13.0057 12C13.0057 11.868 12.9796 11.7373 12.9288 11.6154C12.8781 11.4936 12.8037 11.383 12.7099 11.29L8.40994 7Z" fill="#011350"/>
</svg>
               </button>`,

        navButton: `<button class="nav-mobile-dropdown-btn" type="button" title="open dropdown">
<svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M11.999 6.83001C11.9994 6.68061 11.9712 6.533 11.9163 6.39802C11.8614 6.26304 11.7813 6.14412 11.6819 6.05001L6.53948 1.22001C6.38613 1.07293 6.19377 0.992523 5.99525 0.992523C5.79673 0.992523 5.60437 1.07293 5.45101 1.22001L0.308639 6.22001C0.133613 6.38974 0.0235451 6.63366 0.0026501 6.89808C-0.0182449 7.16251 0.0517445 7.42579 0.197221 7.63001C0.342698 7.83422 0.551745 7.96265 0.778375 7.98703C1.005 8.0114 1.23065 7.92974 1.40568 7.76L5.99954 3.29001L10.5934 7.61C10.7192 7.73229 10.8724 7.80996 11.0348 7.83384C11.1973 7.85772 11.3622 7.82681 11.5101 7.74475C11.658 7.6627 11.7826 7.53294 11.8692 7.37083C11.9559 7.20871 12.0009 7.02104 11.999 6.83001Z" fill="#011350" fill-opacity="0.5"/>
</svg>
                   </button>`
    }


    function createHtmlElement({
        parentNode,
        el,
        position = 'afterbegin'
    }) {
        const parent = document.querySelectorAll(`${parentNode}`)
        for (let i = 0; i < parent.length; i++) {
            if (!parent[i]) return;
            parent[i].insertAdjacentHTML(`${position}`, `${el}`);
        }
    }


    function sidebarMenu() {
        let sidebar = document.querySelector('.wp-block-group__inner-container')
        let closeBtn = document.querySelector('.mobile-sidebar-btn');

        let openBtn = document.querySelector('.mobile__btn-filter');
        if (!sidebar || !closeBtn || !openBtn) return;

        openBtn.addEventListener('click', open);

        closeBtn.addEventListener('click', close);

        function open() {
            sidebar.classList.add('show-sidebar')
        }

        function close() {
            sidebar.classList.remove('show-sidebar')
        }
    }

    createHtmlElement({
        parentNode: '.wp-block-group__inner-container',
        el: htmElement.cross
    });


    createHtmlElement({
        parentNode: '.mobile_nav .sub-menu',
        el: htmElement.navButton,
        position: 'beforebegin'
    });


    const sidebarAccordion = new Accordion({
        target: '.woocommerce-widget-layered-nav',
        el: '.widgettitle',
    });

    const mobileMenuAccordion = new Accordion({
        target: '.mobile_nav .menu-item.menu-item-has-children',
        el: '.nav-mobile-dropdown-btn',
    });


    sidebarMenu();

})