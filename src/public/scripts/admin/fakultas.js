//  Variables
const searchInput = document.getElementById("search-bar-input");
const searchButton = document.getElementById("search-button");
const sortSelector = document.getElementById("sort");
const sortOrderSelector = document.getElementById("sort-order");
let footer = document.getElementById("body-footer");

// Functions

// URI Builder
function buildAdminUsersFetchURI(caller, value) {
  let uri = "/fakultas/html?";

  var search, sort, order, page;

  search = caller === "search" ? value : searchInput.value;
  sort = caller === "sort" ? value : sortSelector.value;
  order = caller === "order" ? value : sortOrderSelector.value;
  page = caller === "page" ? value : 1;

  if (search && search.trim() !== "") uri += `q-search=${encodeURI(search)}&`;
  if (sort) uri += `q-sort_param=${encodeURI(sort)}&`;
  if (order) uri += `q-sort_order=${encodeURI(order)}&`;
  if (page) uri += `page=${encodeURI(page)}&`;

  // Remove trailing '?' or '&' if exists
  if (uri.endsWith("?") || uri.endsWith("&")) uri = uri.slice(0, -1);

  return uri;
}

// Update InnerHTML of body-main-container
function updateBodyHTML(responseText) {
  document.getElementById("table").innerHTML = responseText;
  footer = document.getElementById("body-footer");
  if (footer) footer.addEventListener("click", footerEventHandler);
}

// Search Handler
let searchDebounceTimeout;

function searchDebounce(func, wait) {
  return function() {
    const context = this;
    const args = arguments;
    clearTimeout(searchDebounceTimeout);
    searchDebounceTimeout = setTimeout(() => {
      func.apply(context, args);
    }, wait);
  };
}

function searchFunction() {
  const uri = buildAdminUsersFetchURI("search", this.value);

  var xhr = new XMLHttpRequest();
  xhr.open("GET", uri, true);

  xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) updateBodyHTML(this.responseText);
  }

  xhr.send();
}

searchInput.addEventListener("input", searchDebounce(searchFunction, 500));
searchButton.addEventListener("click", function() {
  clearTimeout(searchDebounceTimeout);
  searchFunction();
});

// Sort Selector Handler
sortSelector.addEventListener("change", function() {
  const uri = buildAdminUsersFetchURI("sort", this.value);

  var xhr = new XMLHttpRequest();
  xhr.open("GET", uri, true);

  xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      updateBodyHTML(this.responseText);
    }
  }

  xhr.send();
});

// Order Selector Handler
sortOrderSelector.addEventListener("change", function() {
  const uri = buildAdminUsersFetchURI("order", this.value);

  var xhr = new XMLHttpRequest();
  xhr.open("GET", uri, true);

  xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) updateBodyHTML(this.responseText);
  }

  xhr.send();
});

// Footer Event Handler
function footerEventHandler(event) {
  let pageTarget;
  if (event.target.className === "page-control-button") {
    pageTarget = event.target.textContent.trim();

    if (pageTarget === "PREV") pageTarget = parseInt(document.getElementById("current-page-button").textContent.trim()) - 1;
    else if (pageTarget === "NEXT") pageTarget = parseInt(document.getElementById("current-page-button").textContent.trim()) + 1;
  } else if (event.target.className == "page-number-button") {
    pageTarget = parseInt(event.target.textContent.trim());
  }

  const uri = buildAdminUsersFetchURI("page", pageTarget);

  var xhr = new XMLHttpRequest();
  xhr.open("GET", uri, true);

  xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) updateBodyHTML(this.responseText);
  }

  xhr.send();
}

footer.addEventListener("click", footerEventHandler);
