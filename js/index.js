document.addEventListener('DOMContentLoaded', () => {

    const track = (name) => {
        if (typeof gtag === 'function') {
            gtag('event', name);
            console.log(`GA4 Event: ${name}`); 
        }
    };


    const heroBtn = document.querySelector('.btn-pulse');
    if (heroBtn) {
        heroBtn.addEventListener('click', (e) => {
      
            track('Hero_block_button_click');
        });
    }

  
    const advSection = document.querySelector('.advantages');
    if (advSection) {
        let scrolEventFired = false;
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !scrolEventFired) {
                    track('end_scrolling');
                    scrolEventFired = true; 
                    observer.unobserve(entry.target); 
                }
            });
        }, { threshold: 0.2 }); 
        observer.observe(advSection);
    }

 
    setTimeout(() => {
        track('30sec_event');
    }, 30000);

});




document.addEventListener('DOMContentLoaded', () => {
    const observerOptions = {
        threshold: 0.1 
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
              
                entry.target.classList.add('is-visible');
              
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

   
    const cards = document.querySelectorAll('.adv-card');
    cards.forEach(card => observer.observe(card));
});