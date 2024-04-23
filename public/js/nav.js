const navList = document.querySelector(".nav-list");
const mobileNav = document.querySelector(".mobile-nav");
const mobileNavBtnFirst = document.querySelector(".mobile-nav-btn--first");
const mobileNavBtnMiddle = document.querySelector(".mobile-nav-btn--middle");
const mobileNavBtnLast = document.querySelector(".mobile-nav-btn--last");

function toggleNavProperties(close = false) {
    navList.style.opacity = close ? 0 : 1;
    navList.style.visibility = close ? "hidden" : "visible";
    mobileNavBtnFirst.style.position = close ? "static" : "absolute";
    mobileNavBtnFirst.style.top = close ? "0" : "50%";
    mobileNavBtnFirst.style.transform = close ? "rotate(0)" : "rotate(135deg)";
    // prettier-ignore
    mobileNavBtnMiddle.style.backgroundColor = close ? "#cfcfcf" : "transparent";
    mobileNavBtnLast.style.position = close ? "static" : "absolute";
    mobileNavBtnLast.style.top = close ? "0" : "50%";
    mobileNavBtnLast.style.transform = close ? "rotate(0)" : "rotate(-135deg)";
}

mobileNav.addEventListener("click", function () {
    if (getComputedStyle(navList).opacity == 0) {
        toggleNavProperties();
    } else {
        toggleNavProperties(true);
    }
});

const mediaQuery = window.matchMedia("(min-width: 620px)");

function handleViewportChange(e) {
    if (e.matches) {
        console.log("Matches");
        navList.style.opacity = "";
        navList.style.visibility = "";
    }
}

mediaQuery.addEventListener("change", handleViewportChange);
