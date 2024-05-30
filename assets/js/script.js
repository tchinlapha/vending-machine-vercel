let selectedCode = "";

function reStock() {
  $.ajax({
    url: "api/re_stock.php",
    method: "GET",
    success: function () {
      window.location.reload();
    },
  });
}

function addCredit(amount) {
  $.ajax({
    url: "api/add_credit.php",
    method: "POST",
    data: {
      amount: amount,
    },
    success: function (response) {
      const data = JSON.parse(response);
      credit = data.credit;
      $("#credit").text(credit);
    },
  });
}

function pressKey(key) {
  if (selectedCode.length < 5) {
    selectedCode += key;
    $("#selected-code").text(selectedCode);
  }
}

function deleteLastKey() {
  selectedCode = selectedCode.slice(0, -1);
  $("#selected-code").text(selectedCode);
  if (!selectedCode.length) {
    $("#selected-code").text("00000");
  }
}

function purchase() {
  if (selectedCode.length !== 5) {
    $("#message").text("Please enter a valid 5-digit product code.");
    return;
  }

  $.ajax({
    url: "api/purchase.php",
    method: "POST",
    data: {
      code: selectedCode,
    },
    success: function (response) {
      const data = JSON.parse(response);
      $("#message").text(data.message);
      if (data.success) {
        $("#credit").text(data.credit);
        if (data.product) {
          console.log(data.product);
          $(`#${data.product.code}-amount`).text(data.product.amount);

          $("#productImage").attr("src", "./assets/img/"+data.product.image);
          $("#productName").text(data.product.name);
          $("#productPrice").text(data.product.price);
          $("#productCode").text(data.product.code);
          $("#productModal").modal("show");
        }
      } else {
        $("#message").text(data.message);
      }
      selectedCode = "";
      $("#selected-code").text("00000");
    },
  });
}
