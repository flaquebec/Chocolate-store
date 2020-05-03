<?php
require 'header.php';?>

<!--Admin/Home-->

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item itemBC"><a href="/admin/index.php" class="">Admin</a></li>
          <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>

       <!--Chart-->
    <div class="superContainer container-fluid d-flex-wrap">
      <div id="boxGraf"class="col-xl-5 col-lg-12 d-flex justify-content-center col-sm-12" >
          <div class="col-xl-12 col-lg-8 col-md-8 col-sm-12">
            <canvas id="Graf"class="col-12"> </canvas>
          </div>
      </div>
  

    <!--Tabelas de pedidos e cliente-->
       <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 mr-xl-4" id="tabelasPedidosClientes">

    <!--Tabela de pedidos-->
          <div class="ultimosPC col-xl-12 col-sm-12 col-md-8 col-lg-8 mr-auto ml-auto ">
           <table class="table">
             <thead>
                <tr>
                  <th scope="col">No.</th>
                  <th scope="col">Estatus</th>
                  <th scope="col">Data</th>
                  <th scope="col">Cliente</th>
                  <th scope="col">Total</th>
                </tr>
             </thead>
             <tbody>
                <tr>
                  <th scope="row">001</th>
                   <td>Fechado</td>
                   <td>01/01/2020</td>
                   <td>Pedro Da Silva</td>
                   <td>R$30,00</td>
                </tr>
                
                <tr>
                  <th scope="row">002</th>
                   <td>Entregue</td>
                   <td>01/01/2020</td>
                   <td>Marcia Santos</td>
                  <td>R$53,00</td>
                </tr>
         
                <tr>
                  <th scope="row">001</th>
                   <td>Cancelado</td>
                   <td>01/01/2020</td>
                   <td>Ana Rodrigues</td>
                   <td>R$24,00</td>
                  </tr>
               </tbody>
           </table>      
          </div>
  
    <!-- Ultimos Clientes Cadastrados-->
    <div class="ultimosPC col-xl-12 col-sm-12 col-md-8 col-lg-8 mr-auto ml-auto mt-5">
   
      <table class="table">
         <thead>
            <tr>
               <th scope="col">No.</th>
               <th scope="col">Estatus</th>
               <th scope="col">Data</th>
               <th scope="col">Cliente</th>
               <th scope="col">Total</th>
            </tr>
         </thead>
            <tbody>
               <tr>
                  <th scope="row">001</th>
                     <td>Fechado</td>
                     <td>01/01/2020</td>
                     <td>Pedro Da Silva</td>
                     <td>R$30,00</td>
               </tr>
          
               <tr>
                  <th scope="row">002</th>
                     <td>Entregue</td>
                     <td>01/01/2020</td>
                     <td>Marcia Santos</td>
                     <td>R$53,00</td>
               </tr>

               <tr>
                  <th scope="row">001</th>
                     <td>Cancelado</td>
                     <td>01/01/2020</td>
                     <td>Ana Rodrigues</td>
                     <td>R$24,00</td>
               </tr>
            </tbody>
         </table>  
      </div>
   </div>
</div>


    
    <script>
     // Chart.defaults.global.defaultFontFamily="'Comic Neue', 'cursive'";
     // Chart.defaults.global.defaultFontColor="#996633";
      var ctx = document.getElementById('Graf').getContext('2d');
      var grafico = new Chart(ctx, {
    // The type of chart we want to create
        type: 'line',

    // The data for our dataset
        data: {
            labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junnho', 'Julho','Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            datasets: [{
            label: 'Vendas',
            backgroundColor: '#734d26',
            fill: 'false',
            borderColor: '#996633',
            data: [8, 10, 5, 4, 13, 18, 14,10,3,17,13,14]
            }]
        },

    // Configuration options go here
        options: {
            title:{      
                display: true,   
                fontSize:30,
                text:"Vendas",
                //fontColor:'#ac7339',
               // fontFamily:"'Comic Neue', 'cursive'",
                padding:30,
                lineHeight:0,
            },
            legend:{
                display:false,
            },
            scales: {
            yAxes: [{
                stacked: true,
            }]
        },

          
           
        },
    });


    </script>

<?php
require 'footer.php';?>



















