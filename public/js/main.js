$(document).ready(function() {      
    $('[data-toggle="tooltip"]').tooltip()
    var budgetTable = $('table.display').DataTable({
        "destroy": true,        
        "ordering": false,
        "info":     false,  
        lengthChange: false,
        dom: 'Bfrtip',      
        "columDefs":[{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-Editar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"
        }],        
        buttons: [
            {
                "extend": "excelHtml5",
                "text": "<i class='far fa-file-excel'></i> Excel",
                "titleAttr": "Exportar a Excel", 
                "className": "btn btn-success btn-list-excel-table",
                "footer": true
            },
            {
                "extend": "pdfHtml5",
                "text": "<i class='far fa-file-pdf'></i> PDF",
                "titleAttr": "Exportar a PDF", 
                "className": "btn btn-danger btn-list-pdf-table",
                "footer": true
            }    
        ],      
        language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 de 0 de 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",            
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },  
        //   drawCallback: function () {
        //     var api = this.api();
        //     $( api.table().footer() ).html(
        //       api.column( 3, {page:'current'} ).data().sum()
        //     );
        //   }
        "excelStyles": [
            {
                "template": "blue_gray_medium"
            },
            {
                "cells": "s5:6",
                "style": {
                    "font": {
                        "b": true
                    },
                    "alignment": {
                        "horizontal": "center"
                    }
                }
            }
        ],
        "insertCells": [
            {
                "cells": "s5",
                "content": [
                    "This",
                    "Is",
                    "My",
                    "Nice",
                    "New",
                    "Row"
                ],
                "pushRow": true
            },
            {
                "cells": [
                    "s5",
                    "s7"
                ],
                "content": "",
                "pushRow": true
            }
        ]
                  
    }); 

    budgetTable.buttons().container().appendTo( 'table.display .col-md-6:eq(0)' );

    $('.toast').toast('show');

    // Asigna el valor del total del presupuesto en un input
    var total = budgetTable.column( 3 ).data().sum();
    console.log(total);    
    document.getElementById("totalBudget3").value = total;
    
    var totalInput = budgetTable.column( 3 ).data().sum();
    console.log(totalInput);
    document.getElementById("totalBudgetInput3").value = totalInput;
    

    var totalInputBtn = budgetTable.column( 3 ).data().sum();
    console.log(totalInputBtn);
    document.getElementById("btninput").value = totalInputBtn;
    $("#btninput").html(totalInputBtn);

    var totalInputBtn4 = budgetTable.column( 4 ).data().sum();
    console.log("btninput4" + totalInputBtn4);
    document.getElementById("btninput4").value = totalInputBtn4;
    $("#btninput4").html(totalInputBtn4);

    
    var totalSale = budgetTable.column( 6 ).data().sum();
    console.log("precio total de venta "+totalSale);    
    document.getElementById("totalBudget6").value = totalSale;
        
    var totalInputSale = budgetTable.column( 6 ).data().sum();
    console.log(totalInputSale);
    document.getElementById("totalBudgetInput6").value = totalInputSale;
        
    // document.getElementById('modalAddProduct').reset();

    // Cargar select a partir de otro select para tipo de cliente
    // recargarLista();

    // $('#tipeBuyer').change(function(){
    //     recargarLista();
    // });


    // evitar dropdown del select
    // $('#barcodeproductsearch').focusin(function() {
    //     $(this).css('display', 'none');
    //     $('body').click(function(event) {
    //         $(this).unbind(event);
    //         $('#barcodeproductsearch').css('display', 'block');
    //     });
    // });

    // document.getElementById('barcodeproductsearch').setAttribute('size', 0);

    
} );

    // script para mostrar el tooltip
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    // script para activar los toast
    var toastElList = [].slice.call(document.querySelectorAll('.toast'))
    var toastList = toastElList.map(function (toastEl) {
    return new bootstrap.Toast(toastEl, option)
    })

