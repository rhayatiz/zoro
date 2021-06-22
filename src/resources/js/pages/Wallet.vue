<template>
  <div class="mt-4 container text-white">

      <!------------------ WALLLET ------------->
      <div class="row px-3">
      <h4><i class="fas fa-wallet"></i> Wallet </h4><span class="ml-auto font-weight-light align-right">15N8ZpPq7Te9d8h7pURjZ102bSR3h8n8oAM</span>
      </div>

      <table class="table table-striped table-light mt-3 rounded shadow">
        <thead>
          <tr>
            <th>Cryptocurrency</th>
            <th class="text-center">Quantity</th>
            <th class="text-center">24H Variation</th>
            <th class="text-center">Initial Value</th>
            <th class="text-center">Current Value</th>
            <th class="text-center"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Ethereum</td>
            <td class="text-center">4</td>
            <td class="text-center"><span class="pill wl-green px-2">+6,23%</span></td>
            <td class="text-center">1255,23€</td>
            <td class="text-center">5423,26€</td>
            <td class="d-flex flex-column">
              <div class="btn btn-sm btn-success mb-1">Buy</div>
              <div class="btn btn-sm btn-danger">Sell</div>
            </td>
          </tr>

          
          <tr>
            <td>Bitcoin</td>
            <td class="text-center">0.23</td>
            <td class="text-center"><span class="pill wl-red px-2">-2,23%</span></td>
            <td class="text-center">1255,23€</td>
            <td class="text-center">5423,26€</td>
            <td class="d-flex flex-column">
              <div class="btn btn-sm btn-success mb-1">Buy</div>
              <div class="btn btn-sm btn-danger">Sell</div>
            </td>
          </tr>

          
          <tr>
            <td>DogeCoin</td>
            <td class="text-center">16</td>
            <td class="text-center"><span class="pill wl-green px-2">+6,23%</span></td>
            <td class="text-center">1255,23€</td>
            <td class="text-center">5423,26€</td>
            <td class="d-flex flex-column">
              <div class="btn btn-sm btn-success mb-1">Buy</div>
              <div class="btn btn-sm btn-danger">Sell</div>
            </td>
          </tr>
        </tbody>
      </table>

      <!------------------ ORDER HISTORY ------------->
      <div class="row px-3 mt-5">
      <h4><i class="fas fa-history"></i> Order history</h4>
      </div>

      <table class="table table-striped table-light mt-3 rounded shadow">
        <thead>
          <tr>
            <th>Order N#</th>
            <th class="text-center">Date</th>
            <th class="text-center">Cryptocurrency</th>
            <th class="text-center">Price</th>
            <th class="text-center">Quantity</th>
            <th class="text-center">Total</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>3210328982512</td>
            <td class="text-center">12/12/2002 15:32</td>
            <td class="text-center">Ethereum</td>
            <td class="text-center">1255,23€</td>
            <td class="text-center">2,32</td>
            <td class="text-center">2 912,13€</td>
          </tr>

          
          <tr>
            <td>3210328982512</td>
            <td class="text-center">12/12/2002 15:32</td>
            <td class="text-center">Ethereum</td>
            <td class="text-center">1255,23€</td>
            <td class="text-center">1</td>
            <td class="text-center">1255,23€</td>
          </tr>

          
          <tr>
            <td>3210328982512</td>
            <td class="text-center">12/12/2002 15:32</td>
            <td class="text-center">Dogecoin</td>
            <td class="text-center">0,23€</td>
            <td class="text-center">1000</td>
            <td class="text-center">230,13€</td>
          </tr>
        </tbody>
      </table>



  </div>
</template>

<script>
export default {

}
</script>

<style>

.pill {
    border-radius: 10px;
}

.wl-green {
    background-color: rgb(161, 219, 186);
    color: rgb(9, 110, 42);
}

.wl-red {
    background-color: rgb(219, 157, 157);
    color: rgb(128, 25, 25);
}

th, td {
  vertical-align: middle !important;
}

</style>