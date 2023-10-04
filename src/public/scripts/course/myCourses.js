// Pagination Buttons Handler
var footer = document.getElementById("body-footer");

function footerEventHandler(event) {
    if (event.target.className === "page-button") {
        var targetPage = event.target.textContent.trim();

        if (targetPage === 'PREV') {
            targetPage = parseInt(document.getElementById("current-page-button").textContent.trim()) - 1;
        } else if (targetPage === 'NEXT') {
            targetPage = parseInt(document.getElementById("current-page-button").textContent.trim()) + 1;
        }

        var xhr = new XMLHttpRequest();
        const searchInput = document.getElementById("search-input").value;
        xhr.open("GET", `/api/courses?q=${searchInput}&page=${targetPage}`, true);

        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("body-main-container").innerHTML = this.responseText;
                footer = document.getElementById("body-footer");
                footer.addEventListener("click", footerEventHandler);
            }
        }

        xhr.send();
    }
}

footer.addEventListener("click", footerEventHandler);


// Search Bar Handler
let debounceTimeout;

function debounce(func, wait) {
    return function() {
        const context = this;
        const args = arguments;
        clearTimeout(debounceTimeout);
        debounceTimeout = setTimeout(() => {
            func.apply(context, args);
        }, wait);
    };
}

function performSearch() {
    const inputValue = document.getElementById("search-input").value;
    
    var xhr = new XMLHttpRequest();
    xhr.open("GET", `/api/courses?q=${inputValue}`, true);

    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {            
            document.getElementById("body-main-container").innerHTML = this.responseText;
        }
    }

    xhr.send();
}

const searchInput = document.getElementById("search-input");
searchInput.addEventListener("input", debounce(performSearch, 500));

const searchButton = document.getElementById("search-button");
searchButton.addEventListener("click", function() {
    clearTimeout(debounceTimeout);
    performSearch();
});


