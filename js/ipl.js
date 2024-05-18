const API_KEY = "0070459b13fd42edafd57e1a3f72c124";
const url = "https://newsapi.org/v2/everything?q=";
const pageSize = 15; // Number of articles per page
let currentPage = 1; // Current page number
const preloader = document.querySelector(".preloader");
const cardsContainer = document.getElementById("cards-container");
const nextButton = document.getElementById("next-button");
const prevButton = document.getElementById("prev-button");

window.addEventListener('load', () => {
    preloader.remove();
    fetchNews("IPL", currentPage);
});

nextButton.addEventListener("click", () => {
    currentPage++;
    fetchNews("IPL", currentPage);
});

prevButton.addEventListener("click", () => {
    if (currentPage > 1) {
        currentPage--;
        fetchNews("IPL", currentPage);
    }
});


async function fetchNews(query, page) {
    const res = await fetch(`${url}${query}&apiKey=${API_KEY}&pageSize=${pageSize}&page=${page}`);
    const data = await res.json();
    bindData(data.articles);
    togglePaginationButtons(data.totalResults);
}

function bindData(articles) {
    cardsContainer.innerHTML = "";
    articles.forEach(article => {
        if (!article.urlToImage) return;
        const card = createCard(article);
        cardsContainer.appendChild(card);
    });
}

function createCard(article) {
    const card = document.createElement("div");
    card.classList.add("card");

    const newsImg = document.createElement("img");
    newsImg.src = article.urlToImage;

    const articleContent = document.createElement("article");

    const newsTitle = document.createElement("h2");
    newsTitle.textContent = article.title;

    const newsSource = document.createElement("p");
    newsSource.textContent = `${article.source.name} · ${new Date(article.publishedAt).toLocaleString("en-US", { timeZone: "Asia/Jakarta" })}`;

    const newsDesc = document.createElement("p");
    newsDesc.textContent = article.description;

    articleContent.appendChild(newsTitle);
    articleContent.appendChild(newsSource);
    articleContent.appendChild(newsDesc);

    card.appendChild(newsImg);
    card.appendChild(articleContent);

    card.addEventListener("click", () => {
        window.open(article.url, "_blank");
    });

    return card;
}

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

const searchButton = document.getElementById("search-button");
const searchText = document.getElementById("search-text");

searchButton.addEventListener("click", () => {
    const query = searchText.value;
    if (!query) return;
    fetchNews(query);
    curSelectedNav?.classList.remove("active");
    curSelectedNav = null;
});
