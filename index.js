function swapNews(imgSrc, title, desc) {
    document.getElementById('head-img').src = imgSrc;
    document.getElementById('head-title').textContent = title;
    document.querySelector('.header-item p').textContent = desc;
}


function scrollToLeft() {
    const container = document.querySelector('.items-container');
    container.scrollBy({
        left: -200, // Adjust scrolling amount as needed
        behavior: 'smooth' // Enable smooth scrolling
    });
}

function scrollToRight() {
    const container = document.querySelector('.items-container');
    container.scrollBy({
        left: 200, // Adjust scrolling amount as needed
        behavior: 'smooth' // Enable smooth scrolling
    });
}