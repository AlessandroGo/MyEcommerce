// const products = document.querySelectorAll(".product");

// products.forEach((item) => {
//   item.addEventListener("click", (e) => {
//     console.log(item);
//     //   updateProductsInCart(product);
//     /* console.log(productsInCart); */
//     //   updateShoppingCartHTML();
//   });
// });

// document.getElementById("addToCart").onclick = function () {
//   console.log("CLICKED");
// };

function postToCart(answer) {
  //   alert(answer);
  //   if (answer) {
  alert(answer);
  $.ajax({
    type: "POST",
    url: "proccess.php",
    data: { user_id: answer[0], product_id: answer[1], quantity: answer[2] },
    success: (date) => console.log(data),
    error: (xhr, status, error) => console.error("BEEP BOOP", xhr.error),
  });
  //   } else {
  //     alert("Don't show number");
  //   }
}
// onclick="postToCart('2,<?php echo $book['id']; ?>,1')"
