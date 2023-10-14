export default () => {
const headFold = new IntersectionObserver(function(changes){
    const lockup = document.querySelector('.header-lockup');
    if(changes[0].isIntersecting) {
      lockup.classList.remove('header-lockup--over-fold');
    } else {
      lockup.classList.add('header-lockup--over-fold');
    }
});

  headFold.observe(document.querySelector('#header-test'));
}