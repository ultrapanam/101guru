document.addEventListener('DOMContentLoaded', function () {
    const accordionButtons = document.querySelectorAll('.accordion-button');

    accordionButtons.forEach(button => {
        button.addEventListener('click', function () {
            const accordionItem = this.closest('.accordion-item');
            const accordionContent = accordionItem.querySelector('.accordion-content-faq');

            // Toggle active class for accordion item
            accordionItem.classList.toggle('active');

            // Toggle the button state
            this.classList.toggle('active');

            // If it's active, expand it
            if (accordionItem.classList.contains('active')) {
                accordionContent.style.maxHeight = accordionContent.scrollHeight + 'px';
            } else {
                // Otherwise, collapse it
                accordionContent.style.maxHeight = 0;
            }
        });
    });

    // Set the first accordion item as open by default
    // const firstAccordion = document.querySelector('.accordion-item.active');
    // if (firstAccordion) {
    //     const firstContent = firstAccordion.querySelector('.accordion-content-faq');
    //     firstContent.style.maxHeight = firstContent.scrollHeight + 'px';
    // }
});
