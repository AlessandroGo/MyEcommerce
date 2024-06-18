const username = document.querySelector("#username").innerHTML;
if (username.length === 0) {
  let productsInCart = JSON.parse(localStorage.getItem("shoppingCart"));
  if (!productsInCart) {
    productsInCart = [];
  }
  console.log(productsInCart, "products");
  const parentElement = document.querySelector("#cartItem");
  const cartSumPrice = document.querySelector("#sumPrice");

  const countTheSumPrice = function () {
    let sum = 0;
    productsInCart.forEach((item) => {
      sum += item.price;
    });
    return sum.toFixed(2);
  };

  const updateShoppingCartHTML = function () {
    localStorage.setItem("shoppingCart", JSON.stringify(productsInCart));
  };

  const generateCart = function () {
    if (productsInCart.length > 0) {
      let result = productsInCart.map((product) => {
        return `
        <div class="col">
          <div class="buyItem" style="display: flex; justify-content: center;border: 2px solid black;
          border-radius: 5px;">
            <img style="width: 150px; height 150px; padding-right: 5px;" src="${
              product.image
            }" alt="no image found">
            <div>
              <p class="cart-id">Product id is: ${product.id}</p>
              <h5>${product.name}</h5>
              <p>Product price: R${product.basePrice}</p>
              <p>Total for Items: R${product.price.toFixed(2)}</p>
              <div>
                <button class="button-minus" data-id=${product.id}>-</button>
                <span class="countOfProduct">${product.count}</span>
                <button class="button-plus" data-id=${product.id}>+</button>
              </div>
            </div>
          </div>
        </div>`;
      });
      parentElement.innerHTML = result.join("");
      cartSumPrice.innerHTML = "Cart Total: R " + countTheSumPrice();
    } else {
      parentElement.innerHTML = "No Items In Cart";
      cartSumPrice.innerHTML = "";
    }
  };

  generateCart();

  const cartItems = document.querySelectorAll(".buyItem");
  /* console.log(cartItems); */

  cartItems.forEach((item) => {
    item.addEventListener("click", (e) => {
      const isPlusButton = e.target.classList.contains("button-plus");
      const isMinusButton = e.target.classList.contains("button-minus");
      if (isPlusButton || isMinusButton) {
        for (let i = 0; i < productsInCart.length; i++) {
          if (productsInCart[i].id == e.target.dataset.id) {
            if (isPlusButton) {
              productsInCart[i].count += 1;
            } else if (isMinusButton) {
              productsInCart[i].count -= 1;
            }
            productsInCart[i].price =
              productsInCart[i].basePrice * productsInCart[i].count;
          }
          if (productsInCart[i].count <= 0) {
            productsInCart.splice(i, 1);
          }
          updateShoppingCartHTML();
          generateCart();
          location.reload();
        }
      }
    });
  });
}
