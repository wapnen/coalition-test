$(document).ready(function(){
    // get Products
    $.ajax({
           url: '/product',
           type: 'get',
           dataType : 'json',
           success: function(data){

             updateTable(data)
           }
   });

    //Submit product details
    $('#submit').click(function(e){
      //e.preventDefault();
      var name = $('#name').val();
      var quantity = $('#quantity').val();
      var price = $('#price').val();
      var token = $("meta[name='csrf-token']").attr("content");
      document.getElementById("product-form").reset();
         $.ajax({
                url: '/product',
                type: 'post',
                dataType : 'json',
                data: {'name' : name, '_token' : token , 'quantity' : quantity, 'price' : price }, success: function(data){
                  notify("Product created", "success")
                  updateTable(data)
                }
        });
    });

    // show form to edit the product
    $("#products").on("click", "tr", function(e){
      $('#exampleModal').modal('show')
      e.preventDefault();
        var id = $(this).attr('id')
        editForm(id)

    });

    // $("#products").on("click", "tr", function(e){
    //   e.preventDefault();
    //     var id = $(this)child("button.edit").attr('id')
    //     editForm(id)
    // });

    //edit the product
    $('#edit').click(function(e){
      e.preventDefault();
      var id = $('#edit-id').val()
      var name = $('#edit-name').val();
      var quantity = $('#edit-quantity').val();
      var price = $('#edit-price').val();
      var token = $("meta[name='csrf-token']").attr("content");
      document.getElementById("product-form").reset();
         $.ajax({
                url: "/product/"+id+"/edit",
                type: 'post',
                dataType : 'json',
                data: {'name' : name, '_token' : token , 'quantity' : quantity, 'price' : price }, success: function(data){

                  $('#exampleModal').modal('hide')
                  updateTable(data)
                  notify("Product updated", "success")
                }
        });
    });

    function updateTable(products){
      $("#products").html("")
      var total = 0
      for (data in products){
        $("#products").append("<tr id="+products[data].id+"><td>"+products[data].name+
        "</td><td>"+products[data].quantity+
        "</td><td>"+products[data].price+
        "</td><td>"+products[data].datetime_submitted+
        "</td><td>"+products[data].total+
        "</td><td> <button id="+data.id+" class='edit btn btn-warning' data-toggle='modal' data-target=''#exampleModal'> Edit </button> </td></tr>");
        total+= Number(products[data].total)
      }
        //show total

        $("#products").append("<tr><th></th><td></td><td></td><td></td><th>Total</th><th>$"+total+"</th></tr>");

    }

    function editForm(id){

         $.ajax({
                url: '/product/'+id+"/edit",
                type: 'get',
                dataType : 'json',
                success: function(data){
                  i = id -1
                  console.log(data)
                  $('#edit-name').val(data[i].name)
                  $('#edit-quantity').val(data[i].quantity)
                  $('#edit-price').val(data[i].price)
                  $('#edit-id').val(data[i].id)
                }
        });
    }


    //notify

    function notify(message, type){
      $.notify({
      	// options
      	message: message
      },{
      	// settings
      	type: type
      });
    }

});