// seleccionar el producto para agregar a la lista de ventas
function selectProductSale(){
    // // precio de venta
    // var pricesale = $('#nameProduct>option:selected').attr('data-pricesale');  
    // console.log(pricesale);
    // var pricesaleinput = document.getElementById("pricesale");
    // pricesaleinput.setAttribute("value", pricesale);
    // console.log(pricesaleinput.value);

    // // tipo de venta
    // var tipesale = $('#nameProduct>option:selected').attr('data-tipesale');
    // console.log(tipesale);
    // var tipesaleinput = document.getElementById("tipesaleinput");
    // tipesaleinput.setAttribute("value", tipesale);

    // var formsale = document.getElementById("typesalebag");

    // // id del producto en la tabla de productos
    // var idproduct = $('#nameProduct>option:selected').attr('data-id');
    // var idproductinput = document.getElementById("idProduct");
    // idproductinput.setAttribute("value", idproduct);
    // console.log("id" + idproductinput.value);

    // // cantidad de kilos por bolsa
    // var kgbag = $('#nameProduct>option:selected').attr('data-kgbag');
    // var kgbaginput = document.getElementById("kgbag");
    // kgbaginput.setAttribute("value", kgbag);

    // // precio por kilo
    // var pricekg = $('#nameProduct>option:selected').attr('data-pricekg');
    // var pricekginput = document.getElementById("pricekg");
    // pricekginput.setAttribute("value", pricekg);

    // codigo de barras
    var barproductsearch = $('#nameproductsearch>option:selected').attr('data-barcode');
    var barcodeproductsearchinput = document.getElementById("barcodeproduct");
    barcodeproductsearchinput.setAttribute("value", barproductsearch);
    console.log("idsearch" + barcodeproductsearchinput.value);

    // nombre del producto
    var nameproductsearch = $('#nameproductsearch>option:selected').attr('data-name');
    var nameproductsearchinput = document.getElementById("nameproduct");
    nameproductsearchinput.setAttribute("value", nameproductsearch);
    console.log("idsearch" + nameproductsearchinput.value);

    // stock
    var stockproductsearch = $('#nameproductsearch>option:selected').attr('data-stock');
    var stockproductsearchinput = document.getElementById("stockproduct");
    stockproductsearchinput.setAttribute("value", stockproductsearch);
    console.log("idsearch" + stockproductsearchinput.value);

    // precio de venta
    var pricesaleproductsearch = $('#nameproductsearch>option:selected').attr('data-pricesale');
    var pricesaleproductsearchinput = document.getElementById("pricesaleproduct");
    pricesaleproductsearchinput.setAttribute("value", pricesaleproductsearch);
    console.log("idsearch" + pricesaleproductsearchinput.value);

    // id
    var idproductsearch = $('#nameproductsearch>option:selected').attr('data-id');
    var idproductsearchinput = document.getElementById("idproduct");
    idproductsearchinput.setAttribute("value", idproductsearch);
    console.log("idproduct" + idproductsearchinput.value);    
}

function selectProductSaleBarCode(){  

    // codigo de barras
    var barproductsearch = $('#barcodeproductsearch>option:selected').attr('data-barcode');
    var barcodeproductsearchinput = document.getElementById("barcodeproduct");
    barcodeproductsearchinput.setAttribute("value", barproductsearch);
    console.log("idsearch" + barcodeproductsearchinput.value);

    // nombre del producto
    var nameproductsearch = $('#barcodeproductsearch>option:selected').attr('data-name');
    var nameproductsearchinput = document.getElementById("nameproduct");
    nameproductsearchinput.setAttribute("value", nameproductsearch);
    console.log("idsearch" + nameproductsearchinput.value);

    // stock
    var stockproductsearch = $('#barcodeproductsearch>option:selected').attr('data-stock');
    var stockproductsearchinput = document.getElementById("stockproduct");
    stockproductsearchinput.setAttribute("value", stockproductsearch);
    console.log("idsearch" + stockproductsearchinput.value);

    // precio de venta
    var pricesaleproductsearch = $('#barcodeproductsearch>option:selected').attr('data-pricesale');
    var pricesaleproductsearchinput = document.getElementById("pricesaleproduct");
    pricesaleproductsearchinput.setAttribute("value", pricesaleproductsearch);
    console.log("idsearch" + pricesaleproductsearchinput.value);

    // id
    var idproductsearch = $('#barcodeproductsearch>option:selected').attr('data-id');
    var idproductsearchinput = document.getElementById("idproduct");
    idproductsearchinput.setAttribute("value", idproductsearch);
    console.log("idproduct" + idproductsearchinput.value);

    
}

function selectIdClient(){
    var namebuyer = $('#namebuyer>option:selected').attr('data-name');
    var namebuyerinput = document.getElementById("nameclientinput");
    namebuyerinput.setAttribute("value", namebuyer);
    console.log("name" + namebuyerinput.value);
}

// evitar dropdown del select
// $('#barcodeproductsearch').on('mousedown', function(e) {
//     e.preventDefault();
//     this.blur();
//     window.focus();
//  });
