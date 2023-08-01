let searchForm = document.querySelector('.search-form');

document.querySelector('#search-btn').onclick = () => {
    searchForm.classList.toggle('active');
    shoppingCart.classList.remove('active');
    loginForm.classList.remove('active');
    navbar.classList.remove('active');
    accountPage.classList.remove('active');

}


let shoppingCart = document.querySelector('.shopping-cart');

document.querySelector('#cart-btn').onclick = () => {

    shoppingCart.classList.toggle('active');
    searchForm.classList.remove('active');
    loginForm.classList.remove('active');
    navbar.classList.remove('active');
    accountPage.classList.remove('active');

}

let shoppingCart2 = document.querySelector('.shopping-cart');
document.querySelector('#wishlist-btn').onclick = () => {

    shoppingCart2.classList.toggle('active');
    searchForm.classList.remove('active');
    loginForm.classList.remove('active');
    navbar.classList.remove('active');
    accountPage.classList.remove('active');

}

let accountPage = document.querySelector('.account-page');

document.querySelector('#account-info-btn').onclick = () => {
    accountPage.classList.toggle('active');
    searchForm.classList.remove('active');
    loginForm.classList.remove('active');
    navbar.classList.remove('active');
    shoppingCart.classList.remove('active');
}



window.onscroll = () => {
    searchForm.classList.remove('active');
    shoppingCart.classList.remove('active');
    loginForm.classList.remove('active');
    navbar.classList.remove('active');
    accountPage.classList.remove('active');
}



