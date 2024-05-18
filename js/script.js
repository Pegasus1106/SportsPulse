const preloader = document.querySelector(".preloader");

window.addEventListener('load', () => {
    preloader.remove();
})

function togglePaginationButtons(totalResults) {
    if (currentPage === 1) {
        prevButton.style.visibility = "hidden";
    } else {
        prevButton.style.visibility = "visible";
    }
    const remainingArticles = totalResults - currentPage * pageSize;
    if (remainingArticles > 0) {
        nextButton.style.visibility = "visible";
    } else {
        nextButton.style.visibility = "hidden";
    }
}

