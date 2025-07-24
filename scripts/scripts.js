'use strict';

// drower   
document.addEventListener('DOMContentLoaded', function () {
  const wrapper = document.getElementById('wrapper');
  const openNav = document.getElementById('open_nav'); 
  const nav = document.getElementById('nav');
  const closeNav = document.getElementById('batu');

  openNav.addEventListener('click', function () {
    nav.classList.add('show');
    nav.classList.remove('show_reverse');
    wrapper.classList.add('show');
  });

  closeNav.addEventListener('click', function () {
    nav.classList.remove('show');
    nav.classList.add('show_reverse');
    wrapper.classList.remove('show');
  });

  wrapper.addEventListener('click', function () {
    nav.classList.remove('show');
    nav.classList.add('show_reverse');
    wrapper.classList.remove('show');
  });

  window.addEventListener('scroll', function () {
    if (nav.classList.contains('show')) {
      nav.classList.remove('show');
      nav.classList.add('show_reverse');
      wrapper.classList.remove('show');
    }
  });
});

