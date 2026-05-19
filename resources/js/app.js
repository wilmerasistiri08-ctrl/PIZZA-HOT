import './bootstrap';

/*
|--------------------------------------------------------------------------
| REVEAL ANIMATION
|--------------------------------------------------------------------------
*/

const reveals = document.querySelectorAll('.reveal');

function revealOnScroll() {

    reveals.forEach((element) => {

        const windowHeight = window.innerHeight;

        const top = element.getBoundingClientRect().top;

        if (top < windowHeight - 100) {

            element.classList.add('active');

        }

    });

}

window.addEventListener('scroll', revealOnScroll);

revealOnScroll();