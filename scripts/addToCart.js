let productsInCart = JSON.parse(localStorage.getItem("shoppingCart"));
if (!productsInCart) {
  productsInCart = [];
}

const products = document.querySelectorAll(".product");
/* console.log(products); */

products.forEach((item) => {
  item.addEventListener("click", (e) => {
    if (e.target.classList.contains("addToCart")) {
      alert("Item Added to Cart");
      const productID = e.target.dataset.productId;
      const productName = item.querySelector(".name").innerHTML;
      const productPrice = item.querySelector(".priceValue").innerHTML;
      const productImage = item.querySelector("img").src;
      //   const productDescription = item.querySelector(".description").innerHTML;
      let product = {
        id: productID,
        name: productName,
        price: +productPrice,
        basePrice: +productPrice,
        image: productImage,
        // description: productDescription,
        count: 1,
      };
      /* console.log(product); */
      updateProductsInCart(product);
      /* console.log(productsInCart); */
      updateShoppingCartHTML();
    }
  });
});

function updateProductsInCart(product) {
  // 2
  for (let i = 0; i < productsInCart.length; i++) {
    if (productsInCart[i].id == product.id) {
      productsInCart[i].count += 1;
      productsInCart[i].price =
        productsInCart[i].basePrice * productsInCart[i].count;
      return;
    }
  }
  productsInCart.push(product);
}

const updateShoppingCartHTML = function () {
  // 3
  localStorage.setItem("shoppingCart", JSON.stringify(productsInCart));
};
