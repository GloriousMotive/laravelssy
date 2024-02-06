function syncDaisyThemeWithFilament() {
    // observe changes to the html attribute class, if it changes, update the data-theme attribute (important for daisyui themes to work with filament dark mode)
    let html = document.querySelector('html');
    let observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
            if (mutation.attributeName === 'class') {
                let htmlClass = html.getAttribute('class');
                // if it has "dark" in the class, set the data-theme attribute to dark
                if (htmlClass.includes('dark')) {
                    html.setAttribute('data-theme', 'dark');
                } else {
                    html.setAttribute('data-theme', 'light');
                }
            }
        });
    });

    observer.observe(html, {
        attributes: true,
        attributeFilter: ['class'],
    });
}

document.addEventListener("DOMContentLoaded", () => {
    let planSwitchers = document.querySelectorAll('.plan-switcher a');

    // on click, show the element with data-target attribute
    planSwitchers.forEach((planSwitcher) => {
        planSwitcher.addEventListener('click', (event) => {

            // remove the active class from all .plan-switcher a elements
            document.querySelectorAll('.plan-switcher a').forEach((planSwitcher) => {
                planSwitcher.classList.remove('tab-active');
            });

            // add the active class to the clicked element
            planSwitcher.classList.add('tab-active');

            // hide all .plans-container elements
            document.querySelectorAll('.plans-container').forEach((plansContainer) => {
                plansContainer.classList.add('hidden');
            });

            console.log(planSwitcher.getAttribute('data-target'));
            // show the element with data-target attribute
            let target = planSwitcher.getAttribute('data-target');
            document.querySelector("." + target).classList.remove('hidden');
        });
    });


    syncDaisyThemeWithFilament();


});
