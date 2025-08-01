        feather.replace();

        //JS PARA SUAVIZAR O MENUS
        document.querySelectorAll('.dropdown').forEach(dropdown => {
  dropdown.addEventListener('show.bs.dropdown', e => {
    const menu = dropdown.querySelector('.dropdown-menu');
    menu.style.opacity = 0;
    menu.style.transform = 'translateY(10px)';
    requestAnimationFrame(() => {
      menu.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
      menu.style.opacity = 1;
      menu.style.transform = 'translateY(0)';
    });
  });

  dropdown.addEventListener('hide.bs.dropdown', e => {
    const menu = dropdown.querySelector('.dropdown-menu');
    menu.style.transition = 'opacity 0.6s ease, transform 0.3s ease';
    menu.style.opacity = 0;
    menu.style.transform = 'translateY(10px)';
  });
});
