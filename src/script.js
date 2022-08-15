// const mainContent = document.querySelector('main')
// document.getElementById('skip-to-content').addEventListener('click', function(e) {
//   e.preventDefault();
//   var target = mainContent.querySelectorAll('h1, h2, h3, h4, h5, h6')[0];
//   target.setAttribute('tabindex', "-1");
//   target.focus();
// });

const nav = document.querySelector('.nav')
const navMenu = document.querySelector('.primary-nav')
const menuToggle = document.querySelector('.menu-toggle')
const menuCircle = document.querySelector('.mobile-menu-wrapper')
const pageBody = document.querySelector('body')

menuToggle.addEventListener('click', (e) => {
  menuToggle.classList.toggle('menu-toggle-active')

  const visibility = navMenu.getAttribute('data-visible')
  if (visibility === 'false') {
    navMenu.setAttribute('data-visible', true)
    e.target.setAttribute('aria-expanded', true)
    pageBody.addClass('nav_open-no_scroll')
  } else {
    navMenu.setAttribute('data-visible', false)
    e.target.setAttribute('aria-expanded', false)
    pageBody.removeClass('nav_open-no_scroll')
  }
})

//////   Exit Mobile Menu by Clicking Outside

document.onclick = function (e) {
  const visibility = navMenu.getAttribute('data-visible')

  if (visibility === 'true') {
    if (
      navMenu !== e.target &&
      menuToggle !== e.target &&
      navMenu !== e.target.offsetParent &&
      menuToggle !== e.target.offsetParent
    ) {
      navMenu.setAttribute('data-visible', false)
      menuToggle.setAttribute('aria-expanded', false)
    }
  }
}

//////   Exit Mobile Menu with Esc

window.addEventListener('keydown', (e) => {
  // if (e.keyCode == 27) {
  let keydownEscape = e.key === 'Escape' || e.keyCode === 27
  const visibility = navMenu.getAttribute('data-visible')

  if (visibility === 'true') {
    if (keydownEscape) {
      navMenu.setAttribute('data-visible', false)
      menuToggle.setAttribute('aria-expanded', false)
      navMenu.classList.remove('menu-toggle-active')
    }
  }
})

//////   Trap Tab Focus

const focusableElements =
  'button:not([disabled]), [href]:not([disabled]), input:not([disabled]), select:not([disabled]), textarea:not([disabled]), details:not([disabled]), [tabindex]:not([tabindex="-1"])'

const firstFocusableElement = nav.querySelectorAll(focusableElements)[0]
const focusableContent = nav.querySelectorAll(focusableElements)
const lastFocusableElement = focusableContent[focusableContent.length - 1]

document.addEventListener('keydown', function (e) {
  let isTabPressed = e.key === 'Tab' || e.keyCode === 9

  if (!isTabPressed) {
    return
  }

  if (e.shiftKey) {
    if (document.activeElement === firstFocusableElement) {
      lastFocusableElement.focus()
      e.preventDefault()
    }
  } else {
    if (document.activeElement === lastFocusableElement) {
      firstFocusableElement.focus()
      e.preventDefault()
    }
  }
})

// firstFocusableElement.focus()

//////   Open/Close Search

const searchField = document.querySelector('.search-overlay')

function openSearch() {
  searchField.classList.add('search-overlay--active')
}

function closeSearch() {
  searchField.classList.remove('search-overlay--active')
}
