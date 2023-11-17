const hamburgerMenu = document.getElementById('navbar-hamburger-menu');

hamburgerMenu.addEventListener('click', () => {
  const navbar = document.getElementById('navbar-menu');

  if (navbar.className.includes('-active')) {
    hamburgerMenu.className = hamburgerMenu.className.replace('-active', '');
    navbar.className = navbar.className.replace('-active', '');
    return;
  } else {
    hamburgerMenu.className = hamburgerMenu.className + '-active';
    navbar.className = navbar.className + '-active';
  }
});

window.addEventListener('resize', () => {
  const navbar = document.getElementById('navbar-menu');

  const min_width = 600;

  if (window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth >= min_width && navbar.className.includes('-active')) {
    hamburgerMenu.className = hamburgerMenu.className.replace('-active', '');
    navbar.className = navbar.className.replace('-active', '');
    return;
  }
});

document.getElementById('premium-button').addEventListener('click', function() {
  const uri = '/users/subscribe';

  const xhr = new XMLHttpRequest();

  xhr.open('POST', uri, true);

  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        location.reload();
      } else {
        console.error('Error subscribing:', xhr.statusText);
      }
    }
  };
  xhr.send();
})
